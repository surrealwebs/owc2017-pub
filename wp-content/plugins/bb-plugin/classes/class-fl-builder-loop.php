<?php

/**
 * Helper class for building custom WordPress loops.
 *
 * @since 1.2.3
 */
final class FLBuilderLoop {

	/**
	 * Loop query counter
	 *
	 * @since 1.9.5
	 * @var int $loop_counter
	 */
	static public $loop_counter = 0;

	/**
	 * Custom pagination regex base.
	 *
	 * @since 1.10.7
	 * @var string
	 */
	static public $paged_regex_base = 'paged-[0-9]{1,}';

	/**
	 * Cache the custom pagination data.
	 * Format:
	 * 		array(
	 * 			'current_page' => '',
	 *  	 	'current_loop' => '',
	 *   		'paged' => ''
	 *     	)
	 *
	 * @since 1.10.7
	 * @var array
	 */
	static public $custom_paged_data = array();

	/**
	 * Flag for flushing post type rewrite rules.
	 *
	 * @since 1.10.7
	 * @var bool
	 */
	static private $_rewrote_post_type = false;

	/**
	 * Flag for flushing taxonomy rewrite rules.
	 *
	 * @since 1.10.7
	 * @var bool
	 */
	static private $_rewrote_taxonomy = false;

	/**
	 * Initializes hooks.
	 *
	 * @since 1.8
	 * @return void
	 */
	static public function init() {
		// Actions
		add_action( 'fl_builder_before_control_suggest', __CLASS__ . '::render_match_select', 10, 4 );
		add_action( 'init', 							 __CLASS__ . '::init_rewrite_rules', 20 );
		add_action( 'fl_builder_activated',              __CLASS__ . '::init_rewrite_rules', 10 );
		add_action( 'registered_post_type',  			 __CLASS__ . '::post_type_rewrite_rules', 10, 2 );
		add_action( 'registered_taxonomy',  			 __CLASS__ . '::taxonomy_rewrite_rules', 10, 3 );
		add_action( 'wp_loaded',  			 			 __CLASS__ . '::flush_rewrite_rules', 1 );

		// Filters
		add_filter( 'found_posts',                       __CLASS__ . '::found_posts', 1, 2 );
		add_filter( 'redirect_canonical', 				 __CLASS__ . '::override_canonical', 1, 2 );
		add_filter( 'pre_handle_404', 				 	 __CLASS__ . '::pre_404_pagination', 1, 2 );
		add_filter( 'paginate_links', 				 	 __CLASS__ . '::filter_paginate_links', 1 );
	}

	/**
	 * Returns either a clone of the main query or a new instance of
	 * WP_Query based on the provided module settings.
	 *
	 * @since 1.2.3
	 * @param object $settings Module settings to use for the query.
	 * @return object A WP_Query instance.
	 */
	static public function query( $settings ) {
		$settings = apply_filters( 'fl_builder_loop_before_query_settings', $settings );

		do_action( 'fl_builder_loop_before_query', $settings );

		// Count how many times this method has been called
		self::$loop_counter++;

		if ( isset( $settings->data_source ) && 'main_query' == $settings->data_source ) {
			$query = self::main_query();
		} else {
			$query = self::custom_query( $settings );
		}

		do_action( 'fl_builder_loop_after_query', $settings );

		return apply_filters( 'fl_builder_loop_query', $query, $settings );
	}

	/**
	 * Returns new instance query if we have multiple paginations on a page.
	 * Else, returns a clone of the main query with the post data reset.
	 *
	 * @since 1.10
	 * @return object A WP_Query instance.
	 */
	static public function main_query() {
		global $wp_query, $wp_the_query;

		// Setup a new WP_Query instance if we have multiple paginations on a page.
		if ( self::$loop_counter > 1 || $wp_the_query->is_singular( 'fl-theme-layout' ) ) {

			$query_args = $wp_query->query_vars;

			$query_args['paged'] = self::get_paged();
			$query_args['fl_original_offset'] = 0;
			$query_args['fl_builder_loop'] = true;

			$query = new WP_Query( $query_args );
		} else {
			$query = clone $wp_query;
			$query->rewind_posts();
			$query->reset_postdata();
		}

		return $query;
	}

