<?php

/**
 *
 * @class BlogPostsModule
 */
class BlogPostsModule extends FLBuilderModule {

    /**
     * @property $_editor
     * @protected
     */
    protected $_editor = null;
    protected $uabb_args = array();
    
    /**
     *
     * @method __construct
     */

    public function __construct() {

        parent::__construct(array(
            'name'          => __('Advanced Posts', 'uabb'),
            'description'   => __('Advanced Posts', 'uabb'),
            'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
            'group'         => UABB_CAT,
            'dir'           => BB_ULTIMATE_ADDON_DIR . 'modules/blog-posts/',
            'url'           => BB_ULTIMATE_ADDON_URL . 'modules/blog-posts/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh'  => true,
            'icon'              => 'schedule.svg',
        ));
        $this->add_css('font-awesome');
        add_filter( 'wp_footer', array( $this, 'enqueue_scripts' ) );
        add_filter( 'redirect_canonical', array( $this, 'uabb_disable_redirect_canonical' ) );
        add_filter( 'fl_builder_loop_query_args', array( $this, 'uabb_loop_query_args' ), 1 );
        // pagination.
        add_action( 'init', array( $this, 'uabb_init_rewrite_rules') );
        add_filter( 'redirect_canonical',  array( $this, 'uabb_override_canonical' ), 1, 2 );
    }

    /**
     * @method Mutator function to update $uabb_args
     * @public
     */
    public function set_uabb_args( $args ) {
        $this->uabb_args = $args;
    }

    /**
     * @method Accessor function to get $uabb_args
     * @public
     */
    public function get_uabb_args() {
        return $this->uabb_args;
    }

    /**
     * @method Filter to modify WP Query args
     * @public
     */

    public function uabb_loop_query_args( $args ) {
        if ( is_array( $args ) && is_array( $this->uabb_args ) ) {
            $args = array_merge( $args, $this->uabb_args );
        }
        return $args;
    }

    public function enqueue_scripts() {

        $this->add_js('jquery-infinitescroll');
        $this->add_js('jquery-mosaicflow');
        $this->add_js( 'isotope', $this->url . 'js/jquery-masonary.js', array('jquery'), '', true );
        $this->add_js( 'carousel', $this->url . 'js/jquery-carousel.js', array('jquery'), '', true);
        $this->add_js( 'jquery-infinitescroll' );
    }

    /**
     * @method uabb_disable_redirect_canonical
     * @public
     */

    public function uabb_disable_redirect_canonical( $redirect_url ) {
        if ( is_singular('post') ) $redirect_url = false;
        return $redirect_url;
    }
    
    /**
     * Returns an array of data for post types supported.
     *
     * @since 1.6.2
     * @return array
     */
    static public function post_types()
    {
        $post_types = get_post_types(array(
            'public'        => true,
            'show_ui'       => true
        ), 'objects');

        unset($post_types['attachment']);
        unset($post_types['fl-builder-template']);
        unset($post_types['fl-theme-layout']);

        return $post_types;
    }

    /**
     * @method _get_editor
     * @protected
     */
    protected function _get_editor( $url ) {
        $url_path  = $url;
        $file_path = ABSPATH . 'wp-content' . str_replace( content_url(), '', $url_path );

        if(file_exists($file_path)) {
            $this->_editor = wp_get_image_editor($file_path);
        }else {
            $this->_editor = wp_get_image_editor($url_path);
        }

        return $this->_editor;
    }


    /**
     * @method _get_cropped_path
     * @protected
     */
    protected function _get_cropped_path( $i, $url ) {
        $crop        = 'custom_crop';
        $cache_dir   = FLBuilderModel::get_cache_dir();

        if(empty($url)) {
            $filename    = uniqid(); // Return a file that doesn't exist.
        }
        else {

            if ( stristr( $url, '?' ) ) {
                $parts = explode( '?', $url );
                $url   = $parts[0];
            }

            $pathinfo    = pathinfo($url);
            $dir         = $pathinfo['dirname'];
            $ext         = $pathinfo['extension'];
            $name        = wp_basename($url, ".$ext");
            $new_ext     = strtolower($ext);
            $filename    = "{$name}-{$crop}.{$new_ext}";
        }

        return array(
            'filename' => $filename,
            'path'     => $cache_dir['path'] . $filename,
            'url'      => $cache_dir['url'] . $filename
        );
    }


    /**
     * @method delete
     */
    public function deleteUrl( $i, $url ) {
        $cropped_path = $this->_get_cropped_path( $i, $url );
        if(file_exists($cropped_path['path'])) {
            unlink($cropped_path['path']);
        }
    }


    /**
     * @method crop
     */
    public function crop( $i, $url, $width, $height ) {
        // Delete an existing crop if it exists.
        $this->deleteUrl( $i, $url );

        $editor = $this->_get_editor( $url );

        if(!$editor || is_wp_error($editor)) {
            return false;
        }

        $cropped_path = $this->_get_cropped_path( $i, $url );
        $new_width    = $width;
        $new_height   = $height;


        // Make sure we have enough memory to crop.
        @ini_set('memory_limit', '300M');

        // Crop the photo.
        $editor->resize($new_width, $new_height, true);

        // Save the photo.
        $editor->save($cropped_path['path']);
        // Return the new url.
        return $cropped_path['url'];
    }

    /**
     * Add rewrite rules for pagination that allows multiple advanced post modules
     * on the same page to be paged independently.
     *
     * @since 1.4.7
     * @return void
     */
    public function uabb_init_rewrite_rules() {
        for ( $x = 2; $x <= 10; $x++ ) {
            add_rewrite_rule( 'paged-' . $x . '/([0-9]*)/?', 'index.php?page_id=' . get_option( 'page_on_front' ) . '&flpaged' . $x . '=$matches[1]', 'top' );
            add_rewrite_rule( 'paged-' . $x . '/?([0-9]{1,})/?$', 'index.php?&flpaged' . $x . '=$matches[1]', 'top' );
            add_rewrite_rule( '(.?.+?)/paged-' . $x . '/?([0-9]{1,})/?$', 'index.php?pagename=$matches[1]&flpaged' . $x . '=$matches[2]', 'top' );
            add_rewrite_rule( '([^/]+)/paged-' . $x . '/?([0-9]{1,})/?$', 'index.php?name=$matches[1]&flpaged' . $x . '=$matches[2]', 'top' );
            add_rewrite_tag( "%flpaged{$x}%", '([^&]+)' );
        }
    }

    /**
     * Disable canonical redirection on the frontpage when query var 'flpaged' is found.
     *
     * @param  string $redirect_url  The redirect URL.
     * @param  string $requested_url The requested URL.
     * @since  1.4.7
     * @return bool|string
     */
    public function uabb_override_canonical( $redirect_url, $requested_url ) {
        global $wp_the_query;

        if ( is_array( $wp_the_query->query ) ) {
            foreach ( $wp_the_query->query as $key => $value ) {
                if ( strpos( $key, 'flpaged' ) === 0 && is_page() && get_option( 'page_on_front' ) ) {
                    $redirect_url = false;
                    break;
                }
            }

            $supported_post_types = self::post_types();
            // Disable canonical on CPT single
            if ( isset( $wp_the_query->query_vars['post_type'] )
                 && ! is_array( $wp_the_query->query_vars['post_type'] )
                 && isset( $supported_post_types[ $wp_the_query->query_vars['post_type'] ] )
                 && true === $wp_the_query->is_singular
                 && - 1 == $wp_the_query->current_post
                 && true === $wp_the_query->is_paged
            ) {
                $redirect_url = false;
            }
        }
        return $redirect_url;
    }

    /**
     * @method render_pagination
     */
    public function render_pagination( $query ) {
        // Get current page number
        $permalink_structure = get_option( 'permalink_structure' );
        $base = get_pagenum_link();
        $paged = FLBuilderLoop::get_paged();

        $this->settings->total_posts_switch = ( isset( $this->settings->total_posts_switch ) ? $this->settings->total_posts_switch : 'all' );

        $this->settings->total_posts = ( isset( $this->settings->total_posts ) ? $this->settings->total_posts : $query->found_posts );

        // Get total number of posts from query
        $total_posts = ( $this->settings->total_posts_switch == 'all' ) ? $query->found_posts : ( ( $this->settings->total_posts != '' ) ? $this->settings->total_posts : '6' );

        if ( FLBuilderLoop::$loop_counter > 1 ) {
                $page_prefix = 'paged-' . FLBuilderLoop::$loop_counter;
        } else {
            $page_prefix = empty( $permalink_structure ) ? 'paged' : 'page';
        }

        if ( empty( $permalink_structure ) || is_search() ) {
            $format = '&' . $page_prefix . '=%#%';
        } elseif ( '/' == substr( $base, -1 ) ) {
            $format = $page_prefix . '/%#%/';
        } else {
            $format = '/' . $page_prefix . '/%#%';
        }

        if ( ! empty( $permalink_structure ) && isset( $_GET['lang'] ) ) {
            $base = untrailingslashit( add_query_arg( array(
                'lang' => false,
            ), $base ) );
        }

        $pos = strrpos( $base, 'paged-' );
        if ( $pos ) {
            $base = substr_replace( $base, '', $pos, strlen( $base ) );
        }

        // Offset value if any
        $offset = ( ! isset( $this->settings->offset ) || ! is_int( ( int )$this->settings->offset ) ) ? 0 : ( ( $this->settings->offset != '' ) ? $this->settings->offset : 0 );

        $max = $query->found_posts - $offset;

        $max = ( $total_posts <= $max ) ? $total_posts : $max;

        if( $this->settings->total_posts_switch == 'all' || ( isset( $this->settings->data_source ) && $this->settings->data_source == 'main_query' ) ) {
            $total_pages = $query->max_num_pages;
        } else {
            $posts_per_page = ( isset( $this->settings->posts_per_page ) ) ? ( ( $this->settings->posts_per_page != '' ) ? $this->settings->posts_per_page : '10' ) : '10';
            $total_pages = ceil( $max / $posts_per_page );
        }

        // Return pagination html
        if($total_pages > 1) {
        
            $current_page = $paged;
            if ( ! $current_page ) {
                $current_page = 1;
            }
            echo paginate_links(array(
                'base'     => $base . '%_%',
                'format'   => $format,
                'current'  => $current_page,
                'total'    => $total_pages,
                'type'     => 'list'
            ));
        }
    }

