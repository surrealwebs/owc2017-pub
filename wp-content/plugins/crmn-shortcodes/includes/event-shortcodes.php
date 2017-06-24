<?php

// Deny direct access
defined('ABSPATH') or die("YOU SHALL NOT PASS");

/**
 * CRMN_Event_Shortcodes class
 */
class CRMN_Event_Shortcodes{

    /**
     * Add the init function to the init action
     * @method __construct
     */
    public function __construct() {
        add_action( "init", array($this, 'init') );
    }

    /**
     * Initialize the registration of the custom shortcodes
     * @method init
     * @return VOID
     */
    public function init() {
        add_shortcode( 'next_event', array( $this, 'next_event') );
        add_shortcode( 'upcoming_events', array( $this, 'upcoming_events') );
        add_shortcode( 'upcoming_partner_events', array( $this, 'upcoming_partner_events') );
        add_shortcode( 'past_events', array( $this, 'past_events') );
    }

    /**
     * SHORTCODE displays the next event
     *
     * ex. [next_event]
     *
     * @param array $atts Shortcode Attributes.
     * @param string $content=null The contents of the shortcode.
     * @return string Rendered shortcode contents.
     */
    public function next_event( $atts, $content = null) {
        $out = '';

        // We are not expecting any ATTRIBUTES so we ignore them.

        // Get our event.
        $event = $this->_get_event_wp_query_object(1, 0, 'ASC', '>=', date('Y-m-d'));

        if ($event->have_posts()) {
            while ($event->have_posts()) { $event->the_post();

                $meta = get_metadata('post', get_the_ID());

                // We have an event without a date? Um, no, let's bail.
                if (empty($meta['event_date'][0])) {
                    $out = '<p><em>There are no upcoming events.</em></p>';
                    continue; // But there should only be one.
                }

                $end_date_meta_key = ( !empty($meta['end_date']) && $meta['end_date'] != '0000-00-00' ? 'end_date' : 'event_date' );

                // Get some timestamps so we can format how we choose.
                $start = $this->get_start_timestamp_from_meta( $meta );
                $end   = $this->get_end_timestamp_from_meta( $meta, $end_date_meta_key );

                // Build a row for this event.
                $out = '<div class="eventListing">
                    <h3><a href="' . get_the_permalink() . '" title="' . the_title_attribute(['echo'=>false]) . '">' . get_the_title() . '</a></h3>
                    <p>' . $this->get_event_date_string($start, $end) . '</p>
                    </div>';
            }
            wp_reset_postdata();
        }

        return $out;
    }

    /**
     * SHORTCODE displays the upcoming events. Limited to 5 by default.
     *
     * ex. [upcoming_events num="10" skip="1"]
     *
     * Allowed attributes:
     *    num: number of items (default 5), min 1, max 20
     *    skip: number of items to skip (default 0)
     *
     * @param array $atts Shortcode Attributes.
     * @param string $content=null The contents of the shortcode.
     * @return string Rendered shortcode contents.
     */
    public function upcoming_events( $atts, $content = null ) {
        // normalize attribute names
        $atts = array_change_key_case((array)$atts, CASE_LOWER);

        // Extract any expected attributes.
        $clean_atts = shortcode_atts( array(
            'num'  => 5,
            'skip' => 0,
        ), $atts );

        // initialize the output
        $out = '';

        $event = $this->_get_event_wp_query_object($clean_atts['num'], $clean_atts['skip'], 'ASC', '>=', date('Y-m-d'));

        if ($event->have_posts()) {
            while ($event->have_posts()) { $event->the_post();

                $meta = get_metadata('post', get_the_ID());

                // We have an event without a date? Um, no, let's bail.
                if (empty($meta['event_date'][0])) {
                    $out = '<p><em>There are no upcoming events.</em></p>';
                    continue; // But there should only be one.
                }

                $end_date_meta_key = ( !empty($meta['end_date']) && $meta['end_date'] != '0000-00-00' ? 'end_date' : 'event_date' );

                // Get some timestamps so we can format how we choose.
                $start = $this->get_start_timestamp_from_meta( $meta );
                $end   = $this->get_end_timestamp_from_meta( $meta, $end_date_meta_key );

                $out .= '<p>
                    <span style="font-weight: 400;">
                        <strong>' . $this->get_event_date_string($start, $end) . '</strong>&nbsp;<a href="' . get_the_permalink() . '" title="' . the_title_attribute(['echo'=>false]) . '">' . get_the_title() . '</a>
                    </span>
                    </p>';
            }
            wp_reset_postdata();
        }

        return $out;
    }

