<?php
/**
 * Advanced Table Block
 *
 * @package     AdvancedTableBlock
 * @author      Rich Tape, Kelvin Xu, Advanced Gutenberg, Elaine Shannon
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Advanced Table Block
 * Plugin URI:  #
 * Description: Advanced Table Block
 * Version:     0.1.0
 * Author:      Rich Tape, Kelvin Xu, Advanced Gutenberg, Elaine Shannon
 * Author URI:  #
 * Text Domain: advanced-table-block
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

/*
 * This block is a combination of work from Elaine Shannon at St Mary's Texas,
 * The Advanced Gutenberg plugin, and our own work at UBC.
 *
 * Elaine's post ( https://sites.stmarytx.edu/webelaine/2019/05/20/gutenberg-building-a-more-accessible-table-block/)
 * helped inspire us to build an accessible, full-featured, table block that allows users
 * to display tabular data.
 *
 * The folks at Advanced Gutenberg have a block which allows folks to merge cells in rows
 * or columns.
 *
 * We required an accessible table block, that allows captions, cell merging, and custom
 * styles. This, with the help of the folks listed above, is the end result.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'enqueue_block_assets', 'atb_plugins_loaded__atb_loader' );

/**
 * Load the required bits and pieces
 *
 * @return void
 */
function atb_plugins_loaded__atb_loader() {

	if ( ! is_admin() ) {
		return;
	}

	wp_register_script(
		'advanced-table-block',
		plugins_url( '/build/index.js', __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-editor',
			'wp-plugins',
			'wp-edit-post',
			'wp-dom-ready',
			'wp-rich-text',
		),
		filemtime( plugin_dir_path( __FILE__ ) . 'build/index.js' ),
		false
	);

	$advanced_table_block = array(
		'atbsettings' => array(
			array(
				'label'    => __( 'Table Settings', 'advanced-table-block' ),
				'settings' => array(
					array(
						'title' => __( 'Max width', 'advanced-table-block' ),
						'type'  => 'number',
						'name'  => 'maxWidth',
						'min'   => 0,
						'max'   => 1999,
					),
				),
			),
		),
	);

	wp_localize_script( 'advanced-table-block', 'advancedTableBlock', $advanced_table_block );

	wp_enqueue_script( 'advanced-table-block' );

	wp_enqueue_style( 'advanced-table-block', plugins_url( '/build/index.css', __FILE__ ) );

}//end atb_plugins_loaded__atb_loader()
