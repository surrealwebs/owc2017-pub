<?php
/**
 * Saved_Module_Widget class file.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Saved_Module_Widget
 */
class Saved_Module_Widget extends WP_Widget {

	/**
	 * Saved_Module_Widget constructor.
	 */
	public function __construct() {
		parent::__construct(
			'saved_module_widget',
			esc_html__( 'Saved Module Widgets', 'saved-module-widgets' ),
			array(
				'classname'   => 'Saved_Module_Widget',
				'description' => esc_html__(
					'A widget for displaying saved page builder modules.',
					'saved-module-widgets'
				),
			)
		);
	}

	/**
	 * Print widget on frontend.
	 *
	 * Requires the Beaver Builder plugin.
	 *
	 * @uses FLBuilderShortcodes::insert_layout
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title', 'before_widget', and
	 *                        'after_widget'.
	 * @param array $instance Settings for the current widget instance.
	 */
	public function widget( $args, $instance ) {

		/** @var string $title */
		$title = apply_filters( 'widget_title', $instance['title'] );

		$template = isset( $instance['template'] ) ? $instance['template'] : '';

		if ( ! class_exists( 'FLBuilderModel' ) || empty( $template ) || 'none' === $template ) {
			return;
		}

		echo $args['before_widget']; // WPCS: XSS ok.

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title']; // WPCS: XSS ok.
		}

		echo FLBuilderShortcodes::insert_layout( // WPCS: XSS ok.
			array(
				'id' => absint( $template ),
			)
		);

		echo $args['after_widget']; // WPCS: XSS ok.
	}

	/**
	 * Print widget form in Dashboard.
	 *
	 * @uses Saved_Module_Widget::get_builder_templates, esc_attr, esc_html, esc_html_e, selected
	 *
	 * @param array $instance
	 *
	 * @return void
	 */
	public function form( $instance ) {

		/**
		 * The widget title.
		 *
		 * @var string $title
		 */
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		/**
		 * The ID of the saved BB template.
		 *
		 * @var int $template
		 */
		$template = isset( $instance['template'] ) ? $instance['template'] : 'none';

		/**
		 * An array of saved 'module' templates on success. Empty array on failure.
		 *
		 * @var array $modules
		 */
		$modules = Saved_Module_Widget::get_builder_templates( 'module' );

		/**
		 * An array of saved 'row' templates on success. Empty array on failure.
		 *
		 * @var array $rows
		 */
		$rows = Saved_Module_Widget::get_builder_templates( 'row' );

		/**
		 * An array of saved 'layout' templates on success. Empty array on failure.
		 *
		 * @var array $layouts
		 */
		$layouts = Saved_Module_Widget::get_builder_templates( 'layout' );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'saved-module-widgets' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				   value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<?php

		if ( empty( $modules ) && empty( $rows ) && empty( $layouts ) ) {
			esc_html_e( 'You will need to save a module, row, or layout to use this widget.', 'saved-module-widgets' );
			return;
		}

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'template' ) ); ?>">
				<?php esc_html_e( 'Select a Saved Page Builder Template:', 'saved-module-widgets' ); ?>
			</label>

			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'template' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'template' ) ); ?>">

				<option value="none">
					<?php esc_html_e( '-- Select a Saved Page Builder Template --', 'saved-module-widgets' ); ?>
				</option>

				<?php if ( ! empty( $modules ) ) : ?>
					<optgroup label="<?php esc_html_e( 'Saved Modules', 'saved-module-widgets' ); ?>">
						<?php foreach ( $modules as $key => $value ) : ?>
							<option value="<?php echo esc_attr( $key ); ?>"
								<?php selected( $key, $template ); ?> >
								<?php echo esc_html( $value ); ?>
							</option>
						<?php endforeach; ?>
					</optgroup>
				<?php endif; ?>

				<?php if ( ! empty( $rows ) ) : ?>
					<optgroup label="<?php esc_html_e( 'Saved Rows', 'saved-module-widgets' ); ?>">
						<?php foreach ( $rows as $key => $value ) : ?>
							<option value="<?php echo esc_attr( $key ); ?>"
								<?php selected( $key, $template ); ?> >
								<?php echo esc_html( $value ); ?>
							</option>
						<?php endforeach; ?>
					</optgroup>
				<?php endif; ?>

				<?php if ( ! empty( $layouts ) ) : ?>
					<optgroup label="<?php esc_html_e( 'Saved Layouts', 'saved-module-widgets' ); ?>">
						<?php foreach ( $layouts as $key => $value ) : ?>
							<option value="<?php echo esc_attr( $key ); ?>"
								<?php selected( $key, $template ); ?> >
								<?php echo esc_html( $value ); ?>
							</option>
						<?php endforeach; ?>
					</optgroup>
				<?php endif; ?>

			</select>
		</p>

		<?php
	}

	/**
	 * Process widget options on save.
	 *
	 * @uses sanitize_text_field
	 *
	 * @param array $new_instance The new widget options.
	 * @param array $old_instance The previous widget options.
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		$instance['template'] = $new_instance['template'];

		return $instance;
	}

	/**
	 * Get saved Beaver Builder templates.
	 *
	 * @uses WP_Query
	 *
	 * @param string $type The type of Beaver Builder saved layout template to retrieve. Known valid options as of
	 *                     Beaver Builder v 1.9.4 include 'module', 'row', and 'layout'.
	 *
	 * @return array
	 */
	public static function get_builder_templates( $type = 'layout' ) {

		/**
		 * An array to hold the saved Beaver Builder templates.
		 *
		 * @var array $fl_builder_templates
		 */
		$fl_builder_templates = array();

		/**
		 * Query for fl-builder-template posts.
		 *
		 * @var WP_Query $fl_builder_templates_query
		 */
		$fl_builder_templates_query = new WP_Query(
			array(
				'post_type'      => 'fl-builder-template',
				'orderby'        => 'title',
				'order'          => 'ASC',
				'posts_per_page' => -1,
				'tax_query'      => array(
					array(
						'taxonomy' => 'fl-builder-template-type',
						'field'    => 'slug',
						'terms'    => $type,
					),
				),
			)
		);

		if ( ! $fl_builder_templates_query->have_posts() ) {
			return $fl_builder_templates;
		}

		/**
		 * Loop through the posts and assign their post ID and post title to our return array.
		 *
		 * @var WP_Post $fl_builder_template_post
		 */
		foreach ( $fl_builder_templates_query->posts as $fl_builder_template_post ) {
			$fl_builder_templates[ $fl_builder_template_post->ID ] = $fl_builder_template_post->post_title;
		}

		return $fl_builder_templates;
	}
}