	/**
	 * Returns a new instance of WP_Query based on
	 * the provided module settings.
	 *
	 * @since 1.10
	 * @param object $settings Module settings to use for the query.
	 * @return object A WP_Query instance.
	 */
	static public function custom_query( $settings ) {
		$posts_per_page	 = empty( $settings->posts_per_page ) ? 10 : $settings->posts_per_page;
		$post_type		 = empty( $settings->post_type ) ? 'post' : $settings->post_type;
		$order_by		 = empty( $settings->order_by ) ? 'date' : $settings->order_by;
		$order			 = empty( $settings->order ) ? 'DESC' : $settings->order;
		$users			 = empty( $settings->users ) ? '' : $settings->users;
		$fields			 = empty( $settings->fields ) ? '' : $settings->fields;

		$paged = self::get_paged();

		// Get the offset.
		if ( ! isset( $settings->offset ) || ! is_int( (int) $settings->offset ) ) {
			$offset = 0;
		} else {
			$offset = $settings->offset;
		}

		// Get the paged offset.
		if ( $paged < 2 ) {
			$paged_offset = $offset;
		} else {
			$paged_offset = $offset + ( ( $paged - 1 ) * $posts_per_page );
		}

		// Build the query args.
		$args = apply_filters( 'fl_builder_loop_query_args', array(
			'paged'					=> $paged,
			'posts_per_page'		=> $posts_per_page,
			'post_type'				=> $post_type,
			'orderby'				=> $order_by,
			'order'					=> $order,
			'tax_query'				=> array(
				'relation' => 'AND',
			),
			'ignore_sticky_posts'	=> true,
			'offset'				=> $paged_offset,
			'fl_original_offset'	=> $offset,
			'fl_builder_loop'		=> true,
			'fields'				=> $fields,
		) );

		// Order by meta value arg.
		if ( strstr( $order_by, 'meta_value' ) ) {
			$args['meta_key'] = $settings->order_by_meta_key;
		}

		// Build the author query.
		if ( ! empty( $users ) ) {

			if ( is_string( $users ) ) {
				$users = explode( ',', $users );
			}

			$arg = 'author__in';

			// Set to NOT IN if matching is present and set to 0.
			if ( isset( $settings->users_matching ) && ! $settings->users_matching ) {
				$arg = 'author__not_in';
			}

			$args[ $arg ] = $users;
		}

		// Build the taxonomy query.
		$taxonomies = self::taxonomies( $post_type );

		foreach ( $taxonomies as $tax_slug => $tax ) {

			$tax_value = '';
			$term_ids  = array();
			$operator  = 'IN';

			// Get the value of the suggest field.
			if ( isset( $settings->{'tax_' . $post_type . '_' . $tax_slug} ) ) {
				// New style slug.
				$tax_value = $settings->{'tax_' . $post_type . '_' . $tax_slug};
			} elseif ( isset( $settings->{'tax_' . $tax_slug} ) ) {
				// Old style slug for backwards compat.
				$tax_value = $settings->{'tax_' . $tax_slug};
			}

			// Get the term IDs array.
			if ( ! empty( $tax_value ) ) {
				$term_ids = explode( ',', $tax_value );
			}

			// Handle matching settings.
			if ( isset( $settings->{'tax_' . $post_type . '_' . $tax_slug . '_matching'} ) ) {

				$tax_matching = $settings->{'tax_' . $post_type . '_' . $tax_slug . '_matching'};

				if ( ! $tax_matching ) {
					// Do not match these terms.
					$operator = 'NOT IN';
				} elseif ( 'related' === $tax_matching ) {
					// Match posts by related terms from the global post.
					global $post;
					$terms 	 = wp_get_post_terms( $post->ID, $tax_slug );
					$related = array();

					foreach ( $terms as $term ) {
						if ( ! in_array( $term->term_id, $term_ids ) ) {
							$related[] = $term->term_id;
						}
					}

					if ( empty( $related ) ) {
						// If no related terms, match all except those in the suggest field.
						$operator = 'NOT IN';
					} else {

						// Don't include posts with terms selected in the suggest field.
						$args['tax_query'][] = array(
							'taxonomy'	=> $tax_slug,
							'field'		=> 'id',
							'terms'		=> $term_ids,
							'operator'  => 'NOT IN',
						);

						// Set the term IDs to the related terms.
						$term_ids = $related;
					}
				}
			}// End if().

			if ( ! empty( $term_ids ) ) {

				$args['tax_query'][] = array(
					'taxonomy'	=> $tax_slug,
					'field'		=> 'id',
					'terms'		=> $term_ids,
					'operator'  => $operator,
				);
			}
		}// End foreach().

		// Post in/not in query.
		if ( isset( $settings->{'posts_' . $post_type} ) ) {

			$ids = $settings->{'posts_' . $post_type};
			$arg = 'post__in';

			// Set to NOT IN if matching is present and set to 0.
			if ( isset( $settings->{'posts_' . $post_type . '_matching'} ) ) {
				if ( ! $settings->{'posts_' . $post_type . '_matching'} ) {
					$arg = 'post__not_in';
				}
			}

			// Add the args if we have IDs.
			if ( ! empty( $ids ) ) {
				$args[ $arg ] = explode( ',', $settings->{'posts_' . $post_type} );
			}
		}

		// Build the query.
		$query = new WP_Query( $args );

		// Return the query.
		return $query;
	}

