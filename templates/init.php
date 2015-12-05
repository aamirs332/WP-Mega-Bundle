<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @init all templates
 * @return template
 */

require_once ( Wp_Mega_Bundle::plugin_dir() . '/templates/class-template-mailchimp.php'); //mailchimp
require_once ( Wp_Mega_Bundle::plugin_dir() . '/templates/class-template-twitter.php'); //twitter
require_once ( Wp_Mega_Bundle::plugin_dir() . '/templates/class-template-flickr.php'); //flickr
require_once ( Wp_Mega_Bundle::plugin_dir() . '/templates/class-template-facebook-like.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/templates/class-template-facebook-page.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/templates/class-template-facebook-share.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/templates/class-template-facebook-send.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/templates/class-template-facebook-video.php'); //facebook
require_once ( Wp_Mega_Bundle::plugin_dir() . '/templates/class-template-instagram.php'); //Instagram