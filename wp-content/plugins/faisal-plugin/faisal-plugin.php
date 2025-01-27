<?php
/*
 * @package Faisalplugin
 */
/**
 * Plugin Name: Faisal Plugin
 * Plugin URI: http://github.com/faisalahammed044274/faisal-plugin
 * Description: This is my first attempt on writing a custom Plugin.
 * Version: 1.0.0
 * Author: Faisal
 * Author URI: http://github.com/faisalahammed044274
 * License: GPLv2 or later
 * Text Domain: faisal-plugin
 */

/*
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 2, as published by the Free Software Foundation. You may NOT assume that you can use any other version of the GPL.
We also offer this code under the MIT license. You may use it however you wish.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

// if ( ! defined( 'ABSPATH' ) ) {
//     die;
// }   // this is a security feature to prevent direct access to the plugin file.


// if ( ! function_exists( 'add_action' ) ) {
    //     echo 'Hey, you can\t access this file, you silly human!';
    //     exit;
    // }


defined( 'ABSPATH' ) or die( 'Hey, you can\'t access this file, you silly human!' );

class FaisalPlugin 
{
    //methods

    //public methods - accessible from outside the class
    // protected methods - accessible from within the class and its child classes
    // private methods - accessible only from within the class

    function __construct() {
        add_action( 'init', array( $this, 'custom_post_type' ) );
        // this will only run the custom_post_type method if the class exists
        $this->print_stuff(); // this will only run the register method if the class exists
        $this->create_post_type();
    }

    function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) ); // this will only run the enqueue method if the class exists
    }

        function activate() {
            // generated a CPT
            $this->custom_post_type();
            // flush rewrite rules
            flush_rewrite_rules();
        }

        function deactivate() {
            // flush rewrite rules
            flush_rewrite_rules();
        }

        // function uninstall() {
        //     // delete CPT
        //     // delete all the plugin data from the DB
        // }

        function custom_post_type(){
            // register a custom post type
            // register a custom taxonomy
            register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
        }

        function enqueue() {
            // enqueue all the scripts
            wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/my-style.css', __FILE__ ) );
            wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/my-script.js', __FILE__ ) );
        }

        protected function create_post_type(){
            add_action( 'init', array( $this, 'custom_post_type' ) );
        }

        private function print_stuff() {
            var_dump( 'This is a test private function' );
        }
}

class SecondaryClass extends FaisalPlugin 
{


    function __construct(){
       // $this->print_stuff();
    }



    function register_post_type(){
        $this->create_post_type(); // this will only run the create_post_type method if the class exists
    }
}

if (class_exists('FaisalPlugin')) {
    //instantiates the class / INSTANCE
    $faisalPlugin = new FaisalPlugin(); // this will only run the constructor if the class exists
    $faisalPlugin->register(); // this will only run the register method if the class exists
}

// activation
register_activation_hook( __FILE__, array( $faisalPlugin, 'activate' ) );
// deactivation
register_deactivation_hook( __FILE__, array( $faisalPlugin, 'deactivate' ) );
// uninstall
// register_uninstall_hook( __FILE__, array( $faisalPlugin, 'uninstall' ) );
