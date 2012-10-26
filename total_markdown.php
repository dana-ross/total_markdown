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

    public static function init() {
	    remove_filter('the_content', 'wpautop');
	    remove_filter('the_content', 'wptexturize');
    }

    public static function the_content($content) {
    	return Markdown($content);
    }

    public static function user_can_richedit($huh) {
	return false;
    }

}

add_action( 'init', array('TotalMarkdown', 'init'));
add_filter( 'the_content', array('TotalMarkdown','the_content') );
add_filter( 'user_can_richedit', array('TotalMarkdown', 'user_can_richedit'));

if(!defined('MARKDOWN_VERSION')) {
	include(dirname(__FILE__)."/markdown/markdown.php");
}
