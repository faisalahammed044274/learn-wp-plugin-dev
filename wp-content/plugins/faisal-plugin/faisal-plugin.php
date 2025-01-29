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
 * License: GPL-2.0-or-later
 * Text Domain: faisal-plugin
 */

defined( 'ABSPATH' ) or die( 'Hey, you can\'t access this file, you silly human!' );

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
} else {
    error_log('Autoload file not found');
}

// Make sure the classes exist before using them
if (!class_exists('Inc\Activate') || !class_exists('Inc\Deactivate')) {
    error_log('Activate or Deactivate class not found. Run composer dump-autoload.');
}

// Activation & Deactivation Hooks
register_activation_hook(__FILE__, array('Inc\Activate', 'activate'));
register_deactivation_hook(__FILE__, array('Inc\Deactivate', 'deactivate'));

if (!class_exists('FaisalPlugin')) {
    class FaisalPlugin 
    {
        public $plugin;

        function __construct() {
            $this->plugin = plugin_basename(__FILE__);
            $this->create_post_type();
        }

        function register() {
            add_action('admin_enqueue_scripts', array($this, 'enqueue')); 
            add_action('admin_menu', array($this, 'add_admin_pages'));
            add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
        }

        function settings_link($links) {
            $settings_link = '<a href="admin.php?page=faisal_plugin">Go to Settings</a>';
            array_push($links, $settings_link);
            return $links;
        }

        function add_admin_pages() {
            add_menu_page('Faisal Plugin', 'Faisal', 'manage_options', 'faisal_plugin', array($this, 'admin_index'), 'dashicons-store', 110);
        }

        function admin_index() {
            require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
        }

        function custom_post_type() {
            register_post_type('book', ['public' => true, 'label' => 'Books']);
        }

        function enqueue() {
            wp_enqueue_style('mypluginstyle', plugins_url('/assets/my-style.css', __FILE__));
            wp_enqueue_script('mypluginscript', plugins_url('/assets/my-script.js', __FILE__));
        }

        protected function create_post_type() {
            add_action('init', array($this, 'custom_post_type'));
        }
    }

    $faisalPlugin = new FaisalPlugin();
    $faisalPlugin->register();
}
