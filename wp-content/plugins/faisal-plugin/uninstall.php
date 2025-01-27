<?php

/**
 * Trigger this file on Plugin uninstall
 * 
 * @package Faisalplugin
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

// Clear Database stored data
// $books = get_posts( array( 'post_type' => 'book', 'numberposts' => -1 ) );
// foreach ( $books as $book ) {
//     wp_delete_post( $book->ID, true );
// } // true means bypass the trash and delete permanently

// Access the database via SQL
global $wpdb; // global variable to access the database
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'book'" ); // delete all the posts with post_type = 'book'

$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" ); // delete all the postmeta with post_id not in the wp_posts table

$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" ); // delete all the term_relationships with object_id not in the wp_posts table

?>