    /**
     * @method render_args
     */
    public function render_args() {

        $show_pagination = ( isset( $this->settings->show_pagination ) ) ? $this->settings->show_pagination : 'yes';

        $args['post_type'] = ( isset( $this->settings->post_type ) ) ? $this->settings->post_type : 'post';
        $args['orderby'] = ( isset( $this->settings->order_by ) ) ? $this->settings->order_by : '';

        $this->settings->total_posts_switch = ( isset( $this->settings->total_posts_switch ) ) ? $this->settings->total_posts_switch : 'custom';

        $this->settings->total_posts = ( isset( $this->settings->total_posts ) ? $this->settings->total_posts : '6' );

             // Order by meta value arg.
        if ( strstr( $args['orderby'], 'meta_value' ) ) {
            if( isset( $this->settings->order_by_meta_key ) ) {
                $args['meta_key'] = $this->settings->order_by_meta_key;
            }
        }

        if( $this->settings->is_carousel != 'carousel' && $show_pagination == 'yes' ) {

            $cat = 'masonary_filter_' . $args['post_type'];
            $do_pagination = ( isset( $this->settings->$cat ) ) ? ( ( $this->settings->$cat == -1 ) ? true : false ) : true;

            if( $this->settings->is_carousel == 'masonary' ) {
                if( $do_pagination == true ) {
                    $args['posts_per_page'] = ( isset( $this->settings->posts_per_page ) ) ? ( ( $this->settings->posts_per_page != '' ) ? $this->settings->posts_per_page : '10' ) : '10';
                } else {
                    $args['posts_per_page'] = ( $this->settings->total_posts_switch == 'all' ) ? '-1' : $this->settings->total_posts;
                }
                
            } else {
                $args['posts_per_page'] = ( isset( $this->settings->posts_per_page ) ) ? ( ( $this->settings->posts_per_page != '' ) ? $this->settings->posts_per_page : '10' ) : '10';
            }

        } else {
            $args['posts_per_page'] = ( $this->settings->total_posts_switch == 'all' ) ? '-1' : $this->settings->total_posts;
        }
        return $args;
    }


    /**
     * @method render_button
     * @protected
     */
    protected function render_button( $link = '', $link_target = '_blank' ) {

        // Return CTA
        if( $this->settings->cta_type == 'button' ) {
            $btn_settings = array(
                /* General Section */
                'text'              => do_shortcode( $this->settings->btn_text ),

                /* Link Section */
                'link'              => $link,
                'link_target'       => $link_target,
                'link_nofollow'     => $this->settings->link_nofollow,

                /* Style Section */
                'style'             => $this->settings->btn_style,
                'border_size'       => $this->settings->btn_border_size,
                'transparent_button_options' => $this->settings->btn_transparent_button_options,
                'threed_button_options'      => $this->settings->btn_threed_button_options,
                'flat_button_options'        => $this->settings->btn_flat_button_options,

                /* Colors */
                'bg_color'          => $this->settings->btn_bg_color,
                'bg_hover_color'    => $this->settings->btn_bg_hover_color,
                'text_color'        => $this->settings->btn_text_color,
                'text_hover_color'  => $this->settings->btn_text_hover_color,

                /* Icon */
                'icon'              => $this->settings->btn_icon,
                'icon_position'     => $this->settings->btn_icon_position,

                /* Structure */
                'width'              => $this->settings->btn_width,
                'custom_width'       => $this->settings->btn_custom_width,
                'custom_height'      => $this->settings->btn_custom_height,
                'padding_top_bottom' => $this->settings->btn_padding_top_bottom,
                'padding_left_right' => $this->settings->btn_padding_left_right,
                'border_radius'      => $this->settings->btn_border_radius,
                'align'             => $this->settings->overall_alignment,
                'mob_align'          => '',

                /* Typography */
                'font_size'         => $this->settings->btn_font_size,
                'line_height'       => $this->settings->btn_line_height,
                'font_family'       => $this->settings->btn_font_family,
            );
            echo '<div class="uabb-blog-post-section">';
            FLBuilder::render_module_html('uabb-button', $btn_settings);
            echo '</div>';

        } else if( $this->settings->cta_type == 'link' ) {
            $nofollow = ( isset( $this->settings->link_nofollow ) ) ? $this->settings->link_nofollow : '0';
            echo '<span class="uabb-read-more-text uabb-blog-post-section"><a href="' . $link . '" target="' . $link_target . '" '. BB_Ultimate_Addon_Helper::get_link_rel( $link_target, $nofollow, 0 ) .'>' . do_shortcode( $this->settings->cta_text ) . ' <span class="uabb-next-right-arrow">&#8594;</span></a></span>';
        }
    }

    /**
     * @method render_image_url
     * @protected
     */
    protected function render_image_url( $i, $post_attachment_id ) {

        // Predefined values
        $id = -1;
        $id = get_post_thumbnail_id( $post_attachment_id );
        $alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
        $size = ( isset( $this->settings->featured_image_size ) ) ? $this->settings->featured_image_size : 'medium';

        // Get attachment if any
        if( $id != -1 && $id != "" ) {
            if( $size != 'custom' ) {
                $temp = wp_get_attachment_image_src( $id, $size );
                $image = $temp[0];
            } else {
                $temp = wp_get_attachment_image_src( $id, 'full' );
                $image = $this->crop( $i, $temp[0], $this->settings->featured_image_size_width, $this->settings->featured_image_size_height );
            }
        } else {
            return $return_array = array( 'image' => '', 'alt' => '' );
        }

        return $return_array = array( 'image' => $image, 'alt' => $alt );
    }


    /**
     * @method render_masonary_filters
     */
    public function render_masonary_filters() {

        $post_type = ( isset( $this->settings->post_type ) ) ? $this->settings->post_type : 'post';

        // Get taxonomies for given custom/default post type
        $taxonomies = get_object_taxonomies( $post_type, 'objects' );
        $data       = array();

        foreach($taxonomies as $tax_slug => $tax) {

            if(!$tax->public || !$tax->show_ui) {
                continue;
            }
            $data[$tax_slug] = $tax;
        }

        $taxonomies = $data;
        $cat = 'masonary_filter_' . $post_type;
        $tax_value = '';

        // Parse the categories
        if( isset( $this->settings->$cat ) ) {
            if( $this->settings->$cat != -1 ) {

                foreach($taxonomies as $tax_slug => $tax) {

                    $tax_value = '';
                    if( $this->settings->$cat == $tax_slug ) {
                        // New settings slug.
                        if(isset($this->settings->{'tax_' . $post_type . '_' . $tax_slug})) {
                            $tax_value = $this->settings->{'tax_' . $post_type . '_' . $tax_slug};
                        }
                        // Legacy settings slug.
                        else if(isset($this->settings->{'tax_' . $tax_slug})) {
                            $tax_value = $this->settings->{'tax_' . $tax_slug};
                        }
                        break;
                    }

                }
                $tax_value = ( $tax_value != '' ) ? explode( ',', $tax_value ) : array();

                $object_taxonomies = get_object_taxonomies( $post_type );

                if( !empty( $object_taxonomies ) ) {

                    $category_detail = get_terms( $this->settings->$cat );

                    if( count( $category_detail ) > 0 ) {

                        echo '<div class="uabb-masonary-filters-wrapper">';

                        $filter_type = 'uabb_masonary_filter_type_' . $post_type;
                        if( isset( $this->settings->$filter_type ) && $this->settings->$filter_type == "drop-down" ) {
                            echo '<select class="uabb-masonary-filters">';
                            echo '<option class="uabb-masonary-filter-' . $this->node . ' uabb-masonary-current" data-filter="*" value="all">'. __( 'All', 'uabb' ) .'</option>';

                                foreach( $category_detail as $cat_details ){
                                    if( !empty( $tax_value ) ) {
                                        if( in_array( $cat_details->term_id, $tax_value ) ) {
                                            echo '<option class="uabb-masonary-filter-' . $this->node . '" data-filter=".uabb-masonary-cat-' . $cat_details->slug . '">' . $cat_details->name . '</option>';
                                        }
                                    } else {
                                        echo '<option class="uabb-masonary-filter-' . $this->node . '" data-filter=".uabb-masonary-cat-' . $cat_details->slug . '">' . $cat_details->name . '</option>';
                                    }
                                }
                            echo '</select>';
                        }
                        else {
                                echo '<ul class="uabb-masonary-filters">';
                                echo '<li class="uabb-masonary-filter-' . $this->node . ' uabb-masonary-current" data-filter="*">' . __( 'All', 'uabb' ) . '</li>';
                                foreach( $category_detail as $cat_details ){
                                    if( !empty( $tax_value ) ) {
                                        if( in_array( $cat_details->term_id, $tax_value ) ) {
                                            echo '<li class="uabb-masonary-filter-' . $this->node . '" data-filter=".uabb-masonary-cat-' . $cat_details->slug . '">' . $cat_details->name . '</li>';
                                        }
                                    } else {
                                        echo '<li class="uabb-masonary-filter-' . $this->node . '" data-filter=".uabb-masonary-cat-' . $cat_details->slug . '">' . $cat_details->name . '</li>';
                                    }
                                }
                                echo '</ul>';
                        }
                        echo '</div>';
                    }

                }
            }
        }   
    }


