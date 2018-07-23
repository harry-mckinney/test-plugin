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

class testPlugin{

  function __construct(){
    add_action('init', array( $this, 'custom_post_type'))
  }

  function activate(){
    //generate a CPT
    //flush rewrite rules
  }

  function deactivate(){
    // flush rewrite rules
  }

  function uninstall(){
    //delete CPT
    //delete all plugin data from the database
  }

  function custom_post_type(){
    register_post_type('screen-cast', ['public'=>true, 'label' => 'Screen Cast']);
  }


}

if (class_exists('testPlugin')){

  $testPlugin = new testPlugin();

}

// native assets run during activation, deactivation and uninstallation of the plugin

//activate
register_activation_hook( __FILE__, array( $testPlugin, 'activate'));

//deactivate
register_deactivation_hook( __FILE__, array( $testPlugin, 'deactivate'));

//uninstall
