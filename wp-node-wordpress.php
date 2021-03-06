<?php
/*
Plugin Name: wp-node-wordpress
Plugin URI: http://www.arnaldocapo.com/
Description: Provides signal communications between your Node.JS environment and WordPress
Version: 1
Author: Arnaldo Capo
Author URI: http://www.arnaldocapo.com/
*/

function wp_node__send_post($args) {

  $result = wp_remote_post( WP_NODE_CLEAR_CACHE_ENDPOINT, $args );

  if ( is_wp_error($result) )
    error_log( $result->get_error_message() );

}

add_action( 'save_post', function( $post_id ) {

  // Let's ignore only if this is a revision
  if ( wp_is_post_revision( $post_id ) )
   return;

  $args = array(
    'body' => array(
      'secret'  => WP_NODE_SECRET,
      'post_id' => $post_id,
      'type'    => 'post'
    ),
  );

  wp_node__send_post( $args );

});

add_action( 'edit_category', function($category_id){

  $categories = split( ';', get_category_parents( $category_id, false, ';' ) );

  array_pop( $categories );

  $args = array(
    'body' => array(
      'secret'      => WP_NODE_SECRET,
      'type'        => 'categories',
      'categories'  => $categories
    ),
  );
  
  wp_node__send_post( $args );

});

?>
