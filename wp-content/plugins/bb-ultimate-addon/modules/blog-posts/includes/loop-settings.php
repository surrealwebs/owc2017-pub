<?php

FLBuilderModel::default_settings($settings, array(
	'post_type' => 'post',
	'order_by'  => 'date',
	'order'     => 'DESC',
	'users'     => '',
	'total_posts_switch' => 'custom',
	'total_posts' => '6',
));

$settings = apply_filters( 'fl_builder_loop_settings', $settings );  //Allow extension of default Values

do_action( 'uabb_loop_settings_before_form', $settings ); // e.g Add custom FLBuilder::render_settings_field()
?>
<div id="fl-builder-settings-section-source" class="fl-loop-data-source-select fl-builder-settings-section">
	<table class="fl-form-table">
	<?php

	// Data Source
	FLBuilder::render_settings_field('data_source', array(
		'type'          => 'select',
		'label'         => __('Source', 'uabb'),
		'default'		=> 'custom_query',
		'options'       => array(
			'custom_query'  => __('Custom Query', 'uabb'),
			'main_query'    => __('Main Query', 'uabb'),
		),
		'toggle'        => array(
			'custom_query'  => array(
				'fields'        => array( 'posts_per_page' )
			)
		)
	), $settings);

	?>
	</table>
</div>
<div class="fl-custom-query fl-loop-data-source" data-source="custom_query">
<div id="fl-builder-settings-section-general" class="fl-loop-builder uabb-settings-section">
<h3 class="fl-builder-settings-title"><span class="fl-builder-settings-title-text-wrap"><?php _e('Custom Query', 'uabb'); ?></span></h3>
	<table class="fl-form-table">
	<?php

	// Post type
	FLBuilder::render_settings_field('post_type', array(
		'type'          => 'post-type',
		'label'         => __('Post Type', 'uabb'),
		'help' 			=> __( 'Choose the post type to display in module.', 'uabb' ),
	), $settings);


	FLBuilder::render_settings_field('total_posts_switch', array(
		'type'          => 'uabb-toggle-switch',
        'label'         => __( 'Number of Posts to Display', 'uabb' ),
        'help' 			=> __( 'Choose the number of posts you want to display in module.', 'uabb' ),
        'default'       => 'custom',
        'options'       => array(
            'all'       => __( 'All', 'uabb' ),
            'custom'    => __( 'Custom', 'uabb' ),
        ),
        'toggle'    => array(
            'custom'    => array(
                'fields'    => array( 'total_posts', 'offset' ),
            ),
            'all'    => array(
                'fields'    => array(),
            )
        ),
	), $settings);

	FLBuilder::render_settings_field('total_posts', array(
		'type' 			=> 'text',
        'label' 		=> __('Posts Count', 'uabb'),
        'help' 			=> __( 'Enter the total number of posts you want to display in module. Scroll pagination will show all posts.', 'uabb' ),
        'default'		=> '6',
        'size' 			=> '8',
        'placeholder'	=> '10',
	), $settings);


	//Offset
	FLBuilder::render_settings_field('offset', array(
		'type' 			=> 'text',
        'label' 		=> __('Offset', 'uabb'),
        'help' 			=> __( 'Enter the total number of posts you want skip.', 'uabb' ),
        'size' 			=> '8',
        'placeholder'	=> '0',
	), $settings);


	// Order by
	FLBuilder::render_settings_field('order_by', array(
		'type'          => 'select',
		'label'         => __('Sort By', 'uabb'),
		'help' 			=> __( 'Choose the parameter to sort your posts.', 'uabb' ),
		'options'       => array(
			'ID'            => __('ID', 'uabb'),
			'date'          => __('Date', 'uabb'),
			'modified'      => __('Date Last Modified', 'uabb'),
			'title'         => __('Title', 'uabb'),
			'author'        => __('Author', 'uabb'),
			'comment_count' => __('Comment Count', 'uabb'),
			'menu_order'    => __('Menu Order', 'uabb'),
			'meta_value'    => __('Meta Value (Alphabetical)', 'uabb'),
			'meta_value_num'    => __('Meta Value (Numeric)', 'uabb'),
			'rand'      	=> __('Random', 'uabb'),
		),
		'toggle'		=> array(
			'meta_value' 	=> array(
				'fields'		=> array( 'order_by_meta_key' ),
			),
			'meta_value_num' => array(
				'fields'		=> array( 'order_by_meta_key' ),
			),
		),
	), $settings);

	// Meta Key
	FLBuilder::render_settings_field('order_by_meta_key', array(
		'type'          => 'text',
		'label'         => __( 'Meta Key', 'uabb' ),
	), $settings);

	// Order
	FLBuilder::render_settings_field('order', array(
		'type'          => 'select',
		'label'         => __('Order', 'uabb'),
		'help' 			=> __( 'Choose the order to display your posts.', 'uabb' ),
		'default'       => 'DESC',
		'options'       => array(
			'DESC'          => __('Descending', 'uabb'),
			'ASC'           => __('Ascending', 'uabb'),
		)
	), $settings);

	?>
	</table>
</div>