	/**
	 * Called by the found_posts filter to adjust the number of posts
	 * found based on the user defined offset.
	 *
	 * @since 1.2.3
	 * @param int $found_posts The number of found posts.
	 * @param object $query An instance of WP_Query.
	 * @return int
	 */
	static public function found_posts( $found_posts, $query ) {
		if ( isset( $query->query ) && isset( $query->query['fl_builder_loop'] ) ) {
			return (int) $found_posts - (int) $query->query['fl_original_offset'];
		}

		return $found_posts;
	}


	/**
	 * Add rewrite rules for custom pagination that allows post modules
	 * on the same page to be paged independently.
	 *
	 * @since 1.9.5
	 * @return void
	 */
	static public function init_rewrite_rules() {

		$fronts = self::get_rewrite_fronts();
		$paged_regex = self::$paged_regex_base;

		$flpaged_rules = array(

			// Category archive
			$fronts['category'] . '/(.+?)/' . $paged_regex . '/?([0-9]{1,})/?$' => 'index.php?category_name=$matches[1]&flpaged=$matches[2]',

			// Tag archive
			$fronts['tag'] . '/([^/]+)/' . $paged_regex . '/?([0-9]{1,})/?$' => 'index.php?tag=$matches[1]&flpaged=$matches[2]',

			// Year archive
			$fronts['date'] . '([0-9]{4})/' . $paged_regex . '/?([0-9]{1,})/?$' => 'index.php?year=$matches[1]&flpaged=$matches[2]',

			// Year/month archive
			$fronts['date'] . '([0-9]{4})/([0-9]{1,2})/' . $paged_regex . '/?([0-9]{1,})/?$' => 'index.php?year=$matches[1]&monthnum=$matches[2]&flpaged=$matches[3]',

			// Day archive
			$fronts['date'] . '([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/' . $paged_regex . '/?([0-9]{1,})/?$' => 'index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&flpaged=$matches[4]',

			// Author archive
			$fronts['author'] . '([^/]+)/' . $paged_regex . '/?([0-9]{1,})/?$' => 'index.php?author_name=$matches[1]&flpaged=$matches[2]',

			// Post single - Numeric permastruct (/archives/%post_id%)
			$fronts['default'] . '([0-9]+)/' . $paged_regex . '/?([0-9]{1,})/?$' => 'index.php?p=$matches[1]&flpaged=$matches[2]',

			// Page
			'(.?.+?)/' . $paged_regex . '/?([0-9]{1,})/?$' => 'index.php?pagename=$matches[1]&flpaged=$matches[2]',

			// Post single
			'(.+?)/' . $paged_regex . '/?([0-9]{1,})/?$' => 'index.php?name=$matches[1]&flpaged=$matches[2]',
		);

		// Frontpage static
		if ( get_option( 'page_on_front' ) ) {
			$flpaged_rules[ $paged_regex . '/([0-9]*)/?' ] = 'index.php?page_id=' . get_option( 'page_on_front' ) . '&flpaged=$matches[1]';
		}
		// Generic Rule for Homepage / Search
		$flpaged_rules[ $paged_regex . '/?([0-9]{1,})/?$' ] = 'index.php?&flpaged=$matches[1]';

		foreach ( $flpaged_rules as $regex => $redirect ) {
			add_rewrite_rule( $regex, $redirect, 'top' );
		}

		add_rewrite_tag( '%flpaged%', '([^&]+)' );
	}

