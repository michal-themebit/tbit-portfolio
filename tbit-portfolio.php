<?php
/*
Plugin Name: ThemeBit Portfolio
Plugin URI: http://themebit.com/plugins/tbit-portfolio/
Description: Add a portfolio section to your WordPress site.
Version: 1.0
Author: Michał Wilkosiński
Author URI: http://themebit.com/
License: GPLv2 or later
*/

/*
Copyright (C) 2012  Michał Wilkosiński, ThemeBit.com

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


if ( !class_exists('Tbit_Portfolio') ):
class Tbit_Portfolio
{
	public $plugin_name = 'ThemeBit Portfolio';
	public $version = '1.0';
	public $plugin_file;
	
	
	public function __construct ()
	{
		$this->plugin_name = plugin_basename( __FILE__ );
		
		// Run plugin activation function
		register_activation_hook( $this->plugin_file, array($this, 'activate_plugin') );
		
		// Register custom post type
		add_action( 'init', array($this, 'register_post_type') );
	}
	
	
	/**
	 * Run this method when plugin is activated
	 *
	 * @access public
	 * @since 1.0
	 */
	public function activate_plugin()
	{
		// Call this method to get the rewrite rules set for the custom post type
		$this->register_post_type();
		
		// Now flush the rewrite rules
		flush_rewrite_rules();
		
		// Set default options
		

	}
	
	
	/**
	 * Register 'tbit_portfolio' custom post type
	 *
	 * @access public
	 * @since 1.0
	 */
	public function register_post_type ()
	{
		$labels = array(
			'name'                => __( 'Portfolio', 'tbit_portfolio' ),
			'singular_name'       => __( 'Portfolio Item', 'tbit_portfolio' ),
			'add_new'             => __( 'Add New', 'tbit_portfolio' ),
			'add_new_item'        => __( 'Add New Item', 'tbit_portfolio' ),
			'edit_item'           => __( 'Edit Item', 'tbit_portfolio' ),
			'new_item'            => __( 'New Item', 'tbit_portfolio' ),
			'all_items'           => __( 'All Items', 'tbit_portfolio' ),
			'view_item'           => __( 'View Item', 'tbit_portfolio' ),
			'search_items'        => __( 'Search Portfolio', 'tbit_portfolio' ),
			'not_found'           => __( 'No portfolio items found', 'tbit_portfolio' ),
			'not_found_in_trash'  => __( 'No portfolio items found in Trash', 'tbit_portfolio' ),
			'menu_name'           => __( 'Portfolio', 'tbit_portfolio' )
		);
		$args = array(
			'labels'              => $labels,
			'public'              => TRUE,
			'exclude_from_search' => FALSE, // TODO - make this an option in the admin
			'menu_position'       => 20,
			'capability_type'     => 'post',
			'supports'            => array(
				'title',
				'thumbnail',
				'editor'
			),
			'taxonomies'          => array(),
			'has_archive'         => 'portfolio',  // TODO - make this an option in the admin
			'rewrite'             => array(
				'slug'        => 'portfolio-item',  // TODO - make this an option in the admin
				'with_front'  => FALSE
			),
		);
		register_post_type( 'tbit_portfolio', $args);
	}
	
}
endif;


if ( class_exists('Tbit_Portfolio') ) {
	$tbit_portfolio = new Tbit_Portfolio();
}