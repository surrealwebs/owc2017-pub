<?php

FLBuilderModel::default_settings($settings, array(
	'post_type' => 'post',
	'order_by'  => 'date',
	'order'     => 'DESC',
	'users'     => '',
	'total_posts_switch' => 'custom',
	'total_posts' => '6',
));

?>
<div id="fl-builder-settings-section-general" class="fl-loop-builder uabb-settings-section">

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
        'help' 			=> __( 'Enter the total number of posts you want to display in module.', 'uabb' ),
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
			'rand'        	=> __('Random', 'uabb'),
		)
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

<div id="fl-builder-settings-section-filter" class="uabb-settings-section">
	<h3 class="fl-builder-settings-title"><?php _e('Filter', 'uabb'); ?></h3>
	<?php foreach(FLBuilderLoop::post_types() as $slug => $type) : ?>
		<table class="fl-form-table fl-loop-builder-filter fl-loop-builder-<?php echo $slug; ?>-filter" <?php if($slug == $settings->post_type) echo 'style="display:table;"'; ?>>
		<?php

		// Posts
		FLBuilder::render_settings_field('posts_' . $slug, array(
			'type'          => 'suggest',
			'action'        => 'fl_as_posts',
			'data'          => $slug,
			'label'         => $type->label,
			'help'          => sprintf(__('Enter a comma separated list of %s. Only these %s will be shown.', 'uabb'), $type->label, $type->label)
		), $settings);

		// Taxonomies
		$taxonomies = FLBuilderLoop::taxonomies($slug);
		$taxonomies_array = array();

		foreach($taxonomies as $tax_slug => $tax) {

			FLBuilder::render_settings_field('tax_' . $slug . '_' . $tax_slug, array(
				'type'          => 'suggest',
				'action'        => 'fl_as_terms',
				'data'          => $tax_slug,
				'label'         => $tax->label,
				'help'          => sprintf(__('Enter a comma separated list of %s. Only posts with these %s will be shown.', 'uabb'), $tax->label, $tax->label)
			), $settings);

			$taxonomies_array[$tax_slug] = $tax->label;
		}

		?>
		</table>
	<?php endforeach; ?>
	<table class="fl-form-table">
	<?php

	// Author
	FLBuilder::render_settings_field('users', array(
		'type'          => 'suggest',
		'action'        => 'fl_as_users',
		'label'         => __('Authors', 'uabb'),
		'help'          => __('Enter a comma separated list of authors usernames. Only posts with these authors will be shown.', 'uabb')
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
				'help'			=> __( 'Select post filter criteria to display post filter buttons at top of the module.', 'uabb' ),
				'options'       => $taxonomies_array,
			), $settings);
		}
		?>
		</table>
	<?php endforeach; ?>
</div>