	/**
	 * Get the rewrite front for the generic rules.
	 *
	 * @since 1.10.7
	 * @return array
	 */
	static public function get_rewrite_fronts() {
		global $wp_rewrite;

		$front = substr( $wp_rewrite->front, 1 );

		$category_base = get_option( 'category_base' );
		if ( ! $category_base ) {
			$category_base = $front . 'category';
		}

		$tag_base = get_option( 'tag_base' );
		if ( ! $tag_base ) {
			$tag_base = $front . 'tag';
		}

		$date_base = $front;
		if ( strpos( $wp_rewrite->permalink_structure, '%post_id%' ) !== false ) {
			$date_base = $front . 'date/';
		}

		$author_base = $front . $wp_rewrite->author_base . '/';

		return array(
			'category' 	=> $category_base,
			'tag' 		=> $tag_base,
			'date' 		=> $date_base,
			'author' 	=> $author_base,
			'default' 	=> $front,
		);
	}

	/**
	 * Adding custom rewrite rules for the current post type pagination.
	 *
	 * @param string $post_type
	 * @param array $args
	 * @since 1.10.7
	 * @return void
	 */
	static public function post_type_rewrite_rules( $post_type, $args ) {
		global $wp_rewrite;

		if ( $args->_builtin or ! $args->publicly_queryable ) {
			return;
		}

		if ( false === $args->rewrite ) {
			return;
		}

		// Get our custom pagination if sets.
		$custom_paged = self::get_custom_paged();

		if ( ! $custom_paged || empty( $custom_paged ) || ! isset( $custom_paged['current_page'] ) ) {
			return;
		}

		$is_single = false;

		// Check if it's a CPT archive or CPT single.
		if ( $custom_paged['current_page'] != $post_type ) {

			// Is a child post of the current post type?
			$post_object = get_page_by_path( $custom_paged['current_page'], OBJECT, $post_type );

			if ( $post_object ) {
				$is_single = true;
			} else {
				return;
			}
		}

		$slug = $args->rewrite['slug'];

		if ( is_string( $args->has_archive ) ) {
			$slug = $args->has_archive;
		}

		if ( $args->rewrite['with_front'] ) {
			$slug = substr( $wp_rewrite->front, 1 ) . $slug;
		}

		// Append $custom_paged[ 'current_page' ] to slug if it's single.
		if ( $is_single ) {
			$regex = $slug . '/' . $custom_paged['current_page'] . '/' . self::$paged_regex_base . '/?([0-9]{1,})/?$';
			$redirect = 'index.php?post_type=' . $post_type . '&name=' . $custom_paged['current_page'] . '&flpaged=$matches[1]';
		} else {
			$regex = $slug . '/' . self::$paged_regex_base . '/?([0-9]{1,})/?$';
			$redirect = 'index.php?post_type=' . $post_type . '&flpaged=$matches[1]';
		}

		add_rewrite_rule( $regex, $redirect, 'top' );

		// Set true for flushing.
		self::$_rewrote_post_type = true;
	}

