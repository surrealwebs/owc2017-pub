<?php

/**
 * 		UABB Model Helper
 *
 * 	Helper functions, actions & filter hooks etc.
 */


if( !class_exists( 'UABB_Model_Helper' ) ) {

	class UABB_Model_Helper
	{
		public static $bb_global_settings;

		/*
		* Constructor function that initializes required actions and hooks
		* @Since 1.0
		*/
		function __construct() {

			// Initialize BB Global Setting static variable
			UABB_Model_Helper::$bb_global_settings = FLBuilderModel::get_global_settings();
		}

		/**
		 * Get Templates based on category
		 */
		static public function get_post_template( $type = 'layout' ) {
			$posts = get_posts( array(
					'post_type'      => 'fl-builder-template',
					'orderby'        => 'title',
					'order'          => 'ASC',
					'posts_per_page' => '-1',
					'tax_query'      => array(
						array(
							'taxonomy' => 'fl-builder-template-type',
							'field'    => 'slug',
							'terms'    => $type
						)
					)
				) );

			$templates = array();
		
			foreach ( $posts as $post ) {
				
				$templates[] = array(
					'id'     => $post->ID,
					'name'   => $post->post_title,
					'global' => get_post_meta( $post->ID, '_fl_builder_template_global', true ),
					//'link' => add_query_arg( 'fl_builder', '', get_permalink( $post->ID ) ),
				);
			}
			
			return $templates;
		}


		/**
		 *	Get - Saved row templates
		 *
		 * @return  $option_array
		 * @since 	1.1.0.1
		 */		
		static public function get_saved_page_template() {
			if ( FLBuilderModel::node_templates_enabled() ) {
				
				$page_templates = UABB_Model_Helper::get_post_template( 'layout' );
				$node_template  = FLBuilderModel::is_post_node_template();
				
				$options = array();
				
				if ( count($page_templates) ) {
					foreach ($page_templates as $page_template) {
                		$options[$page_template['id']] = $page_template['name'];
					}
				}else{
					$options['no_template'] = "It seems that, you have not saved any template yet.";
				}
        		return $options;
			}
		}

		/**
		 *	Get - Saved row templates
		 *
		 * @return  $option_array
		 * @since 	1.1.0.1
		 */		
		static public function get_saved_row_template() {
			if ( FLBuilderModel::node_templates_enabled() ) {
			
				$saved_rows    = UABB_Model_Helper::get_post_template( 'row' );
				$node_template = FLBuilderModel::is_post_node_template();
				
				// Don't show global rows for node templates.
				/*foreach ( $saved_rows as $key => $val ) {
					if ( $node_template && $val['global'] ) {
						unset( $saved_rows[ $key ] );
					}
				}*/
        		$options = array();
				if ( count($saved_rows) ) {
					foreach ($saved_rows as $saved_row) {
                		$options[$saved_row['id']] = $saved_row['name'];
					}
				} else {
					$options['no_template'] = "It seems that, you have not saved any template yet.";
				}
        		return $options;
			}
		}

		/**
		 *	Get - Saved module templates
		 *
		 * @return  $option_array
		 * @since 	1.1.0.1
		 */		
		static public function get_saved_module_template() {
			if ( FLBuilderModel::node_templates_enabled() ) {
			
				$saved_modules = UABB_Model_Helper::get_post_template( 'module' );
				$node_template = FLBuilderModel::is_post_node_template();
				
				// Don't show global rows for node templates.
				/*foreach ( $saved_modules as $key => $val ) {
					if ( $node_template && $val['global'] ) {
						unset( $saved_modules[ $key ] );
					}
				}*/
        		$options = array();
				if ( count($saved_modules) ) {
					foreach ($saved_modules as $saved_module) {
                		$options[$saved_module['id']] = $saved_module['name'];
					}
				}else{
					$options['no_template'] = "It seems that, you have not saved any template yet.";
				}
        		return $options;
			}
		}
	}
	new UABB_Model_Helper();
}

// BB_Ultimate_Addon_Helper::uabb_section_register( 'content_type',
//     array(
//         'title'     => __('Content', 'uabb'),
//         'fields'    => array(
//             'content_type'       => array(
//                 'type'          => 'select',
//                 'label'         => __('Type', 'uabb'),
//                 'default'       => 'content',
//                 'options'       => array(
// 					'content' 		=> __('Content', 'uabb'),
// 					'photo'   		=> __('Photo', 'uabb'),
// 					'video'   		=> __('Video Embed Code', 'uabb'),
// 					/*'url'     		=> __('Video Embed URL', 'uabb'),*/
// 					/*'html'    		=> __('Raw HTML', 'uabb'),*/
//                     'saved_rows'		=> array(
// 						'label'         => __('Saved Rows', 'uabb'),
// 						'premium'       => true
// 					),
// 					'saved_modules'		=> array(
// 						'label'         => __('Saved Modules', 'uabb'),
// 						'premium'       => true
// 					),
// 					'saved_page_templates'		=> array(
// 						'label'         => __('Saved Page Templates', 'uabb'),
// 						'premium'       => true
// 					),
//                 ),
//                 'toggle'        => array(
//                     'content'       => array(
//                         'fields'        => array('ct_content')
//                     ),
//                     'photo'        => array(
//                         'fields'        => array('ct_photo')
//                     ),
//                     'video'         => array(
//                         'fields'        => array('ct_video')
//                     ),
//                     /*'url'           => array(
//                         'fields'        => array('ct_video_url')
//                     ),*/
//                     /*'html'          => array(
//                         'fields'        => array('ct_html')
//                     ),*/
//                     'saved_rows'     => array(
//                         'fields'        => array('ct_saved_rows')
//                     ),
//                     'saved_modules'     => array(
//                         'fields'        => array('ct_saved_modules')
//                     ),
//                     'saved_page_templates'     => array(
//                         'fields'        => array('ct_page_templates')
//                     )
//                 )
//             ),
//             'ct_content'   => array(
//                 'type'                  => 'editor',
//                 'label'                 => '',
//                 'default'				=> '',
//             ),
//             'ct_photo'     => array(
//                 'type'                  => 'photo',
//                 'label'                 => __('Select Photo', 'uabb'),
//                 'show_remove'			=> true,
//             ),
//             'ct_video'     => array(
//                 'type'                  => 'textarea',
//                 'label'                 => __('Embed Code / URL', 'uabb'),
//                 'rows'                  => 6
//             ),
//             /*'ct_video_url'       => array(
//                 'type'                  => 'text',
//                 'label'                 => __('URL', 'uabb'),
//                 'placeholder'           => 'http://www.example.com',
//                 'default'               => '',
//             ),*/
//             /*'ct_html'      => array(
//                 'type'                  => 'code',
//                 'editor'                => 'html',
//                 'label'                 => '',
//                 'rows'                  => 15,
//             ),*/
//             'ct_saved_rows'      => array(
//                 'type'                  => 'select',
//                 'label'                 => __('Select Row', 'uabb'),
//                 'options'               => UABB_Model_Helper::get_saved_row_template(),
//             ),
//             'ct_saved_modules'      => array(
//                 'type'                  => 'select',
//                 'label'                 => __('Select Module', 'uabb'),
//                 'options'               => UABB_Model_Helper::get_saved_module_template(),
//             ),
//             'ct_page_templates'      => array(
//                 'type'                  => 'select',
//                 'label'                 => __('Select Page Template', 'uabb'),
//                 'options'               => UABB_Model_Helper::get_saved_page_template(),
//             )
//         )
//     ) 
// );