    /**
     * SHORTCODE displays the past events. Limited to 5 by default.
     *
     * ex. [past_events num="10" partners="true"]
     *
     * Allowed attributes:
     *    num: number of items (default 10), min 1, max 20
     *
     * @param array $atts Shortcode Attributes.
     * @param string $content=null The contents of the shortcode.
     * @return string Rendered shortcode contents.
     */
    public function past_events( $atts, $content = null ) {
        $out = '';

        // Extract any expected attributes.
        $clean_atts = shortcode_atts( array(
            'num'      => 5,
            'partners' => 0,
        ), $atts );

        $event = $this->_get_event_wp_query_object( $clean_atts['num'], 0, 'DESC', '<', date('Y-m-d'), $clean_atts['partners'] );

        if ( $event->have_posts() ) {
            while ( $event->have_posts() ) { $event->the_post();

                $meta = get_metadata('post', get_the_ID());

                // We have an event without a date? Um, no, let's bail.
                if ( empty( $meta['event_date'][0] ) ) {
                    $out = '<p><em>There are no upcoming events.</em></p>';
                    continue; // But there should only be one.
                }

                $end_date_meta_key = ( !empty( $meta['end_date'] ) && $meta['end_date'] != '0000-00-00' ? 'end_date' : 'event_date' );

                // Get some timestamps so we can format how we choose.
                $start = $this->get_start_timestamp_from_meta( $meta );
                $end   = $this->get_end_timestamp_from_meta( $meta, $end_date_meta_key );

                $partner = $this->get_partnership_label( $meta );

                // Build a row for this event.
                $out = '<div class="eventListing">
                    <h3><a href="' . get_the_permalink() . '" title="' . the_title_attribute(['echo'=>false]) . '">' . get_the_title() . '</a>' . esc_html( $partner ) . '</h3>
                    <p>' . date( 'F j, Y', $start ). ', from ' . date( 'g:ia', $start ) . ' to ' . date( 'g:ia', $end ) . '</p>
                    </div>';
            }
            wp_reset_postdata();
        }

        return $out;
    }

    /**
    * SHORTCODE displays the upcoming partner events. Limited to 5 by default.
    *
     * ex. [upcoming_partner_events num="10"]
     *
    * Allowed attributes:
    *    num: number of items (default 5), min 1, max 20
    *
     * @param array $atts Shortcode Attributes.
     * @param string $content=null The contents of the shortcode.
     * @return string Rendered shortcode contents.
     */
    public function upcoming_partner_events( $atts, $content = null ) {
        // normalize attribute names
        $atts = array_change_key_case((array)$atts, CASE_LOWER);

        // Extract any expected attributes.
        $clean_atts = shortcode_atts( array(
            'num'  => 5,
        ), $atts );

        // Ensure we are withing out limit, if not use the default.
        if ( $clean_atts['num'] < 1 || $clean_atts['num'] > 20 ) {
            $clean_atts['num'] = 5;
        }

        // initialize the output
        $out = '';

        $event = $this->_get_event_wp_query_object($clean_atts['num'], 0, 'ASC', '>=', date('Y-m-d'), true, true);

        if ($event->have_posts()) {
            while ($event->have_posts()) { $event->the_post();

                $meta = get_metadata('post', get_the_ID());

                // We have an event without a date? Um, no, let's bail.
                if (empty($meta['event_date'][0])) {
                    $out = '<p><em>There are no upcoming events.</em></p>';
                    continue; // But there should only be one.
                }

                $end_date_meta_key = ( !empty($meta['end_date']) && $meta['end_date'] != '0000-00-00' ? 'end_date' : 'event_date' );

                // Get some timestamps so we can format how we choose.
                $start = $this->get_start_timestamp_from_meta( $meta );
                $end   = $this->get_end_timestamp_from_meta( $meta, $end_date_meta_key );

                // $meta['partner_name'];
                $partner = $this->get_partnership_label( $meta );

                // Build a row for this event.
                $out .= '<p>
                    <span style="font-weight: 400;">
                        <strong>' . $this->get_event_date_string($start, $end) . '</strong>&nbsp;<a href="' . get_the_permalink() . '" title="' . the_title_attribute(['echo'=>false]) . '">' . get_the_title() . '</a>' . $partner . '
                    </span>
                    </p>';
            }
            wp_reset_postdata();
        }

        return $out;
    }

    /**
     * Get a timestamp for the start of the event.
     *
     * @see CRMN_Event_Shortcodes::_get_timestamp_from_meta
     *
     * @param array $meta Meta values to pull timestamp from.
     * @param string $date_name Name of the date meta key.
     * @param string $start_time_name Name of the time meta key.
     *
     * @return false|int Either a valid timestamp or false on error.
     */
    public function get_start_timestamp_from_meta( $meta, $date_name = 'event_date', $start_time_name = 'start_time' ) {
        return $this->_get_timestamp_from_meta( $meta, $date_name, $start_time_name );
    }

    /**
     * Get a timestamp for the end of the event.
     *
     * @see CRMN_Event_Shortcodes::_get_timestamp_from_meta
     *
     * @param array $meta Meta values to pull timestamp from.
     * @param string $date_name Name of the date meta key.
     * @param string $end_time_name Name of the time meta key.
     *
     * @return false|int Either a valid timestamp or false on error.
     */
    public function get_end_timestamp_from_meta( $meta, $date_name = 'event_date', $end_time_name = 'end_time' ) {
        return $this->_get_timestamp_from_meta( $meta, $date_name, $end_time_name );
    }