	/**
	 * Adding custom rewrite rules for taxonomy pagination.
	 *
	 * @param string $taxonomy
	 * @param string $object_type
	 * @param array $args
	 * @since 1.10.7
	 * @return void
	 */
	static public function taxonomy_rewrite_rules( $taxonomy, $object_type, $args ) {
		global $wp_rewrite;

		// For 4.7
		$args = (array) $args;

		if ( ! empty( $args['_builtin'] ) ) {
			return;
		}

		if ( false === $args['rewrite'] ) {
			return;
		}

		// Get our custom pagination request data.
		$custom_paged = self::get_custom_paged();

		// Taxonomy checks.
		if ( empty( $custom_paged['parent_page'] ) || ! isset( $custom_paged['parent_page'] ) ) {
			return;
		}

		// Term checks.
		if ( ! $custom_paged || empty( $custom_paged ) || ! isset( $custom_paged['current_page'] ) ) {
			return;
		}

		// Add rewrite to the registered tax only.
		if ( isset( $custom_paged['parent_page'] ) && $custom_paged['parent_page'] != $taxonomy ) {
			return;
		}

		// Make sure we have a valid term.
		if ( ! term_exists( $custom_paged['current_page'], $taxonomy ) ) {
			return;
		}

		if ( 'category' == $taxonomy ) {
			$taxonomy_slug = ( $cb = get_option( 'category_base' ) ) ? $cb : $taxonomy; // @codingStandardsIgnoreLine
			$taxonomy_key  = 'category_name';
		} else {
			if ( isset( $args['rewrite']['slug'] ) ) {
				$taxonomy_slug = $args['rewrite']['slug'];
			} else {
				$taxonomy_slug = $taxonomy;
			}

			$taxonomy_key = $taxonomy;
		}

		if ( $args['rewrite']['with_front'] ) {
			$taxonomy_slug = substr( $wp_rewrite->front, 1 ) . $taxonomy_slug;
		}

		$rules = array(
			// Year
			'%s/(.+?)/date/([0-9]{4})/' . self::$paged_regex_base . '/?([0-9]{1,})/?$' => "index.php?{$taxonomy_key}=\$matches[1]&year=\$matches[2]&flpaged=\$matches[3]",

			// Month
			'%s/(.+?)/date/([0-9]{4})/([0-9]{1,2})/' . self::$paged_regex_base . '/?([0-9]{1,})/?$' => "index.php?{$taxonomy_key}=\$matches[1]&year=\$matches[2]&monthnum=\$matches[3]&flpaged=\$matches[4]",

			// Day
			'%s/(.+?)/date/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/' . self::$paged_regex_base . '/?([0-9]{1,})/?$' => "index.php?{$taxonomy_key}=\$matches[1]&year=\$matches[2]&monthnum=\$matches[3]&day=\$matches[4]&flpaged=\$matches[5]",

			// Tax Archive
			'%s/(.+?)/' . self::$paged_regex_base . '/?([0-9]{1,})/?$' => "index.php?{$taxonomy_key}=\$matches[1]&flpaged=\$matches[2]",
		);

		foreach ( $rules as $regex => $redirect ) {
			$regex = sprintf( $regex, "{$taxonomy_slug}" );
			add_rewrite_rule( $regex, $redirect, 'top' );
		}

		// Set 'true' for flushing.
		self::$_rewrote_taxonomy = true;
	}

	/**
	 * Flush rewrite rules ONLY when necessary.
	 *
	 * @since 1.10.7
	 * @return void
	 */
	static public function flush_rewrite_rules() {
		global $wp_rewrite;

		if ( self::$_rewrote_post_type || self::$_rewrote_taxonomy ) {
			// Need to flush (soft) so our custom rules will work.
			$wp_rewrite->flush_rules( false );
		}

		self::$_rewrote_post_type = false;
		self::$_rewrote_taxonomy = false;
	}

