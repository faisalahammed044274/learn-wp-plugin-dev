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

defined( 'ABSPATH' ) or die( 'Hey, you can\'t access this file, you silly human!' );

if (!class_exists('FaisalPlugin')) {

class FaisalPlugin 
{

    public $plugin;

    function __construct() {
        $this->plugin = plugin_basename( __FILE__ );
    }

        function register() {
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) ); // this will only run the enqueue method if the class exists
             ;

            add_action('admin_menu', array( $this, 'add_admin_pages' ) );

            add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
        }

        function settings_link( $links ) {
            $settings_link = '<a href="options-genral.php?page=faisal_plugin">go to Settings</a>';
            array_push($links, $settings_link );
            return $links;
        }

        function add_admin_pages() {
            add_menu_page( 'Faisal Plugin', 'Faisal', 'manage_options', 'faisal_plugin', array( $this, 'admin_index' ), 'dashicons-store', 110 );
        }

        function admin_index() {
            //require template
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
        }

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

        function activate(){
            require_once plugin_dir_path( file: __FILE__ ) . 'inc/faisal-plugin-activate.php';
            FaisalPluginActivate::activate();

        }

        function deactivate(){
            require_once plugin_dir_path( file: __FILE__ ) . 'inc/faisal-plugin-deactivate.php';
            FaisalPluginDeactivate::deactivate();

        }
    }

    $faisalPlugin = new FaisalPlugin(); // this will only run the constructor if the class exists
    $faisalPlugin->register(); // this will only run the register method if the class 

// activation
register_activation_hook( __FILE__, array( $faisalPlugin, 'activate' ) );
// deactivation

register_deactivation_hook( __FILE__, array( $faisalPlugin, 'deactivate' ) );

}

