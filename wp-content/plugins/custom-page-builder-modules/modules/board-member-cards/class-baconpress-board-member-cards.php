<?php
/**
 * BaconPress_Social_Links_Menu class file.
 *
 * This module is for outputting a social links menu.
 *
 * Follow WordPress coding standards and conventions as closely as possible, and Beaver Builder module conventions.
 *
 * @link https://www.wpbeaverbuilder.com/custom-module-documentation/
 * @link https://make.wordpress.org/core/handbook/best-practices/coding-standards/
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class BaconPress_Social_Links_Menu
 */
class BaconPress_Board_Member_Cards extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => esc_html__( 'Board Member Cards', 'owcbpcpb' ),
				'description'     => esc_html__( 'Render the board members in a archive sorted by tag.', 'owcbpcpb' ),
				'category'        => esc_html__( 'Advanced Modules', 'owcbpcpb' ),
				'partial_refresh' => true,
			)
		);
	}

	public function enqueue_scripts() {
		$this->add_js('jquery-masonry');
		// $this->add_js( 'board-member-cards', $this->url . 'js/frontend.js', array(), '', true );
		//$this->add_js( 'board-member-cards-php', $this->url . 'includes/frontend.js.php', array('jquery-masonry'), '', true );
	}

	/**
	 * Get the markup for the board members frontend
	 * @method the_board_member_cards_markup
	 * @return VOID
	 */
	public static function the_board_member_cards_markup($settings) {
		if ($settings->board_member_tag) {
			?>
			<h2 class="fl-tag-title"><?php echo ucwords(str_replace("_", " ", $settings->board_member_tag)); ?></h2>
			<?php
			BaconPress_Board_Member_Cards::render_board_member_tag( $settings->board_member_tag );
		}
	}

	/**
	 * Render the HTML markup for the board members of the specific tag
	 * @method render_board_member_tag
	 * @param  string                  $tag Tag to be rendered
	 * @return VOID
	 */
	public static function render_board_member_tag($tag) {
		$query_args = array(
			'tag' => $tag,
			'post_type' => array('board_member')
		);
		$query = new WP_Query( $query_args );
		?>
		<div class="fl-post-grid">
			<?php
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					get_template_part('content', 'single-board_member_card');
				}
			}
			?>
		</div>
		<?php
	}

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'BaconPress_Board_Member_Cards',
	array(
		'general' => array( // Tab
			'title'    => __( 'General', 'owcbpcpb' ), // Tab title
			'sections' => array( // Tab Sections
				'general' => array( // Section
					'title'  => '', // Section Title
					'fields' => array( // Section Fields
						'board_member_tag' => array(
							'type'    => 'select',
							'label'   => __( 'Tag To Render', 'fl-builder' ),
							'default' => 'officers',
							'options' => array(
								'officers'  => __( 'Officers', 'fl-builder' ),
								'directors' => __( 'Directors', 'fl-builder' ),
							),
						),
					),
				),
			),
		),
	)
);
