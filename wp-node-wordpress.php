<?php
/*
Plugin Name: wp-node-wordpress
Plugin URI: http://www.arnaldocapo.com/
Description: Provides signal communications between your Node.JS environment and WordPress
Version: 1
Author: Arnaldo Capo
Author URI: http://www.arnaldocapo.com/
*/

add_action( 'save_post', function( $post_id ) {

  // Let's ignore only if this is a revision
  if ( wp_is_post_revision( $post_id ) )
   return;

  $args = array(
    'body'  => array('secret' => WP_NODE_SECRET) 
  );
  $result = wp_remote_post( WP_NODE_CLEAR_CACHE_ENDPOINT . $post_id, $args );

});


?>