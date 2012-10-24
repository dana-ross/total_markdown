<?php
/*
Plugin Name: Total Markdown
Plugin URI: 
Description: 
Author: Dave Ross
Version: 0.1
Author URI: http://davidmichaelross.com
License: BSD
*/

class TotalMarkdown {
	public static function wp_default_editor() {
		return 'html';
	}

	public static function admin_enqueue_scripts() {
		wp_register_script( 'total_markdown', plugins_url('total_markdown.js', __FILE__), 'jquery', '1.0.0', true );
        wp_enqueue_script( 'total_markdown' );
	}

    public static function init() {
	    remove_filter('the_content', 'wpautop');
	    remove_filter('the_content', 'wptexturize');
    }

    public static function the_content($content) {
    	return Markdown($content);
    }

}

add_filter( 'wp_default_editor', array('TotalMarkdown', 'wp_default_editor') );
add_action( 'admin_enqueue_scripts', array('TotalMarkdown', 'admin_enqueue_scripts' ));
add_action( 'init', array('TotalMarkdown', 'init'));
add_filter( 'the_content', array('TotalMarkdown','the_content') );

if(!defined('MARKDOWN_VERSION')) {
	include(dirname(__FILE__)."/markdown/markdown.php");
}