	/**
	 * Disable canonical redirection on the frontpage when query var 'flpaged' is found.
	 *
	 * Disable canonical on supported CPT single.
	 *
	 * @param  string $redirect_url  The redirect URL.
	 * @param  string $requested_url The requested URL.
	 * @since  1.9.5
	 * @return bool|string
	 */
	static public function override_canonical( $redirect_url, $requested_url ) {
		global $wp_the_query;

		if ( is_array( $wp_the_query->query ) ) {
			foreach ( $wp_the_query->query as $key => $value ) {
				if ( strpos( $key, 'flpaged' ) === 0 && is_page() && get_option( 'page_on_front' ) ) {
					$redirect_url = false;
					break;
				}
			}

			// Disable canonical on single post pagination for all post types.
			if ( true === $wp_the_query->is_singular
				 && - 1 == $wp_the_query->current_post
				 && true === $wp_the_query->is_paged
			) {
				$redirect_url = false;
			}
		}

		return $redirect_url;
	}

	/**
	 * Theme Builder support - Check to see if current page has Themer layout.
	 * Short-circuit default header status handling when paginating on themer layout content.
	 *
	 * @param bool 	$prevent_404 Whether to short-circuit default header status handling. Default false.
	 * @param object $query WP Query object.
	 * @since 1.10.7
	 * @return bool
	 */
	static public function pre_404_pagination( $prevent_404, $query ) {
		global $wp_actions;

		if ( ! class_exists( 'FLThemeBuilder' ) ) {
			return false;
		}

		if ( ! $query->is_paged ) {
			return false;
		}

		if ( ! $query->is_archive && ! $query->is_home ) {
			return false;
		}

		$is_global_hack = false;
		$layout_type = '';

		// Manually set globals since filter `pre_handle_404`
		// doesn't reach `$wp_query->register_globals()`.
		if ( ! isset( $wp_actions['wp'] ) ) {

			// This would prevent from throwing PHP Notice
			// from FLThemeBuilderRulesLocation::get_current_page_location().
			$wp_actions['wp'] = 1;

			if ( $query->is_post_type_archive ) {
				$post = new stdClass();
				$post->post_type = $query->get( 'post_type' );
				$GLOBALS['post'] = $post;
			}

			$is_global_hack = true;
		}

		if ( FLThemeBuilder::has_layout() ) {

			// Reset the hacks.
			if ( $is_global_hack ) {
				unset( $wp_actions['wp'] );
				$GLOBALS['post'] = null;
			}

			return true;
		}

		return false;
	}

	/**
	 * Builds and renders the pagination for a query.
	 *
	 * @since 1.2.3
	 * @param object $query An instance of WP_Query.
	 * @return void
	 */
	static public function pagination( $query ) {
		$total_pages = $query->max_num_pages;
		$permalink_structure = get_option( 'permalink_structure' );
		$paged = self::get_paged();
		$base = untrailingslashit( html_entity_decode( get_pagenum_link() ) );

		if ( $total_pages > 1 ) {

			if ( ! $current_page = $paged ) { // @codingStandardsIgnoreLine
				$current_page = 1;
			}

			$base = self::build_base_url( $permalink_structure, $base );
			$format = self::paged_format( $permalink_structure, $base );

			echo paginate_links(array(
				'base'	   => $base . '%_%',
				'format'   => $format,
				'current'  => $current_page,
				'total'	   => $total_pages,
				'type'	   => 'list',
			));
		}
	}

	/**
	 * Fix our custom pagination link on the single post when permalink structure is set to Plain or default.
	 * For some reason WP automatically appending URL parameters to each page link.
	 *
	 * @param string $link Pagination link
	 * @since 1.10.7
	 * @return string
	 */
	static public function filter_paginate_links( $link ) {
		$permalink_structure = get_option( 'permalink_structure' );
		$base 				 = html_entity_decode( get_pagenum_link() );

		if ( empty( $permalink_structure ) && strrpos( $base, 'paged-' ) ) {

			// Compare $link with the current 'paged-' parameter.
			$base_params = wp_parse_url( $base, PHP_URL_QUERY );
			wp_parse_str( $base_params, $base_args );
			$current_paged_args = array_values( preg_grep( '/^paged-(\d+)/', array_keys( $base_args ) ) );

			if ( ! empty( $current_paged_args ) ) {
				$current_flpaged = $current_paged_args[0];
				$current_paged_param = $current_flpaged . '=' . $base_args[ $current_flpaged ];

				$link_params = wp_parse_url( $link, PHP_URL_QUERY );
				$link_params = str_replace( $current_paged_param, '' , $link_params );
				wp_parse_str( $link_params, $link_args );

				$link = strtok( $link, '?' );
				$link = add_query_arg( $link_args, $link );
			}
		}

		return $link;
	}

