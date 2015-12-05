<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @init all widgets
 * @return widget
 */

require_once ( Wp_Mega_Bundle::plugin_dir() . '/widgets/class-mailchimp.php'); //Mail Chimp
require_once ( Wp_Mega_Bundle::plugin_dir() . '/widgets/class-instagram.php'); //Instagram
require_once ( Wp_Mega_Bundle::plugin_dir() . '/widgets/class-flickr.php'); //Flickr
require_once ( Wp_Mega_Bundle::plugin_dir() . '/widgets/class-facebook-like.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/widgets/class-facebook-page.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/widgets/class-facebook-share.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/widgets/class-facebook-send.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/widgets/class-facebook-video.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/widgets/class-twitter.php'); //Twitter widget