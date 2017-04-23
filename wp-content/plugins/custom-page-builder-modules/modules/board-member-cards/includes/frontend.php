<?php
/**
 * BaconPress_Social_Links_Menu "frontend" file.
 *
 * This file is used to render the markup output for each module instance.
 *
 * @var BaconPress_Social_Links_Menu $module   An instance of the module class.
 * @var string                       $id       The module's node ID ( i.e. $module->node ).
 * @var stdClass                     $settings The module's settings.
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

BaconPress_Board_Member_Cards::the_board_member_cards_markup( $settings );
