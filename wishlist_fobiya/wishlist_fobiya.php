<?php
/*
Plugin Name: Wishlist Fobiya
Plugin URI: 
Description: Wishlist plugin
Version: 1.0
Author: Fobiya
Author URI: http://
*/

require __DIR__ . '/functions.php';

//add_filter('the_content', 'wishlist_fobiya');

add_action('wp_enqueue_scripts','wishlist_fobiya_script');


