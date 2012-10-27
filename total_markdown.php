<?php
/*
Plugin Name: Total Markdown
Plugin URI: https://github.com/daveross/total_markdown
Description:  Lightweight Markdown support
Author: Dave Ross
Version: 0.2
Author URI: http://davidmichaelross.com
License: BSD
*/

class TotalMarkdown {

    public static function init() {
        remove_filter('the_content', 'wpautop');
        remove_filter('the_content', 'wptexturize');
    }

    public static function admin_enqueue_scripts() {
        wp_register_script( 'total_markdown', plugins_url('total_markdown.js', __FILE__), 'jquery', '1.0.0', true );
        wp_enqueue_script( 'total_markdown' );
    }

    public static function the_content($content) {
    	return Markdown($content);
    }

    public static function user_can_richedit($huh) {
	return false;
    }

}

add_action( 'init', array('TotalMarkdown', 'init'));
add_action( 'admin_enqueue_scripts', array('TotalMarkdown', 'admin_enqueue_scripts' ));
add_filter( 'the_content', array('TotalMarkdown','the_content') );
add_filter( 'user_can_richedit', array('TotalMarkdown', 'user_can_richedit'));

if(!defined('MARKDOWN_VERSION')) {
	include(dirname(__FILE__)."/markdown/markdown.php");
}
