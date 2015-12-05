<?php
/**
 * File Type: Slider
 */
if (!class_exists('SC_Slider')) {

    class SC_Slider {

        public function __construct() {
            add_shortcode('themographics_slider' , array (&$this , 'shortCodeCallBack'));
        }

        /**
         * return Slider Data
         *
         */
        public static function shortCodeCallBack($args , $content = '') {
            
        }

    }

    new SC_Slider();
}