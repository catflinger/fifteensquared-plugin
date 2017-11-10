<?php
/*
Plugin Name: fifteensquared-plugin
Plugin URI: http://fifteensquared.net
Description: site-specefic alterations for fifteensquared.net
Version: 1.0
Author: Paul Drury
Author URI: http://admin@fifteensquared.net
License: GPL2
*/

function fifteensquared_register_css() {

	wp_register_style( 'fifteensquared_css', plugins_url("fifteensquared-plugin/site.css"); );

	wp_enqueue_style( 'fifteensquared_css' );
}

add_action( 'wp_enqueue_scripts', 'fifteensquared_register_css', 99 );