	/**
	 * Build base URL for our custom pagination.
	 *
	 * @param string $permalink_structure  The current permalink structure.
	 * @param string $base  The base URL to parse
	 * @since 1.10.7
	 * @return string
	 */
	static public function build_base_url( $permalink_structure, $base ) {
		// Check to see if we are using pretty permalinks
		if ( ! empty( $permalink_structure ) ) {

			if ( strrpos( $base, 'paged-' ) ) {
				$base = substr_replace( $base, '', strrpos( $base, 'paged-' ), strlen( $base ) );
			}

			// Remove query string from base URL since paginate_links() adds it automatically.
			// This should also fix the WPML pagination issue that was added since 1.10.2.
			if ( count( $_GET ) > 0 ) {
				$base = strtok( $base, '?' );
			}

			$base = untrailingslashit( $base );

		} else {
			$url_params = wp_parse_url( $base, PHP_URL_QUERY );

			if ( empty( $url_params ) ) {
				$base = trailingslashit( $base );
			}
		}

		return $base;
	}

	/**
	 * Build the custom pagination format.
	 *
	 * @param string $permalink_structure
	 * @param string $base
	 * @since 1.10.7
	 * @return string
	 */
	static public function paged_format( $permalink_structure, $base ) {
		if ( self::$loop_counter > 1 ) {
			$page_prefix = 'paged-' . self::$loop_counter;
		} else {
			$page_prefix = empty( $permalink_structure ) ? 'paged' : 'page';
		}

		if ( ! empty( $permalink_structure ) ) {
			$format = ! empty( $page_prefix ) ? '/' . $page_prefix . '/' : '/';
			$format .= '%#%';
			$format .= substr( $permalink_structure, -1 ) == '/' ? '/' : '';
		} elseif ( empty( $permalink_structure ) || is_search() ) {
			$parse_url = wp_parse_url( $base, PHP_URL_QUERY );
			$format = empty( $parse_url ) ? '?' : '&';
			$format .= $page_prefix . '=%#%';
		}

		return $format;
	}

	/**
	 * Returns the custom pagination request data.
	 *
	 * @since 1.10.7
	 * @return array|bool
	 */
	static public function get_custom_paged() {
		if ( ! empty( self::$custom_paged_data ) ) {
			return self::$custom_paged_data;
		}

		if ( did_action( 'wp' ) ) {
			global $wp;
			$current_url = home_url( $wp->request );
		} else {
			$current_url = $_SERVER['REQUEST_URI'];
		}

		// Do a quick test if the current request URL contains the custom `paged-` var
		if ( false === strpos( $current_url, 'paged-' ) ) {
			return false;
		}

		// Check the current URL if it matches our custom pagination var.
		$paged_matches = preg_match( '/([^.\/]*?)(?:\/)?([^.\/]*?)\/paged-([0-9]{1,})(?:\=|\/)([0-9]{1,})/', $current_url, $matches );

		if ( $paged_matches ) {
			self::$custom_paged_data = array(
				'parent_page'	=> $matches[1],
				'current_page' 	=> $matches[2],
				'current_loop' 	=> $matches[3],
				'paged' 		=> $matches[4],
			);
		}

		return self::$custom_paged_data;
	}

	/**
	 * Check to see if the posts loop is currently paginated.
	 *
	 * @since 1.10.7
	 * @return bool
	 */
	static public function is_paginated_loop() {
		$custom_paged = self::get_custom_paged();

		if ( ! isset( $custom_paged['current_loop'] ) ) {
			return false;
		}

		if ( $custom_paged['current_loop'] == self::$loop_counter ) {
			return true;
		}

		return false;
	}

