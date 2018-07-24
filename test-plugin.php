<?php

/**
*@package Test Plugin
*/

/*
Plugin Name: Test Plugin
Plugin URI: http://www.test@test.net
Description: Test Plugin
Version: 1.0.0
Author: Test Plugin Engineering Society
Author URI: http://test-land.test
License: MIT
Text Domain: test-Plugin
*/

/*
Copyright (c) 2018 Harry McKinney

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

if( ! defined( 'ABSPATH' ) ){

  die; //this is a simple way to keep out users w/o proper permissions

}

//echo plugins_url(); //NOTE http://localhost:8888/wordpress/wp-content/plugin

class testPlugin{

  function __construct(){
    add_action('init', array( $this, 'custom_post_type'));
  }

  function register(){
    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue') ); //NOTE w/o the admin it would show on the site
  }

  function activate(){
    //generate a CPT
    $this->custom_post_type();
    //flush rewrite rules
    flush_rewrite_rules();
  }

  function deactivate(){
    // flush rewrite rules
  }

/*
  function uninstall(){
    //delete CPT
    //delete all plugin data from the database
  }
*/

//NOTE this was moved to a root file called uninstall.php

  function custom_post_type(){
    register_post_type('screencast', ['public'=>true, 'label' => 'Screen Cast']);
  }

  // Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Post Types', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Post Types', 'text_domain' ),
		'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Post Type', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => false,
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'post_type', $args );

}
add_action( 'init', 'custom_post_type', 0 );

  function enqueue(){
    //enqueue all scripts
    wp_enqueue_style( 'style', plugins_url('/assets/style.css', __FILE__) );
    wp_enqueue_script( 'script', plugins_url('/assets/script.js', __FILE__) );
  }

}

if (class_exists('testPlugin')){

  $testPlugin = new testPlugin();
  $testPlugin->register();

}

// native assets run during activation, deactivation and uninstallation of the plugin

//activate
register_activation_hook( __FILE__, array( $testPlugin, 'activate'));

//deactivate
register_deactivation_hook( __FILE__, array( $testPlugin, 'deactivate'));

//uninstall
//register_uninstall_hook( __FILE__, array( $testPlugin, 'uninstall'));