    /**
     * Get a timestamp for the event based on specified date/time keys.
     *
     * @param array $meta Meta values to pull timestamp from.
     * @param string $date_name Name of the date meta key.
     * @param string $time_name Name of the time meta key.
     *
     * @return false|int Either a valid timestamp or false on error.
     */
    protected function _get_timestamp_from_meta( $meta, $date_name, $time_name ) {
        // In case no time was specified, we default to 00:00 (midnight).
        $time = ( !empty( $meta[ $time_name ][0]) ? $meta[ $time_name ][0] : '00:00:00' );

        // In case no date was specified, we default to 0000-00-00 (mysql default date).
        $date = ( !empty( $meta[ $date_name ][0] ) ? $meta[ $date_name ][0] : '0000-00-00' );

        // Convert the date and time to a (unix) timestamp.
        return strtotime( trim( $date ) . ' ' . trim( $time ) );
    }

    /**
     * Build a WP_Query object based on some params.
     *
     * @param int $qty The max number of results.
     * @param int $offset Results offset in case you want to skip any.
     * @param string $order The order of the results (by event date)
     * @param string $date_meta_compare Determine how the date is compared (less than, greater than, etc.)
     * @param null $date The date to use in the comparisson.
     * @param bool $include_partners Determine is "partnership" events are included or not.
     * @param bool $partners_only Determines if ONLY partner events are returned, overrides $include_partners.
     * @return WP_Query The configured query object.
     */
    protected function _get_event_wp_query_object($qty = 10, $offset = 0, $order = 'ASC', $date_meta_compare = '>=', $date = null, $include_partners = false, $partners_only = false ) {

        // Validate the comparison operator, in it's invalid use "=" (equals) instead.
        $valid_compares = array( '>=', '<=', '>', '<', '=', '!=' );
        if (! in_array( $date_meta_compare, $valid_compares) ) {
            $date_meta_compare = '=';
        }

        // If no date is specified, use today.
        if ( empty( $date  )) {
            $date = date( 'Y-m-d', time() );
        }

        // If the date is not valid, use today.
        list ($y, $m, $d ) = explode( '-', $date );
        if ( ! checkdate( $m, $d, $y ) ) {
            $date = date( 'Y-m-d', time() );
        }

        // The base meta query, checking only the date.
        $meta_query = array(
            'key'     => 'event_date',
            'value'   => $date,
            'compare' => $date_meta_compare,
        );

        if ( $partners_only ) {
            // if we only want partner events we only care the is_partner_event key is true
            $meta_query = array(
                'relation' => 'AND',
                array(
                    'key'   => 'is_partner_event',
                    'value' => '1',
                ),
                $meta_query,
            );
        } elseif ( ! $include_partners ) {
            // If we don't want partner events we need to explicitly state as such.
            $meta_query = array(
                'relation' => 'AND',
                array(
                    'relation' => 'OR',
                    array(
                        'key'     => 'is_partner_event',
                        'compare' => 'NOT EXISTS',
                        'value'   => '',
                    ),
                    array(
                        'key'   => 'is_partner_event',
                        'value' => '0',
                    ),
                ),
                $meta_query,
            );
        }

        $args = array(
            'post_type'      => 'event',
            'posts_per_page' => intval( $qty ),
            'orderby'        => 'meta_value_date',
            'meta_key'       => 'event_date',
            'order'          => ( strtoupper( $order ) == 'ASC' ? 'ASC' : 'DESC' ),
            'meta_query'     => $meta_query,
        );

        if (!empty($offset)) {
            $args['offset'] = intval( $offset );
        }

        return new WP_Query($args);
    }

    /**
     * Get a formatted text representation of the date, take multiple day events into account.
     *
     * @param int $start_date Timestamp of the start of the event.
     * @param int $end_date Timestamp of the end of the event.
     * @return string Formatted date string based on the start and end dates.
     */
    public function get_event_date_string( $start_date, $end_date ) {
        // 1 day in seconds
        $day = (60 * 60 * 24);

        if ( $end_date - $start_date >= $day ) {
            // Span multiple days
            return date('F j') . '-' . date('j, Y', $end_date);
        }

        return date('F j, Y', $start_date). ', from ' . date('g:ia', $start_date) . ' to ' . date('g:ia', $end_date);
    }

    /**
     * Gets the label to use for partners if needed.
     *
     * @param array $meta Meta details from the event.
     * @return string The label for the partnership (may be empty).
     */
    public function get_partnership_label( $meta ) {
        $partner = '';
        if ( ! empty( $meta['is_partner_event'] ) ) {
            $partner = ' (a CRM partner event)';
            if ( ! empty( $meta['parnter_name'] ) ) {
                $partner = ' (in partnership with ' . $meta['parnter_name'] . ')';
            }
        }

        return $partner;
    }
}
