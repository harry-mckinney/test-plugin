<?php

/**
* Trigger this file when the user uninstalls the plugin
*
*@package Test Plugin
*
*/

if ( ! defined ( 'WP_UNINSTALL_PLUGIN' ) ){
  die;
}

//this file clears database storage data for the plugin

//NOTE this below commented code is a non-global option
/*
$screencasts = get_posts( array( 'post_type' => 'screencast', 'numberposts' => -1 ) );

foreach($screencasts as $screencast) {
  wp_delete_post($screencast->ID, true);
}
*/

//NOTE this is a global one size fits all option
//access the database by SQL

global $wpdb;

$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'screencast'");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT in (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");