<div id="fl-builder-settings-section-masonary_filter" class="uabb-settings-section">
	<h3 class="fl-builder-settings-title"><?php _e('Taxonomy Filter', 'uabb'); ?></h3>
	<?php foreach(FLBuilderLoop::post_types() as $slug => $type) : ?>
		<table class="fl-form-table fl-loop-builder-masonary_filter fl-loop-builder-<?php echo $slug; ?>-masonary_filter" <?php if($slug == $settings->post_type) echo 'style="display:table;"'; ?>>
		<?php

		// Taxonomies
		$taxonomies = FLBuilderLoop::taxonomies($slug);
		$taxonomies_array = array();
		$toggleArray = array();

		if( count($taxonomies) > 0 ) $taxonomies_array[-1] = __('No Filter', 'uabb');

		foreach($taxonomies as $tax_slug => $tax) {
			$taxonomies_array[$tax_slug] = $tax->label;
		}

		if( count( $taxonomies_array ) > 0 ) {
			// Taxonomy Filter
			FLBuilder::render_settings_field('masonary_filter_' . $slug, array(
				'type'          => 'select',
				'label'         => __('Taxonomy Filter', 'uabb'),
				'help'			=> __( 'Select post filter criteria to display post filter at top of the module.', 'uabb' ),
				'options'       => $taxonomies_array,
			), $settings);
		}
			FLBuilder::render_settings_field('uabb_masonary_filter_type_' . $slug, array(
				'type'          => 'select',
				'label'         => __( 'Select Filter Layout', 'uabb' ),
				'options'       => array(
						'buttons'       => __( 'Button', 'uabb' ),
						'drop-down'       => __( 'Drop Down', 'uabb' ),
					),
			), $settings);
		?>
		</table>
	<?php endforeach; ?>
</div>

<div id="fl-builder-settings-section-filter" class="uabb-settings-section">
<h3 class="fl-builder-settings-title"><span class="fl-builder-settings-title-text-wrap"><?php _e('Filter', 'uabb'); ?></span></h3>

	<?php foreach(FLBuilderLoop::post_types() as $slug => $type) : ?>
		<table class="fl-form-table fl-loop-builder-filter fl-loop-builder-<?php echo $slug; ?>-filter" <?php if($slug == $settings->post_type) echo 'style="display:table;"'; ?>>
		<?php

		FLBuilder::render_settings_field('posts_' . $slug . '_matching', array(
			'type'          => 'select',
			'label'         => $type->label,
			'options'       => array(
				'1'  => sprintf( __( 'Match these %s', '%s is an object like posts or taxonomies.', 'uabb' ), $type->label, $type->label ),
				'0'  => sprintf( __( 'Do not match these %s', '%s is an object like posts or taxonomies.', 'uabb' ), $type->label, $type->label ),
			),
			'help'          => sprintf(__('Enter a comma separated list of %s. Only these %s will be shown.', 'uabb'), $type->label, $type->label)
		), $settings);
		// Posts
		FLBuilder::render_settings_field('posts_' . $slug, array(
			'type'          => 'suggest',
			'action'        => 'fl_as_posts',
			'data'          => $slug,
			'label'         => '&nbsp',
		), $settings);


		// Taxonomies
		$taxonomies = FLBuilderLoop::taxonomies($slug);
		$taxonomies_array = array();

		foreach( $taxonomies as $tax_slug => $tax) {

			FLBuilder::render_settings_field('tax_' . $slug . '_' . $tax_slug . '_matching', array(
				'type'          => 'select',
				'label'         => $tax->label,
				'help'          => sprintf(__('Enter a comma separated list of %s. Only posts with these %s will be shown.', 'uabb'), $tax->label, $tax->label),
				'options'       => array(
                    '1'  => sprintf( __( 'Match these %s', '%s is an object like posts or taxonomies.', 'uabb' ), $tax->label, $tax->label ),
                    '0'    => sprintf( __( 'Do not match these %s', '%s is an object like posts or taxonomies.', 'uabb' ), $tax->label, $tax->label ),
                ),
				'help'          => sprintf(__('Enter a comma separated list of %s. Only posts with these %s will be shown.', 'uabb'), $tax->label, $tax->label)
			), $settings);
			FLBuilder::render_settings_field('tax_' . $slug . '_' . $tax_slug , array(
				'type'          => 'suggest',
				'action'        => 'fl_as_terms',
				'data'          => $tax_slug,
				'label'         => '&nbsp',
			), $settings);
			$taxonomies_array[$tax_slug] = $tax->label;
		}

		?>
		</table>
	<?php endforeach; ?>
	<table class="fl-form-table">
	<?php

	// Author

	FLBuilder::render_settings_field('users_matching', array(
		'type'          => 'select',
		'label'         => __('Authors', 'uabb'),
		'help'          => __('Enter a comma separated list of authors usernames. Only posts with these authors will be shown.', 'uabb'),
		'options'       => array(
            '1'  => __( 'Match these Authors', 'uabb' ),
            '0'    => __( 'Do not match these Authors', 'uabb' ),
        ),
		'help'          => __('Enter a comma separated list of authors usernames. Only posts with these authors will be shown.', 'uabb')
	), $settings);

	FLBuilder::render_settings_field('users', array(
		'type'          => 'suggest',
		'action'        => 'fl_as_users',
		'label'         => __('&nbsp', 'uabb'),
	), $settings);

	?>
	</table>
</div>

</div>
<?php
do_action( 'uabb_loop_settings_after_form', $settings ); // e.g Add custom FLBuilder::render_settings_field()