    /**
     * @method render_featured_image
     */
    public function render_featured_image( $pos = 'top', $obj, $i ) {
        $html = '';
        // Match current Image position
        if( $pos == $this->settings->blog_image_position ) {

            $show_featured_image = ( isset( $this->settings->show_featured_image ) ) ? $this->settings->show_featured_image : 'yes';

            $link = apply_filters( 'uabb_blog_posts_link', get_permalink( $obj->ID ), $obj->ID, $this->settings );

            if( $show_featured_image == 'yes' ) {

                // Get image url + alt
                $img_data = $this->render_image_url( $i, $obj->ID );
                $img_url = $img_data['image'];

                if( $img_url != '' ) {
                    
                    if ( $this->settings->is_carousel == 'carousel' && $this->settings->lazyload == 'yes' ) {
                        $img_url = 'data-lazy="'.$img_url.'"';
                    }else{
                        $img_url = 'src="'.$img_url.'"';
                    }

                    ob_start();

                    $spacing_class = ( substr( $this->settings->layout_sort_order, 0, 3 ) == 'img' && $pos == 'top' ) ? '' : ' uabb-blog-post-section';
            ?>

            <div class="uabb-post-thumbnail <?php echo ( $this->settings->featured_image_size == 'custom' ) ? 'uabb-crop-thumbnail' : ''; ?> <?php echo $spacing_class; ?>">

            <?php do_action( 'uabb_blog_posts_before_image', $obj->ID, $this->settings ); ?>
                <?php $nofollow = ( isset( $this->settings->link_nofollow ) ) ? $this->settings->link_nofollow : '0'; ?>
                <a href="<?php echo $link; ?>" target="<?php echo $this->settings->link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $this->settings->link_target, $nofollow, 1 ); ?> title="<?php the_title_attribute(); ?>">
                <img <?php echo $img_url; ?> alt="<?php echo $img_data['alt']; ?>" />
                </a>

            <?php do_action( 'uabb_blog_posts_after_image', $obj->ID, $this->settings ); ?>
                    <?php
                    if( $this->settings->show_date_box == 'yes' ) {
                        $date_box_format = ( isset( $this->settings->date_box_format ) ) ? $this->settings->date_box_format : 'M j, Y';
                        switch( $date_box_format ) {

                            case 'M j Y':
                                $month = 'M';
                                $day = 'j';
                                $year = 'Y';
                                break;

                            case 'F j Y':
                                $month = 'F';
                                $day = 'j';
                                $year = 'Y';
                                break;

                            case 'm d Y':
                                $month = 'm';
                                $day = 'd';
                                $year = 'Y';
                                break;

                            case 'd m Y':
                                $month = 'd';
                                $day = 'm';
                                $year = 'Y';
                                break;

                            case 'Y m d' :
                                $month = 'Y';
                                $day = 'm';
                                $year = 'd';
                                break;

                            default:
                                $month = 'M';
                                $day = 'j';
                                $year = 'Y';
                                break;
                        }
                    ?>
                    <div class="uabb-next-date-meta">
                        <<?php echo $this->settings->date_tag_selection; ?> class="uabb-posted-on">
                            <time class="uabb-entry-date uabb-published uabb-updated" datetime="<?php echo date_i18n( 'c', strtotime( $obj->post_date ) ); ?>">
                                <span class="uabb-date-month"><?php echo date_i18n( $month, strtotime( $obj->post_date ) ); ?></span>
                                <span class="uabb-date-day"><?php echo date_i18n( $day, strtotime( $obj->post_date ) ); ?></span>
                                <span class="uabb-date-year"><?php echo date_i18n( $year, strtotime( $obj->post_date ) ); ?></span>
                            </time>
                        </<?php echo $this->settings->date_tag_selection; ?>>
                    </div>
                    <?php
                    }
                    ?>
            </div>

            <?php
                    $html = ob_get_contents();
                    ob_end_clean();
                }
            }
        }
        return $html;
    }

    
    /**
     * @method render_title_section
     * @protected
     */
    protected function render_title_section( $obj ) {
        $show_title = ( isset( $this->settings->show_title ) ) ? $this->settings->show_title : 'yes';
        if( $show_title == 'yes' ) {
        ?>
            <<?php echo $this->settings->title_tag_selection; ?> class="uabb-post-heading uabb-blog-post-section">
                 <a href="<?php echo apply_filters( 'uabb_blog_posts_link', get_permalink( $obj->ID ), $obj->ID ); ?>" title="<?php the_title_attribute(); ?>" tabindex="0" class=""><?php the_title(); ?></a>
            </<?php echo $this->settings->title_tag_selection; ?>>
        <?php
        }
    }


    /**
     * @method render_content_section
     * @protected
     */
    protected function render_content_section( $obj ) {

        // Predefined variables
        $show_excerpt = ( isset( $this->settings->show_excerpt ) ) ? $this->settings->show_excerpt : 'yes';

        $content_type = ( isset( $this->settings->content_type ) ) ? $this->settings->content_type : 'excerpt';

        $excerpt_count = ( isset( $this->settings->excerpt_count ) ) ? $this->settings->excerpt_count : '';

        $strip_html = ( isset( $this->settings->strip_content_html ) ) ? $this->settings->strip_content_html : 'yes';

        $content = '';
        $txt = '';

        if( $show_excerpt == 'yes' ) {
            if( $content_type == 'excerpt' ) {
                $content = get_the_excerpt( $obj->ID );
            } else {
                $txt = $obj->post_content;
                $txt = do_shortcode ( $txt );
                
                if( $content_type == 'custom' ) {
                    if( $excerpt_count != '' ) { 
                        $content = wp_trim_words ( $txt, $excerpt_count, ' ...' );
                    } else {
                        $content = wp_trim_words ( $txt, 55, ' ...' );      
                    }
                } else {
                    $content = $txt;
                }
            }
            $content_count = strlen( $content );

            if( $content_count != 0 ) {
                if( $content_type == 'excerpt' && $strip_html == 'no' ) {
                ?>
                    <div class="uabb-blog-posts-description uabb-blog-post-section uabb-text-editor"><?php echo apply_filters('uabb_blog_posts_excerpt', the_excerpt(), $this->settings ); ?></div>
                <?php
                } elseif ( $content_type == 'content' && $strip_html == 'no' ) { ?>
                    <div class="uabb-blog-posts-description uabb-blog-post-section uabb-text-editor"><?php echo apply_filters('uabb_blog_posts_excerpt', the_content(), $this->settings ); ?></div>
                <?php
                } else { ?>
                    <div class="uabb-blog-posts-description uabb-blog-post-section uabb-text-editor"><?php echo apply_filters('uabb_blog_posts_excerpt',$content, $this->settings); ?></div>
                <?php
                }
            }
        }
    }


    /**
     * @method render_author_section
     * @protected
     */
    protected function render_author_section( $obj ) {
        $show_author = ( isset( $this->settings->show_author ) ) ? $this->settings->show_author : 'yes';
        ob_start();
        if( $show_author == 'yes' ) {
        ?>
            <?php _e( 'By', 'uabb' ); ?><span class="uabb-posted-by"> <a class="url fn n" href="<?php echo get_author_posts_url( $obj->post_author ); ?>"><?php

                $author = ( get_the_author_meta( 'display_name', $obj->post_author ) != '' ) ? get_the_author_meta( 'display_name', $obj->post_author ) : get_the_author_meta( 'user_nicename', $obj->post_author );

                echo $author; ?></a>
            </span> 
            <?php
        }
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }


    /**
     * @method render_date_section
     * @protected
     */
    protected function render_date_section( $obj ) {

        $show_date = ( isset( $this->settings->show_date ) ) ? $this->settings->show_date : 'yes';
        $date_format = ( isset( $this->settings->date_format ) ) ? $this->settings->date_format : 'M j, Y';

        ob_start();

        if( $show_date == 'yes' ){
        ?>
            <span class="uabb-meta-date"><?php echo date_i18n( $date_format, strtotime( $obj->post_date ) ); ?>
            </span>
        <?php
        }

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }


