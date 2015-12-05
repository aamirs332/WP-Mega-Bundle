<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @init all Shortcodes
 * @return {HTML}
 */

require_once ( Wp_Mega_Bundle::plugin_dir() . '/shortcodes/class-mailchimp.php'); //mailchimp
require_once ( Wp_Mega_Bundle::plugin_dir() . '/shortcodes/class-twitter.php'); //twitter
require_once ( Wp_Mega_Bundle::plugin_dir() . '/shortcodes/class-flickr.php'); //flickr
require_once ( Wp_Mega_Bundle::plugin_dir() . '/shortcodes/class-facebook-like.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/shortcodes/class-facebook-page.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/shortcodes/class-facebook-share.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/shortcodes/class-facebook-send.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/shortcodes/class-facebook-video.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/shortcodes/class-instagram.php'); //Instagram