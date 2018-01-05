<?php
/*
Plugin Name: fifteensquared-plugin
Plugin URI: http://fifteensquared.net/wordpress-plugins/fifteensquared
Description: adds site-specefic behavious to the WPTouch theme for fifteensquared.net
Version: 1.1.0
Author: Paul Drury
Author URI: http://admin@fifteensquared.net
License: GPL2
*/

function fifteensquared_register_css() {

	wp_register_style( 'fifteensquared_css', plugins_url("fifteensquared-plugin/site.css") );

	wp_enqueue_style( 'fifteensquared_css' );
}

add_action( 'wp_enqueue_scripts', 'fifteensquared_register_css', 99 );

/*
The following section is copied and slightly modified from Till Kruss's plugin.  
Many thanks to Till for the use of this code. 

05 January 2018 - disable paste-as-text in admin mode

URI: http://wordpress.org/plugins/paste-as-plain-text/
Version: 1.0.1
Author: Till Krüss
Author URI: http://till.kruss.me/
License: GPLv3
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
class PeeDeePasteAsPlainText {
    
            function __construct() {
                add_action( 'init', array( $this, 'init' ) );
            }
    
            function init() {
                add_filter( 'tiny_mce_before_init', array( $this, 'force_paste_as_plain_text' ) );
                add_filter( 'teeny_mce_before_init', array( $this, 'force_paste_as_plain_text' ) );
                add_filter( 'teeny_mce_plugins', array( $this, 'load_paste_plugin' ) );
                add_filter( 'mce_buttons_2', array( $this, 'remove_button' ) );
            }
    
            function force_paste_as_plain_text( $mceInit ) {
                global $tinymce_version;
    
                if ( $tinymce_version[0] < 4 ) {
                        $mceInit[ 'paste_text_sticky' ] = true;
                        $mceInit[ 'paste_text_sticky_default' ] = true;
                } else {
                        $mceInit[ 'paste_as_text' ] = true;
                }
                return $mceInit;
            }
    
            function load_paste_plugin( $plugins ) {
                return array_merge( $plugins, array( 'paste' ) );
            }
    
            function remove_button( $buttons ) {
                if( ( $key = array_search( 'pastetext', $buttons ) ) !== false ) {
                        unset( $buttons[ $key ] );
                }
                return $buttons;
            }
    
    }
    
    if ( !is_admin() ) {
        new PeeDeePasteAsPlainText();
    }