    /**
     * @method render_taxonomy_section
     * @protected
     */
    protected function render_taxonomy_section( $obj ) {
        $show_categories = ( isset( $this->settings->show_categories ) ) ? $this->settings->show_categories : 'no';
        $show_tags = ( isset( $this->settings->show_tags ) ) ? $this->settings->show_tags : 'no';
        $category_detail = array();

        ob_start();

        if( $show_categories == 'yes' ) {
            $post_type = ( isset( $this->settings->post_type ) ) ? $this->settings->post_type : 'post';
            $object_taxonomies = get_object_taxonomies( $post_type );
            if( !empty( $object_taxonomies ) ) {
                $category_detail = wp_get_post_terms( $obj->ID, $object_taxonomies[0] );

                if( count( $category_detail ) > 0 ) {

                    for( $j = 0; $j < count( $category_detail ); $j++ ){
                ?><span class="uabb-cat-links"><a href="<?php echo get_term_link( $category_detail[$j]->term_id ); ?>" rel="category tag"><?php echo $category_detail[$j]->name; ?></a></span><?php
                        echo ( $j+1 != count( $category_detail ) ) ? trim(',&nbsp;') : '';
                    }
                }
            }
        }
        
        if( $show_tags == 'yes' ) {

            $tag_detail = get_the_tags( $obj->ID );
            if( $tag_detail != '' ) {
                echo ( count( $category_detail ) > 0 ) ? ', ' : '';
                for( $k = 0; $k < count( $tag_detail ); $k++ ){
            ?><span class="uabb-tag-links"><a href="<?php echo get_tag_link( $tag_detail[$k]->term_id ); ?>" rel="category tag"><?php echo $tag_detail[$k]->name; ?></a></span><?php
                    echo ( $k+1 != count( $tag_detail ) ) ? trim(',&nbsp;') : '';
                }
            }
        }

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    /**
     * @method render_comment_section
     * @protected
     */
    protected function render_comment_section( $obj ) {
        $show_comments = ( isset( $this->settings->show_comments ) ) ? $this->settings->show_comments : 'no';

        ob_start();

        if( $show_comments == 'yes' ) {

            if( $obj->comment_count > 0 ) {
            ?><span class="uabb-comments-link"><a href="<?php echo get_permalink( $obj->ID ); ?>#comments"><?php echo $obj->comment_count; ?> <?php echo ( $obj->comment_count > 1 ) ? __( 'Comments', 'uabb' ) : __( 'Comment', 'uabb' ); ?></a></span>
            <?php
            }
        }

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }


    /**
     * @method render_meta_section
     * @protected
     */
    protected function render_meta_section( $obj ) {

        $show_author = ( isset( $this->settings->show_author ) ) ? $this->settings->show_author : 'yes';
        $show_meta = ( isset( $this->settings->show_meta ) ) ? $this->settings->show_meta : 'yes';
        $show_categories = ( isset( $this->settings->show_categories ) ) ? $this->settings->show_categories : 'no';
        $show_tags = ( isset( $this->settings->show_tags ) ) ? $this->settings->show_tags : 'no';
        $show_comments = ( isset( $this->settings->show_comments ) ) ? $this->settings->show_comments : 'no';
        $show_date = ( isset( $this->settings->show_date ) ) ? $this->settings->show_date : 'yes';

        $output = '';

        if( $show_meta == 'yes' ) {
            if( $show_author == 'yes' || $show_categories == 'yes' || $show_tags == 'yes' || $show_comments == 'yes' || $show_date == 'yes' ) {
        ?>
                <<?php echo $this->settings->meta_tag_selection; ?> class="uabb-post-meta uabb-blog-post-section">
                <?php
                    $meta_order = explode( ',', $this->settings->meta_sort_order );

                    for( $i = 0; $i < count( $meta_order ); $i++ ) {
                        switch ( $meta_order[$i] ) {
                            case 'author':
                                $output = $this->render_author_section( $obj );
                                break;

                             case 'date':
                                $output = $this->render_date_section( $obj );
                                break;

                             case 'taxonomy':
                                $output = $this->render_taxonomy_section( $obj );
                                break;

                             case 'comment':
                                $output = $this->render_comment_section( $obj );
                                break;
                            
                            default:
                                // Nothing to do here
                                break;
                        }
                        $output_array[] = $output;
                    }
                    $meta_html = implode( ' | ' , array_filter( $output_array ) );
                    echo $meta_html;
                ?>
                </<?php echo $this->settings->meta_tag_selection; ?>>
        <?php
            }
        }
    }

    /**
     * @method render_blog_content
     */
    public function render_blog_content( $obj, $i ) {
        
        $link = apply_filters( 'uabb_blog_posts_link', get_permalink( $obj->ID ), $obj->ID, $this->settings );
        $show_title = ( isset( $this->settings->show_title ) ) ? $this->settings->show_title : 'yes';
        $show_excerpt = ( isset( $this->settings->show_excerpt ) ) ? $this->settings->show_excerpt : 'yes';
        $show_author = ( isset( $this->settings->show_author ) ) ? $this->settings->show_author : 'yes';
        $show_meta = ( isset( $this->settings->show_meta ) ) ? $this->settings->show_meta : 'yes';
        $show_categories = ( isset( $this->settings->show_categories ) ) ? $this->settings->show_categories : 'no';
        $show_tags = ( isset( $this->settings->show_tags ) ) ? $this->settings->show_tags : 'no';
        $show_comments = ( isset( $this->settings->show_comments ) ) ? $this->settings->show_comments : 'no';
        $show_date = ( isset( $this->settings->show_date ) ) ? $this->settings->show_date : 'yes';

        if( $show_meta == 'yes' && ( $show_author == 'yes' || $show_categories == 'yes' || $show_tags == 'yes' || $show_comments == 'yes' || $show_date == 'yes' ) ) {
            $meta_flag = true;
        } else {
            $meta_flag = false;
        }
        $img_html = '';
        if( substr( $this->settings->layout_sort_order, 0, 3 ) != 'img' && substr( $this->settings->layout_sort_order, -3 ) != 'img' ) {
            $img_html = $this->render_featured_image( 'top', $obj, $i );
        }

        if( $show_title == 'yes' || $show_excerpt == 'yes' || $this->settings->cta_type != 'none' || $meta_flag || $img_html != '' ) {
        ?>
        <div class="uabb-blog-post-content">
        <?php
            $layout_sequence = explode( ',', $this->settings->layout_sort_order );

            foreach( $layout_sequence as $sq ) {
                switch ( $sq ) {
                    case 'img' :
                        if( substr( $this->settings->layout_sort_order, 0, 3 ) != 'img' && substr( $this->settings->layout_sort_order, -3 ) != 'img' ) {
                            echo $this->render_featured_image( 'top', $obj, $i );
                        }
                        break;
                    case 'title':
                        do_action( 'uabb_blog_posts_before_title', $obj->ID, $this->settings );
                        $this->render_title_section( $obj );
                        do_action( 'uabb_blog_posts_after_title', $obj->ID, $this->settings );
                        break;

                     case 'content':
                        do_action( 'uabb_blog_posts_before_content', $obj->ID, $this->settings );
                        $this->render_content_section( $obj );
                        do_action( 'uabb_blog_posts_after_content', $obj->ID, $this->settings );
                        break;

                     case 'meta':
                        do_action( 'uabb_blog_posts_before_meta', $obj->ID, $this->settings );
                        $this->render_meta_section( $obj );
                        do_action( 'uabb_blog_posts_after_meta', $obj->ID, $this->settings);
                        break;

                     case 'cta':
                        $this->render_button( $link, $this->settings->link_target );
                        break;

                    default:
                        // Nothing to do here
                        break;
                }
            }
        ?>
        </div>
        <?php
        }
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('BlogPostsModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => '', // Section Title
                'fields'        => array(
                    'is_carousel'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Post Appearance', 'uabb' ),
                        'default'       => 'grid',
                        'help' => __( 'This is how your posts you want to display.', 'uabb' ),
                        'options'       => array(
                            'carousel'  => __( 'Carousel', 'uabb' ),
                            'grid'    => __( 'Grid', 'uabb' ),
                            'feed'    => __( 'Feeds', 'uabb' ),
                            'masonary' => __( 'Masonry', 'uabb' )
                        ),
                        'toggle' => array(
                            'masonary' => array(
                                'fields' => array( 'mesonry_equal_height' )
                            )
                        )
                    ),
                )
            ),
            'grid_filter' => array(
                'title' => __( 'Number of Posts to Show ', 'uabb' ),
                'fields' => array(
                    'post_per_grid' => array(
                        'type'          => 'select',
                        'label' => __('Desktop', 'uabb'),
                        'help' => __( 'This is how many grid columns you want to show.', 'uabb' ),
                        'default' => '3',
                        'options'       => array(
                            '1'      => __('1 Column', 'uabb'),
                            '2'      => __('2 Columns', 'uabb'),
                            '3'      => __('3 Columns', 'uabb'),
                            '4'      => __('4 Columns', 'uabb'),
                            '5'      => __('5 Columns', 'uabb'),
                            '6'      => __('6 Columns', 'uabb'),
                            '7'      => __('7 Columns', 'uabb'),
                            '8'      => __('8 Columns', 'uabb')
                        ),
                    ),
                    'post_per_grid_desktop' => array(
                        'type'          => 'select',
                        'label' => __('Desktop', 'uabb'),
                        'default' => '3',
                        'help' => __( 'This is how many posts you want to show at one time on desktop.', 'uabb' ),
                        'options'       => array(
                            '1'      => __('1 Column', 'uabb'),
                            '2'      => __('2 Columns', 'uabb'),
                            '3'      => __('3 Columns', 'uabb'),
                            '4'      => __('4 Columns', 'uabb'),
                            '5'      => __('5 Columns', 'uabb'),
                            '6'      => __('6 Columns', 'uabb'),
                            '7'      => __('7 Columns', 'uabb'),
                            '8'      => __('8 Columns', 'uabb')
                        ),
                    ),
                    'post_per_grid_medium' => array(
                        'type'          => 'select',
                        'label' => __('Medium Devices', 'uabb'),
                        'default' => '2',
                        'help' => __( 'This is how many posts you want to show at one time on tablet devices.', 'uabb' ),
                        'options'       => array(
                            '1'      => __('1 Column', 'uabb'),
                            '2'      => __('2 Columns', 'uabb'),
                            '3'      => __('3 Columns', 'uabb'),
                            '4'      => __('4 Columns', 'uabb'),
                            '5'      => __('5 Columns', 'uabb'),
                            '6'      => __('6 Columns', 'uabb'),
                            '7'      => __('7 Columns', 'uabb'),
                            '8'      => __('8 Columns', 'uabb')
                        ),
                    ),
                    'post_per_grid_small' => array(
                        'type'          => 'select',
                        'label' => __('Small Devices', 'uabb'),
                        'default' => '1',
                        'help' => __( 'This is how many posts you want to show at a time on mobile devices.', 'uabb' ),
                        'options'       => array(
                            '1'      => __('1 Column', 'uabb'),
                            '2'      => __('2 Columns', 'uabb'),
                            '3'      => __('3 Columns', 'uabb'),
                            '4'      => __('4 Columns', 'uabb'),
                            /*'5'      => __('5 Columns', 'uabb'),
                            '6'      => __('6 Columns', 'uabb'),
                            '7'      => __('7 Columns', 'uabb'),
                            '8'      => __('8 Columns', 'uabb')*/
                        ),
                    ),
                )
            ),
            'carousel_filter' => array(
                'title' => __( 'Carousel Filter', 'uabb' ),
                'fields' =>  array(
                    'slides_to_scroll'  => array(
                        'type'          => 'text',
                        'label'         => __('Posts to Scroll', 'uabb'),
                        'help'          => __( 'This is how many posts you want to scroll at a time.', 'uabb' ),
                        'placeholder'   => '1',
                        'size'          => '8',
                    ),
                    'autoplay'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Autoplay Post Scroll', 'uabb' ),
                        'help'          => __( 'Enables auto play of posts.', 'uabb' ),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                        'toggle' => array(
                            'yes' => array(
                                'fields' => array( 'animation_speed' )
                            )
                        )
                    ),
                    'animation_speed' => array(
                        'type'          => 'text',
                        'label'         => __('Autoplay Speed', 'uabb'),
                        'help'          => __( 'Enter the time interval to scroll post automatically.', 'uabb' ),
                        'placeholder'   => '1000',
                        'size'          => '8',
                        'description'   => __( 'ms', 'uabb' )
                    ),
                    'infinite_loop'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Infinite Loop', 'uabb' ),
                        'help'          => __( 'Enable this to scroll posts in infinite loop.', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'lazyload'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Enable Lazy Load', 'uabb' ),
                        'help'          => __( 'Enable this to load the image as soon as user slide to it.', 'uabb' ),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'enable_arrow' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Enable Arrows', 'uabb' ),
                        'help'          => __( 'Enable Next/Prev arrows to your carousel slider.', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'arrow_position' => array(
                        'type'          => 'select',
                        'label'         => __( 'Arrow Position', 'uabb' ),
                        'default'       => 'outside',
                        'options'       => array(
                            'outside'   => __( 'Outside', 'uabb' ),
                            'inside'    => __( 'Inside', 'uabb' ),
                        ),
                    ),
                    'icon_left'          => array(
                        'type'          => 'icon',
                        'label'         => __('Left Arrow Icon', 'uabb'),
                        'show_remove' => true
                    ),
                    'icon_right'          => array(
                        'type'          => 'icon',
                        'label'         => __('Right Arrow Icon', 'uabb'),
                        'show_remove' => true
                    ),
                    'arrow_style'       => array(
                        'type'          => 'select',
                        'label'         => __('Arrow Style', 'uabb'),
                        'default'       => 'circle',
                        'options'       => array(
                            'square'             => __('Square Background', 'uabb'),
                            'circle'             => __('Circle Background', 'uabb'),
                            'square-border'      => __('Square Border', 'uabb'),
                            'circle-border'      => __('Circle Border', 'uabb')
                        ),
                        'toggle'        => array(
                            'square-border' => array(
                                'fields'        => array( 'arrow_color', 'arrow_color_border', 'arrow_border_size' )
                            ),
                            'circle-border' => array(
                                'fields'        => array( 'arrow_color', 'arrow_color_border', 'arrow_border_size' )
                            ),
                            'square' => array(
                                'fields'        => array( 'arrow_color', 'arrow_background_color', 'arrow_background_color_opc' )
                            ),
                            'circle' => array(
                                'fields'        => array( 'arrow_color', 'arrow_background_color', 'arrow_background_color_opc' )
                            ),
                        )
                    ),
                    'arrow_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Arrow Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'arrow_background_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Arrow Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'arrow_background_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'arrow_color_border' => array( 
                        'type'       => 'color',
                        'label'         => __('Arrow Border Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'arrow_border_size'       => array(
                        'type'          => 'text',
                        'label'         => __('Border Size', 'uabb'),
                        'default'       => '1',
                        'description'   => 'px',
                        'size'          => '8',
                        'max_lenght'    => '3'
                    ),
                )
            ),
        )
    ),
    'post_type_filter' => array(
        'title'         => __('Query', 'uabb'),
        'file'          => plugin_dir_path( __FILE__ ) . 'includes/loop-settings.php',
    ),
    'uabb_controls' => array(
        'title'         => __('Controls', 'uabb'),
        'sections'          => array(
            'image_settings' => array(
                'title' => __( 'Featured Image', 'uabb' ),
                'fields' => array(
                    'show_featured_image' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Display Featured Image', 'uabb' ),
                        'help'          => __('Enable this to display featured image of posts in a module.', 'uabb'),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'featured_image_size' => array(
                        'type'          => 'select',
                        'label'         => __( 'Featured Image Size', 'uabb' ),
                        'default'       => 'medium',
                        'help'          => __( 'Select featured image size. *For custom size - please clear page builder cache to take changes in effect.', 'uabb' ),
                        'options'       => apply_filters('uabb_blog_posts_featured_image_sizes', array(
                                'full' => __( 'Full', 'uabb' ),
                                'large' => __( 'Large', 'uabb' ),
                                'medium' => __( 'Medium', 'uabb' ),
                                'thumbnail' => __( 'Thumbnail', 'uabb' ),
                                'custom' => __( 'Custom', 'uabb' ),
                            )
                        ),
                    ),
                    'featured_image_size_width' => array(
                        'type'          => 'text',
                        'label'         => __( 'Custom Image Width', 'uabb' ),
                        'description'   => 'px',
                        'size'          => '8'
                    ),
                    'featured_image_size_height' => array(
                        'type'          => 'text',
                        'label'         => __( 'Custom Image Height', 'uabb' ),
                        'description'   => 'px',
                        'size'          => '8'
                    ),
                )
            ),
            'title_settings' => array(
                'title' => __( 'Title', 'uabb' ),
                'fields' => array(
                    'show_title' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Display Title', 'uabb' ),
                        'help'          => __('Enable this to display title of posts in a module.', 'uabb'),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                        'toggle' => array(
                            'yes' => array(
                                'sections' => array( 'title_typography' )
                            )
                        )
                    ),
                )
            ),
            'meta_settings' => array(
                'title' => __( 'Post Meta', 'uabb' ),
                'fields' => array(
                    'show_meta' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Display Meta Information', 'uabb' ),
                        'help'          => __('Enable this to display post meta information in a module.', 'uabb'),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                        'toggle'    => array(
                            'yes'    => array(
                                /*'fields'    => array( 'show_author', 'show_date', 'show_categories', 'show_tags', 'show_comments' ),*/
                                'sections' => array( 'meta_typography' )
                            )
                        ),
                    ),
                    'show_author' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Author', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'show_date' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Date', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                        'toggle' => array(
                            'yes' => array(
                                'fields' => array( 'date_format' )
                            )
                        )
                    ),
                    'date_format' => array(
                        'type'          => 'select',
                        'label'         => __('Date Format', 'uabb'),
                        'default'       => 'M j, Y',
                        'options'       => array(
                            'M j, Y'        => date_i18n('M j, Y'),
                            'F j, Y'        => date_i18n('F j, Y'),
                            'm/d/Y'         => date_i18n('m/d/Y'),
                            'm-d-Y'         => date_i18n('m-d-Y'),
                            'm.d.Y'         => date_i18n('m.d.Y'),
                            'd M Y'         => date_i18n('d M Y'),
                            'd F Y'         => date_i18n('d F Y'),
                            'd-m-Y'         => date_i18n('d-m-Y'),
                            'd.m.Y'         => date_i18n('d.m.Y'),
                            'd/m/Y'         => date_i18n('d/m/Y'),
                            'Y-m-d'         => date_i18n('Y-m-d'),
                            'Y.m.d'         => date_i18n('Y.m.d'),
                            'Y/m/d'         => date_i18n('Y/m/d'),
                            'M, Y'        => date_i18n('M, Y'),
                            'M Y'        => date_i18n('M Y'),
                            'F, Y'        => date_i18n('F, Y'),
                            'F Y'        => date_i18n('F Y'),
                        )
                    ),
                    'show_categories' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Categories', 'uabb' ),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'show_tags' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Tags', 'uabb' ),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'show_comments' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Comments', 'uabb' ),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                )
            ),
            'excerpt_settings' => array(
                'title' => __( 'Content', 'uabb' ),
                'fields' => array(
                    'show_excerpt' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Display Content', 'uabb' ),
                        'help'          => __('Enable this to display content of posts in a module.', 'uabb'),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'content_type' => array(
                        'type'          => 'select',
                        'label'         => __( 'Content Type', 'uabb' ),
                        'default'       => 'excerpt',
                        'options'       => array(
                            'excerpt'   => __( 'Excerpt', 'uabb' ),
                            'content'   => __( 'Full Content', 'uabb' ),
                            'custom'    => __( 'Custom Word Count', 'uabb' ),
                        ),
                        'toggle'    => array(
                            'excerpt'    => array(
                                'fields' => array( 'strip_content_html' )
                            ),
                            'content'    => array(
                                'fields' => array( 'strip_content_html' )
                            ),
                            'custom'    => array(
                                'fields' => array( 'excerpt_count' )
                            )
                        )
                    ),
                    'strip_content_html' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Remove Line Breaks', 'uabb' ),
                        'help'          => __('Enable this to display content without paragraphs and line breaks.', 'uabb'),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'excerpt_count' => array(
                        'type'      => 'text',
                        'label'     => __('Excerpt Count', 'uabb'),
                        'help'      => __('Enter the value to limit post content words. Keep it empty for default excerpt', 'uabb'),
                        'default'   => '18',
                        'size'      => '8',
                    ),
                )
            ),
            'cta'           => array(
                'title'         => __('Call to Action', 'uabb'),
                'fields'        => array(
                    'cta_type'      => array(
                        'type'          => 'select',
                        'label'         => __('Type', 'uabb'),
                        'help'          => __( 'Select the call to action type for your posts.', 'uabb' ),
                        'default'       => 'link',
                        'options'       => array(
                            'none'          => _x( 'None', 'Call to action.', 'uabb' ),
                            'link'          => __('Text', 'uabb'),
                            'button'        => __('Button', 'uabb'),
                        ),
                        'toggle'        => array(
                            'none'          => array(),
                            'link'          => array(
                                'fields'        => array( 'cta_text', 'link_target' ),
                                'sections'      => array( 'link_typography' )
                            ),
                            'button'        => array(
                                'sections'      => array( 'btn-colors', 'btn-icon', 'btn-style', 'btn-structure', 'btn_typography'),
                                'fields' => array( 'btn_text', 'link_target' )
                            ),

                        )
                    ),
                    'cta_text'      => array(
                        'type'          => 'text',
                        'label'         => __('Enter Text', 'uabb'),
                        'help'          => __( 'Enter the text for your call to action link.', 'uabb' ),
                        'default'       => __('Read More', 'uabb'),
                    ),
                    'btn_text'          => array(
                        'type'          => 'text',
                        'label'         => __('Enter Text', 'uabb'),
                        'help'          => __( 'Enter the text for your call to action button.', 'uabb' ),
                        'default'       => __('Click Here', 'uabb'),
                    ),
                    'link_target'   => array(
                        'type'          => 'select',
                        'label'         => __('Link Target', 'uabb'),
                        'help'          => __( 'Controls where CTA link will open after click.', 'uabb' ),
                        'default'       => '_self',
                        'options'       => array(
                            '_self'         => __('Same Window', 'uabb'),
                            '_blank'        => __('New Window', 'uabb')
                        ),
                        'preview'       => array(
                            'type'          => 'none'
                        )
                    ),
                    'link_nofollow'   => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Link nofollow', 'uabb'),
                        'description'   => '',
                        'default'       => '0',
                        'help'          => __('Enable this to make this link nofollow', 'uabb'),
                        'options'       => array(
                            '1'       => __('Yes','uabb'),
                            '0'       => __('No','uabb'),
                        ),
                    ),
                )
            ),
            'btn-style'      => array(
                'title'         => __('Style', 'uabb'),
                'fields'        => array(
                    'btn_style'         => array(
                        'type'          => 'select',
                        'label'         => __('Style', 'uabb'),
                        'default'       => 'flat',
                        'class'         => 'creative_button_styles',
                        'options'       => array(
                            'flat'          => __('Flat', 'uabb'),
                            'gradient'      => __('Gradient', 'uabb'),
                            'transparent'   => __('Transparent', 'uabb'),
                            'threed'        => __('3D', 'uabb'),
                        ),
                    ),
                    'btn_border_size'   => array(
                        'type'          => 'text',
                        'label'         => __('Border Size', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '3',
                        'size'          => '5',
                        'placeholder'   => '2'
                    ),
                    'btn_transparent_button_options'         => array(
                        'type'          => 'select',
                        'label'         => __('Hover Styles', 'uabb'),
                        'default'       => 'transparent-fade',
                        'options'       => array(
                            'none'          => __('None', 'uabb'),
                            'transparent-fade'          => __('Fade Background', 'uabb'),
                            'transparent-fill-top'      => __('Fill Background From Top', 'uabb'),
                            'transparent-fill-bottom'      => __('Fill Background From Bottom', 'uabb'),
                            'transparent-fill-left'     => __('Fill Background From Left', 'uabb'),
                            'transparent-fill-right'     => __('Fill Background From Right', 'uabb'),
                            'transparent-fill-center'       => __('Fill Background Vertical', 'uabb'),
                            'transparent-fill-diagonal'     => __('Fill Background Diagonal', 'uabb'),
                            'transparent-fill-horizontal'  => __('Fill Background Horizontal', 'uabb'),
                        ),
                    ),
                    'btn_threed_button_options'         => array(
                        'type'          => 'select',
                        'label'         => __('Hover Styles', 'uabb'),
                        'default'       => 'threed_down',
                        'options'       => array(
                            'threed_down'          => __('Move Down', 'uabb'),
                            'threed_up'      => __('Move Up', 'uabb'),
                            'threed_left'      => __('Move Left', 'uabb'),
                            'threed_right'     => __('Move Right', 'uabb'),
                            'animate_top'     => __('Animate Top', 'uabb'),
                            'animate_bottom'     => __('Animate Bottom', 'uabb'),
                            /*'animate_left'     => __('Animate Left', 'uabb'),
                            'animate_right'     => __('Animate Right', 'uabb'),*/
                        ),
                    ),
                    'btn_flat_button_options'         => array(
                        'type'          => 'select',
                        'label'         => __('Hover Styles', 'uabb'),
                        'default'       => 'none',
                        'options'       => array(
                            'none'          => __('None', 'uabb'),
                            'animate_to_left'      => __('Appear Icon From Right', 'uabb'),
                            'animate_to_right'          => __('Appear Icon From Left', 'uabb'),
                            'animate_from_top'      => __('Appear Icon From Top', 'uabb'),
                            'animate_from_bottom'     => __('Appear Icon From Bottom', 'uabb'),
                        ),
                    ),
                )
            ),
            'btn-icon'       => array( // Section
                'title'         => __('Icons', 'uabb'),
                'fields'        => array(
                    'btn_icon'          => array(
                        'type'          => 'icon',
                        'label'         => __('Icon', 'uabb'),
                        'show_remove'   => true
                    ),
                    'btn_icon_position' => array(
                        'type'          => 'select',
                        'label'         => __('Icon Position', 'uabb'),
                        'default'       => 'before',
                        'options'       => array(
                            'before'        => __('Before Text', 'uabb'),
                            'after'         => __('After Text', 'uabb')
                        )
                    )
                )
            ),
            'btn-colors'     => array( // Section
                'title'         => __('Colors', 'uabb'),
                'fields'        => array(
                    'btn_text_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Text Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'btn_text_hover_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Text Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
                            'type'          => 'none'
                        )
                    ),
                    'btn_bg_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'btn_bg_color_opc'    => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),

                    'btn_bg_hover_color'        => array( 
                        'type'       => 'color',
                        'label'         => __('Background Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'       => array(
                            'type'          => 'none'
                        )
                    ),
                    'btn_bg_hover_color_opc'    => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'hover_attribute' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Apply Hover Color To', 'uabb' ),
                        'default'       => 'bg',
                        'options'       => array(
                            'border'    => __( 'Border', 'uabb' ),
                            'bg'        => __( 'Background', 'uabb' ),
                        ),
                        'width' => '75px'
                    ),
                )
            ),
            'btn-structure'  => array(
                'title'         => __('Structure', 'uabb'),
                'fields'        => array(
                    'btn_width'         => array(
                        'type'          => 'select',
                        'label'         => __('Width', 'uabb'),
                        'default'       => 'auto',
                        'options'       => array(
                            'auto'          => _x( 'Auto', 'Width.', 'uabb' ),
                            'full'          => __('Full Width', 'uabb'),
                            'custom'        => __('Custom', 'uabb')
                        ),
                        'toggle'        => array(
                            'auto'          => array(
                                'fields'        => array('btn_align', 'btn_mob_align')
                            ),
                            'full'          => array(
                                'fields'        => array( )
                            ),
                            'custom'        => array(
                                'fields'        => array('btn_align', 'btn_mob_align', 'btn_custom_width', 'btn_custom_height', 'btn_padding_top_bottom', 'btn_padding_left_right' )
                            )
                        )
                    ),
                    'btn_custom_width'  => array(
                        'type'          => 'text',
                        'label'         => __('Custom Width', 'uabb'),
                        'default'       => '200',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px'
                    ),
                    'btn_custom_height'  => array(
                        'type'          => 'text',
                        'label'         => __('Custom Height', 'uabb'),
                        'default'       => '45',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px'
                    ),
                    'btn_padding_top_bottom'       => array(
                        'type'          => 'text',
                        'label'         => __('Padding Top/Bottom', 'uabb'),
                        'placeholder'   => '0',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px'
                    ),
                    'btn_padding_left_right'       => array(
                        'type'          => 'text',
                        'label'         => __('Padding Left/Right', 'uabb'),
                        'placeholder'   => '0',
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px'
                    ),
                    'btn_border_radius' => array(
                        'type'          => 'text',
                        'label'         => __('Round Corners', 'uabb'),
                        'maxlength'     => '3',
                        'size'          => '4',
                        'description'   => 'px'
                    ),
                )
            ),
        ),
    ),
    'layout'    => array(
        'title'         => __('Layout', 'uabb'), // Tab title
        'sections'      => array( // Tab Section
            'post_styles' => array(
                'title' => __( 'Post Layout Sort Order', 'uabb' ),
                'fields' => array(
                    'blog_image_position' => array(
                        'type'          => 'select',
                        'label'         => __('Image Position', 'uabb'),
                        'default'       => 'top',
                        'options'       => array(
                            'top'           => __('Stacked', 'uabb'),
                            /*'bottom'        => __('Bottom', 'uabb'),*/
                            'left'          => __('Left', 'uabb'),
                            'right'         => __('Right', 'uabb'),
                            'background'    => __('Background', 'uabb'),
                        ),
                        'toggle' => array(
                            'background' => array(
                                'fields' => array( 'overlay_color', 'overlay_color_opc' )
                            ),
                        )
                    ),
                    'overlay_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Overlay Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'overlay_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'mobile_structure' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Mobile Structure', 'uabb'),
                        'default'       => 'inline',
                        'options'       => array(
                            'inline'    => __('Inline', 'uabb'),
                            'stack'     => __('Stack', 'uabb'),
                        ),
                    ),
                    /*'stacking_order' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Stacking Order', 'uabb'),
                        'default'       => 'default',
                        'options'       => array(
                            'reversed'    => __('Revered', 'uabb'),
                            'default'     => __('Default', 'uabb'),
                        ),
                    ),*/
                    'layout_sort_order' => array(
                        'type' => 'uabb-sortable',
                        'label' => __('', 'uabb'),
                        'default' => 'img,title,meta,content,cta',
                        'options' => array(
                            'img' => __('Featured Image','uabb'),
                            'title' => __('Title', 'uabb'),
                            'meta' => __('Meta', 'uabb'),
                            'content' => __('Content', 'uabb'),
                            'cta' => __('CTA', 'uabb'),
                        ),
                    ),
                )
            ),
            'meta_sort_order' => array(
                'title' => __( 'Post Meta Sort Order', 'uabb' ),
                'fields' => array(
                    'meta_sort_order' => array(
                        'type' => 'uabb-sortable',
                        'label' => __('', 'uabb'),
                        'default' => 'author,date,taxonomy,comment',
                        'options' => array(
                            'author'    => __('Author', 'uabb'),
                            'date'      => __('Date', 'uabb'),
                            'taxonomy'  => __('Taxonomy', 'uabb'),
                            'comment'   => __('Comment', 'uabb'),
                        ),
                    )
                )
            ) 
        )
    ),
    'style'       => array( // Tab
        'title'         => __('Style', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'alignment' => array(
                'title' => __( '', 'uabb' ),
                'fields' => array(
                    'overall_alignment' => array(
                        'type'          => 'select',
                        'label' => __('Overall Alignment', 'uabb'),
                        'help'         => __('Controls the content alignment of each individual post.', 'uabb'),
                        'default'       => 'center',
                        'options'       => array(
                            'center' => __( 'Center', 'uabb' ),
                            'left' => __( 'Left', 'uabb' ),
                            'right' => __( 'Right', 'uabb' ),
                        ),
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-blog-post-content',
                            'property'      => 'text-align',
                        )
                    ),
                    'overall_padding' => array(
                        'type'      => 'uabb-spacing',
                        'label'     => __( 'Overall Padding', 'uabb' ),
                        'help'         => __('Manage the outside spacing of entire area of post.', 'uabb'),
                        'default'   => 'padding: 0px;',    //optional
                        'mode'      => 'padding',
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-blog-post-inner-wrap',
                            'property'      => 'padding',
                            'unit'          => 'px',
                        )
                    ),
                    'element_space' => array(
                        'type' => 'text',
                        'label' => __('Space Between Posts', 'uabb'),
                        'size' => '8',
                        'placeholder' => '15',
                        'description' => 'px',
                        'help'         => __('Manage the spacing between two posts.', 'uabb'),
                    ),
                    'below_element_space' => array(
                        'type' => 'text',
                        'label' => __('Bottom Spacing', 'uabb'),
                        'size' => '8',
                        'placeholder' => '30',
                        'description' => 'px',
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-post-wrapper',
                            'property'      => 'margin-bottom',
                            'unit'          => 'px',
                        )
                    ),
                    'show_box_shadow'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Box Shadow', 'uabb' ),
                        'help'         => __('Enable this to display box shadow for each individual post.', 'uabb'),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'show_date_box'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Date Box', 'uabb' ),
                        'help'         => __('Enable this to display date box at top left corner of each individual post.', 'uabb'),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                        'toggle' => array(
                            'yes' => array(
                                'fields' => array( 'date_box_format' ),
                                'sections' => array( 'date_typography' )
                            )
                        )
                    ),
                    'date_box_format' => array(
                        'type'          => 'select',
                        'label'         => __('Date Format', 'uabb'),
                        'default'       => 'M j, Y',
                        'options'       => array(
                            'M j Y'        => date_i18n('M j Y'),
                            'F j Y'        => date_i18n('F j Y'),
                            'm d Y'         => date_i18n('m d Y'),
                            'd m Y'         => date_i18n('d m Y'),
                            'Y m d'         => date_i18n('Y m d'),
                        )
                    ),
                    'equal_height_box'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Equal Height Boxes', 'uabb' ),
                        'help'         => __('Enable this to display all posts with same height.', 'uabb'),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'mesonry_equal_height'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Masonry Equal Height', 'uabb' ),
                        'help'         => __('Enable this to display all posts with same height.', 'uabb'),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                )
            ),
            'style' => array(
                'title' => __( 'Content Area Styling', 'uabb' ),
                'fields' => array(
                    'content_padding' => array(
                        'type'      => 'uabb-spacing',
                        'label'     => __( 'Content Padding', 'uabb' ),
                        'help'         => __('Manage the outside spacing of content area of post.', 'uabb'),
                        'default'   => 'padding: 25px;',    //optional
                        'mode'      => 'padding',
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-blog-post-content',
                            'property'      => 'padding',
                            'unit'          => 'px',
                        )
                    ),
                    'content_background_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Content Background Color', 'uabb'),
                        'default'       => 'f6f6f6',
                        'help'         => __('Controls the background color of content area (Area below the featured image).', 'uabb'),
                        'show_reset' => true,
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-blog-posts-shadow',
                            'property'      => 'background',
                        )
                    ),
                    'content_background_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),

                )
            ),
            'pagination_setting' => array(
                'title' => __('Pagination', 'uabb'),
                'fields' => array(
                    'show_pagination' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Pagination', 'uabb' ),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                        'toggle'    => array(
                            'yes'   => array(
                                'fields' => array( 'pagination' ),
                            )
                        )
                    ),
                    'pagination' => array(
                        'type'          => 'select',
                        'label'         => __('Pagination Style', 'uabb'),
                        'default'       => 'numbers',
                        'options'       => array(
                            'numbers'       => __('Numbers', 'uabb'),
                            'scroll'        => __('Scroll', 'uabb'),
                            // 'none'          => _x( 'None', 'Pagination style.', 'uabb' ),
                        ),
                        'toggle'    => array(
                            'numbers' => array(
                                'sections' => array( 'pagination_style' )
                            ),
                            'scroll' => array(
                                'fields' => array( 'show_paginate_loader' )
                            )
                        )
                    ),
                    'show_paginate_loader' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Loader', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'       => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                    ),
                    'posts_per_page' => array(
                        'type'          => 'text',
                        'label'         => __('Posts Per Page', 'uabb'),
                        'placeholder'       => '10',
                        'size'          => '8'
                    ),
                    'no_results_message' => array(
                        'type'              => 'text',
                        'label'             => __( 'No Results Message', 'uabb' ),
                        'default'           => __( "Sorry, we couldn't find any posts. Please try a different search.", 'uabb' ),
                    ),
                    'show_search'    => array(
                        'type'          => 'select',
                        'label'         => __( 'Show Search', 'uabb' ),
                        'default'       => '1',
                        'options'       => array(
                            '1'             => __( 'Show', 'uabb' ),
                            '0'             => __( 'Hide', 'uabb' ),
                        ),
                        'help'          => __( 'Shows the search form if no posts are found.', 'uabb' ),
                    ),
                )
            ),
            'pagination_style' => array(
                'title' => __('Pagination Style', 'uabb'),
                'fields' => array(
                    'pagination_alignment'       => array(
                        'type'          => 'select',
                        'label'         => __('Pagination Alignment', 'uabb'),
                        'default'       => 'center',
                        'options'       => array(
                            'left'             => __('Left', 'uabb'),
                            'right'             => __('Right', 'uabb'),
                            'center'      => __('Center', 'uabb'),
                        ),
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-blogs-pagination ul',
                            'property'      => 'text-align',
                        )
                    ),
                    'pagination_style'       => array(
                        'type'          => 'select',
                        'label'         => __('Pagination Button Style', 'uabb'),
                        'default'       => 'circle',
                        'options'       => array(
                            'square'             => __('Flat', 'uabb'),
                            /*'circle'             => __('Circle Background', 'uabb'),*/
                            'square-border'      => __('Transparent', 'uabb'),
                            /*'circle-border'      => __('Circle Border', 'uabb')*/
                        ),
                        'toggle'        => array(
                            'square-border' => array(
                                'fields'        => array( 'pagination_color', 'pagination_color_border', 'pagination_active_color_border', 'pagination_active_color', 'pagination_border_size', 'pagination_border_style' )
                            ),
                            'square' => array(
                                'fields'        => array( 'pagination_color', 'pagination_hover_color', 'pagination_active_color', 'pagination_background_color', 'pagination_background_color_opc',
                                    'pagination_hover_background_color', 'pagination_hover_background_color_opc',
                                    'pagination_active_background_color', 'pagination_active_background_color_opc' )
                            ),
                        )
                    ),
                    'pagination_border_style'       => array(
                        'type'          => 'select',
                        'label'         => __('Border Style', 'uabb'),
                        'default'       => 'solid',
                        'help'          => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
                        'options'       => array(
                            'solid'     => __('Solid', 'uabb'),
                            'dotted'    => __('Dotted', 'uabb'),
                            'dashed'    => __('Dashed', 'uabb'),
                            'double'    => __('Double', 'uabb'),
                        ),
                    ),
                    'pagination_border_size'       => array(
                        'type'          => 'text',
                        'label'         => __('Border Size', 'uabb'),
                        'placeholder'   => '2',
                        'description'   => 'px',
                        'size'          => '8',
                        'max_lenght'    => '3'
                    ),
                    'pagination_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-blogs-pagination li a.page-numbers',
                            'property'      => 'color',
                        )
                    ),
                    'pagination_hover_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'pagination_active_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Active Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-blogs-pagination li span.page-numbers.current',
                            'property'      => 'color',
                        )
                    ),
                    'pagination_background_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-blogs-pagination li a.page-numbers',
                            'property'      => 'background',
                        )
                    ),
                    'pagination_background_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'pagination_hover_background_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Background Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'pagination_hover_background_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'pagination_active_background_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Background Active Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-blogs-pagination li span.page-numbers.current',
                            'property'      => 'background',
                        )
                    ),
                    'pagination_active_background_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'pagination_color_border' => array( 
                        'type'       => 'color',
                        'label'      => __('Border Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'pagination_active_color_border' => array( 
                        'type'       => 'color',
                        'label'      => __('Border Active Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                )
            ),
            'masonary_style' => array(
                'title' => __( 'Taxonomy Filter Button Styling', 'uabb' ),
                'fields' => array(
                    'masonary_overall_alignment' => array(
                        'type'          => 'select',
                        'label' => __('Button Alignment', 'uabb'),
                        'default'       => 'center',
                        'options'       => array(
                            'center' => __( 'Center', 'uabb' ),
                            'left' => __( 'Left', 'uabb' ),
                            'right' => __( 'Right', 'uabb' ),
                        ),
                        'help' => __( 'Controls the alignment of filter button\'s section.', 'uabb' )
                    ),
                    'masonary_bottom_spacing'  => array(
                        'type'          => 'text',
                        'label'         => __('Bottom Spacing', 'uabb'),
                        'description'   => __( 'px', 'uabb' ),
                        'placeholder'   => '40',
                        'size'          => '8',
                        'help'          => __('Use this setting to manage the space between filters and post.', 'uabb')
                    ),
                    'masonary_padding' => array(
                        'type'      => 'uabb-spacing',
                        'label'     => __( 'Button Padding', 'uabb' ),
                        'default'   => 'padding: 12px;',    //optional
                        'mode'      => 'padding',
                    ),
                    'masonary_button_style'       => array(
                        'type'          => 'select',
                        'label'         => __('Button Style', 'uabb'),
                        'default'       => 'circle',
                        'options'       => array(
                            'square'             => __('Flat', 'uabb'),
                            /*'circle'             => __('Circle Background', 'uabb'),*/
                            'square-border'      => __('Transparent', 'uabb'),
                            /*'circle-border'      => __('Circle Border', 'uabb')*/
                        ),
                        'toggle'        => array(
                            'square-border' => array(
                                'fields'        => array( 'masonary_text_color', 'masonary_color_border', 'masonary_active_color_border', 'masonary_active_color', 'masonary_border_size', 'masonary_border_style' )
                            ),
                            'square' => array(
                                'fields'        => array( 'masonary_text_color', 'masonary_text_hover_color', 'masonary_active_color', 'masonary_background_color', 'masonary_background_color_opc',
                                    'masonary_background_hover_color', 'masonary_background_hover_color_opc',
                                    'masonary_background_active_color', 'masonary_background_active_color_opc' )
                            ),
                        )
                    ),
                    'masonary_border_style'       => array(
                        'type'          => 'select',
                        'label'         => __('Border Style', 'uabb'),
                        'default'       => 'solid',
                        'help'          => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
                        'options'       => array(
                            'solid'     => __('Solid', 'uabb'),
                            'dotted'    => __('Dotted', 'uabb'),
                            'dashed'    => __('Dashed', 'uabb'),
                            'double'    => __('Double', 'uabb'),
                        ),
                    ),
                    'masonary_border_size'  => array(
                        'type'          => 'text',
                        'label'         => __('Border Size', 'uabb'),
                        'description'   => __( 'px', 'uabb' ),
                        'placeholder'   => '2',
                        'size'          => '8',
                    ),
                    'masonary_border_radius'  => array(
                        'type'          => 'text',
                        'label'         => __('Border Radius', 'uabb'),
                        'description'   => __( 'px', 'uabb' ),
                        'placeholder'   => '2',
                        'size'          => '8',
                    ),
                    'masonary_text_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Text Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'masonary_text_hover_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Hover Text Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'masonary_active_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Active Text Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'masonary_background_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'masonary_background_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'masonary_background_hover_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Hover Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'masonary_background_hover_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'masonary_background_active_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Active Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'masonary_background_active_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'masonary_color_border' => array( 
                        'type'       => 'color',
                        'label'      => __('Border Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'masonary_active_color_border' => array( 
                        'type'       => 'color',
                        'label'      => __('Border Active Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                )
            ),
            'masonary_select_style' => array(
                'title' => __( 'Drop-down Taxonomy Filter Styling', 'uabb' ),
                'fields' => array(
                    'selfilter_width' => array(
                        'type'          => 'text',
                        'label'         => __( 'Width', 'uabb' ),
                        'description'   => 'px',
                        'size'          => '8',
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => 'select.uabb-masonary-filters',
                            'property'      => 'width',
                            'unit'          => 'px',
                        )
                    ),
                    'selfilter_overall_alignment' => array(
                        'type'          => 'select',
                        'label' => __('Alignment', 'uabb'),
                        'default'       => 'center',
                        'options'       => array(
                            'center' => __( 'Center', 'uabb' ),
                            'left' => __( 'Left', 'uabb' ),
                            'right' => __( 'Right', 'uabb' ),
                        ),
                        'help' => __( 'Controls the alignment of section.', 'uabb' ),
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => '.uabb-masonary-filters-wrapper',
                            'property'      => 'text-align',
                        )
                    ),
                    'selfilter_bottom_spacing'  => array(
                        'type'          => 'text',
                        'label'         => __('Bottom Spacing', 'uabb'),
                        'description'   => __( 'px', 'uabb' ),
                        'placeholder'   => '40',
                        'size'          => '8',
                        'help'          => __('Use this setting to manage the space between filters and post.', 'uabb'),
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => 'select.uabb-masonary-filters',
                            'property'      => 'margin-bottom',
                            'unit'          => 'px',
                        )
                    ),
                    'selfilter_border_enable'  => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Show Border', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'           => __( 'Yes', 'uabb' ),
                            'no'            => __( 'No', 'uabb' ),
                        ),
                        'toggle'        => array(
                            'yes'        => array(
                                'fields'        => array( 'selfilter_border_style', 'selfilter_border_size', 'selfilter_border_radius', 'selfilter_color_border' )
                            )
                        )
                    ),
                    'selfilter_border_style'       => array(
                        'type'          => 'select',
                        'label'         => __('Border Style', 'uabb'),
                        'default'       => 'solid',
                        'help'          => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
                        'options'       => array(
                            'solid'     => __('Solid', 'uabb'),
                            'dotted'    => __('Dotted', 'uabb'),
                            'dashed'    => __('Dashed', 'uabb'),
                            'double'    => __('Double', 'uabb'),
                        ),
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => 'select.uabb-masonary-filters',
                            'property'      => 'border-style',
                        )
                    ),
                    'selfilter_border_size'  => array(
                        'type'          => 'text',
                        'label'         => __('Border Size', 'uabb'),
                        'description'   => __( 'px', 'uabb' ),
                        'placeholder'   => '1',
                        'size'          => '8',
                        'default'       => '1',
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => 'select.uabb-masonary-filters',
                            'property'      => 'border-width',
                            'unit'          => 'px'
                        )
                    ),
                    'selfilter_border_radius'  => array(
                        'type'          => 'text',
                        'label'         => __('Border Radius', 'uabb'),
                        'description'   => __( 'px', 'uabb' ),
                        'placeholder'   => '2',
                        'size'          => '8',
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => 'select.uabb-masonary-filters',
                            'property'      => 'border-radius',
                            'unit'          => 'px'
                        )
                    ),
                    'selfilter_color_border' => array( 
                        'type'       => 'color',
                        'label'      => __('Border Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => 'select.uabb-masonary-filters',
                            'property'      => 'border-color',
                        )
                    ),
                    'selfilter_background_color' => array(
                        'type'       => 'color',
                        'label'      => __('Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => 'select.uabb-masonary-filters',
                            'property'      => 'background',
                        )
                    ),
                )
            ),
        ),
    ),
    'typography'        => array( // Tab
        'title'         => __('Typography', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'title_typography' => array(
                'title' => __('Title', 'uabb' ),
                'fields'    => array(
                    'title_tag_selection'   => array(
                        'type'          => 'select',
                        'label'         => __('Tag', 'uabb'),
                        'default'       => 'h3',
                        'options'       => array(
                            'h1'      => __('H1', 'uabb'),
                            'h2'      => __('H2', 'uabb'),
                            'h3'      => __('H3', 'uabb'),
                            'h4'      => __('H4', 'uabb'),
                            'h5'      => __('H5', 'uabb'),
                            'h6'      => __('H6', 'uabb'),
                            'div'     => __('Div', 'uabb'),
                            'p'       => __('p', 'uabb'),
                            'span'    => __('span', 'uabb'),
                        )
                    ),
                    'title_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-post-heading a'
                        )
                    ),
                    'title_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-post-heading a',
                            'property'        => 'font-size',
                            'unit'            => 'px'
                        )
                    ),
                    'title_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-post-heading a',
                            'property'        => 'line-height',
                            'unit'            => 'px'
                        )
                    ),
                    'title_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-post-heading a',
                            'property'        => 'color',
                        )
                    ),
                )
            ),
            'desc_typography' => array(
                'title' => __('Description / Excerpt / Content', 'uabb' ),
                'fields'    => array(
                    'desc_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-blog-posts-description'
                        )
                    ),
                    'desc_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-blog-posts-description',
                            'property'        => 'font-size',
                            'unit'            => 'px'
                        )
                    ),
                    'desc_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-blog-posts-description',
                            'property'        => 'line-height',
                            'unit'            => 'px'
                        )
                    ),
                    'desc_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-blog-posts-description',
                            'property'        => 'color',
                        )
                    ),
                )
            ),
            'meta_typography' => array(
                'title'     => __('Post Meta', 'uabb'),
                'fields'    => array(
                    'meta_tag_selection'   => array(
                        'type'          => 'select',
                        'label'         => __('Meta Tag', 'uabb'),
                        'default'       => 'h5',
                        'options'       => array(
                            'h1'      => __('H1', 'uabb'),
                            'h2'      => __('H2', 'uabb'),
                            'h3'      => __('H3', 'uabb'),
                            'h4'      => __('H4', 'uabb'),
                            'h5'      => __('H5', 'uabb'),
                            'h6'      => __('H6', 'uabb'),
                            'div'     => __('Div', 'uabb'),
                            'p'       => __('p', 'uabb'),
                            'span'    => __('span', 'uabb'),
                        )
                    ),
                    'meta_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-post-meta'
                        )
                    ),
                    'meta_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-post-meta',
                            'property'        => 'font-size',
                            'unit'            => 'px'
                        )
                    ),
                    'meta_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-post-meta',
                            'property'        => 'line-height',
                            'unit'            => 'px'
                        )
                    ),
                    'meta_text_color'        => array( 
                        'type'       => 'color',
                        'label'         => __('Meta Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-post-meta',
                            'property'        => 'color',
                        )
                    ),
                    'meta_color'        => array(
                        'type'       => 'color',
                        'label'         => __('Meta Link Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-post-meta a',
                            'property'        => 'color',
                        )
                    ),
                    'meta_hover_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Meta Link Hover Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                )
            ),
            'date_typography'    =>  array(
                'title' => __( 'Date Box', 'uabb' ),
                'fields'    => array(
                    'date_tag_selection'   => array(
                        'type'          => 'select',
                        'label'         => __('Tag', 'uabb'),
                        'default'       => 'h2',
                        'options'       => array(
                            'h1'      => __('H1', 'uabb'),
                            'h2'      => __('H2', 'uabb'),
                            'h3'      => __('H3', 'uabb'),
                            'h4'      => __('H4', 'uabb'),
                            'h5'      => __('H5', 'uabb'),
                            'h6'      => __('H6', 'uabb'),
                            'div'     => __('Div', 'uabb'),
                            'p'       => __('p', 'uabb'),
                            'span'    => __('span', 'uabb'),
                        )
                    ),
                    'date_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'   => array(
                            'type'      => 'font',
                            'selector'  => '.uabb-posted-on'
                        ),
                    ),
                    'date_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-posted-on',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        ),
                    ),
                    'date_color'        => array( 
                        'type'       => 'color',
                        'label'         => __('Date Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-posted-on',
                            'property'  => 'color',
                        ),
                    ),
                    'date_background_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Date Background Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-posted-on',
                            'property'  => 'background',
                        ),
                    ),
                    'date_background_color_opc' => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                )
            ),
            'link_typography'    =>  array(
                'title' => __( 'Call to Action', 'uabb' ),
                'fields'    => array(
                    'link_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'   => array(
                            'type'      => 'font',
                            'selector'  => '.uabb-read-more-text a'
                        ),
                    ),
                    'link_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-blog-post-content .uabb-read-more-text a',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        ),
                    ),
                    'link_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-blog-post-content .uabb-read-more-text a',
                            'property'  => 'line-height',
                            'unit'      => 'px'
                        ),
                    ),
                    'link_color'        => array( 
                        'type'       => 'color',
                        'label'         => __('Link Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-blog-post-content .uabb-read-more-text a',
                            'property'  => 'color',
                        ),
                    ),
                    'link_more_arrow_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Arrow Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => '.uabb-blog-post-content .uabb-read-more-text span',
                            'property'  => 'color',
                        ),
                    ),
                )
            ),
            'btn_typography'    =>  array(
                'title' => __( 'CTA Button', 'uabb' ),
                'fields'    => array(
                    'btn_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'   => array(
                            'type'      => 'font',
                            'selector'  => 'a.uabb-button'
                        ),
                    ),
                    'btn_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'btn_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                )
            ),
            'taxonomy_filter_select_field_typography'    =>  array(
                'title' => __( 'Taxonomy Filter', 'uabb' ),
                'fields'    => array(
                    'taxonomy_filter_select_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'   => array(
                            'type'      => 'font',
                            'selector'  => 'select.uabb-masonary-filters, ul.uabb-masonary-filters'
                        ),
                    ),
                    'taxonomy_filter_select_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                        'preview'   => array(
                            'type'      => 'css',
                            'selector'  => 'select.uabb-masonary-filters, ul.uabb-masonary-filters',
                            'property'  => 'font-size',
                            'unit'      => 'px'
                        ),
                    ),                   
                    'taxonomy_filter_select_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Text Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                        'preview'         => array(
                            'type'          => 'css',
                            'selector'      => 'select.uabb-masonary-filters, ul.uabb-masonary-filters li',
                            'property'      => 'color',
                        )
                    ),
                )
            ),
        )
    ),
));