	/**
	 * Returns the paged number for the query.
	 *
	 * @since 1.9.5
	 * @return int
	 */
	static public function get_paged() {
		global $wp_the_query, $paged;

		// Check first for custom pagination from post module
		$flpaged = $wp_the_query->get( 'flpaged' );

		// In case the site is using default permalink structure and it has multiple paginations.
		$permalink_structure = get_option( 'permalink_structure' );
		$base = html_entity_decode( get_pagenum_link() );

		if ( is_numeric( $flpaged ) && self::is_paginated_loop() ) {
			return $flpaged;
		} elseif ( empty( $permalink_structure ) && strrpos( $base, 'paged-' ) && self::$loop_counter > 1 ) {

			$flpaged = 0;
			$url_parts = wp_parse_url( $base, PHP_URL_QUERY );
			wp_parse_str( $url_parts, $url_params );

			foreach ( $url_params as $paged_key => $paged_val ) {
				$get_paged_loop = explode( '-', $paged_key );

				if ( false === strpos( $paged_key, 'paged-' ) || ! isset( $get_paged_loop[1] ) ) {
					continue;
				}

				if ( $get_paged_loop[1] == self::$loop_counter ) {
					$flpaged = $paged_val;
					break;
				}
			}

			return $flpaged;
		} elseif ( self::$loop_counter > 1 ) {
			// If we have multiple paginations, make sure it won't affect the other loops.
			return 0;
		}

		// Check the 'paged' query var.
		$paged_qv = $wp_the_query->get( 'paged' );

		if ( is_numeric( $paged_qv ) ) {
			return $paged_qv;
		}

		// Check the 'page' query var.
		$page_qv = $wp_the_query->get( 'page' );

		if ( is_numeric( $page_qv ) ) {
			return $page_qv;
		}

		// Check the $paged global?
		if ( is_numeric( $paged ) ) {
			return $paged;
		}

		return 0;
	}

	/**
	 * Returns an array of data for post types supported
	 * by module loop settings.
	 *
	 * @since 1.2.3
	 * @return array
	 */
	static public function post_types() {
		$post_types = get_post_types(array(
			'public'	=> true,
			'show_ui'	=> true,
		), 'objects');

		unset( $post_types['attachment'] );
		unset( $post_types['fl-builder-template'] );
		unset( $post_types['fl-theme-layout'] );

		return $post_types;
	}

	/**
	 * Get an array of supported taxonomy data for a post type.
	 *
	 * @since 1.2.3
	 * @param string $post_type The post type to get taxonomies for.
	 * @return array
	 */
	static public function taxonomies( $post_type ) {
		$taxonomies = get_object_taxonomies( $post_type, 'objects' );
		$data		= array();

		foreach ( $taxonomies as $tax_slug => $tax ) {

			if ( ! $tax->public || ! $tax->show_ui ) {
				continue;
			}

			$data[ $tax_slug ] = $tax;
		}

		return apply_filters( 'fl_builder_loop_taxonomies', $data, $taxonomies, $post_type );
	}

	/**
	 * Displays the date for the current post in the loop.
	 *
	 * @since 1.7
	 * @param string $format The date format to use.
	 * @return void
	 */
	static public function post_date( $format = 'default' ) {
		if ( 'default' == $format ) {
			$format = get_option( 'date_format' );
		}

		the_time( $format );
	}

	/**
	 * Renders the select for matching or not matching filters in
	 * a module's loop builder settings.
	 *
	 * @since 1.10
	 * @param string $name
	 * @param string $value
	 * @param array $field
	 * @param object $settings
	 * @return void
	 */
	static public function render_match_select( $name, $value, $field, $settings ) {
		if ( ! isset( $field['matching'] ) || ! $field['matching'] ) {
			return;
		}

		$label = FLBuilderUtils::strtolower( $field['label'] );

		if ( ! isset( $settings->{ $name . '_matching' } ) ) {
			$settings->{ $name . '_matching' } = '1';
		}

		include FL_BUILDER_DIR . 'includes/loop-settings-matching.php';
	}
}

FLBuilderLoop::init();
