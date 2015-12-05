<?php
/**
 * File Type: Framework Base class
 */
if (!class_exists('MB_System_Helper')) {

    class MB_System_Helper {

        public function __construct() {
            add_shortcode('mb_twitter' , array (&$this , 'shortCodeCallBack'));
        }

        /**
         * 
         * @param type $length
         * @return string
         */
        public function mb_get_uniqueue_flag($length = 5) {
            $set    = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $string = '';
            for ($i = 0; $i < $length; $i++) {
                $string .= $set[rand(0, strlen($set) - 1)];
            }
            return $string;
        }
    }

    new MB_System_Helper();
}