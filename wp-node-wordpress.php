<?php
/*
Plugin Name: wp-node-wordpress
Plugin URI: http://localhost:3000.
Description: Provides signal communications between your Node.JS environment and WordPress
Version: 1
Author: Arnaldo Capo
Author URI: http://www.arnaldocapo.com/
*/



add_action( 'save_post', function( $post_id ) {

  // // If this is just a revision, don't send the email.
  // if ( wp_is_post_revision( $post_id ) )
  //  return;

  $args = array();
  $result = wp_remote_post( 'http://localhost:3000/wp-node-cache/' . $post_id, $args );

});



?>