<?php

/**
 * File Type: Events
 */
if (!class_exists('TG_CoreBase')) {

    class TG_CoreBase {

        protected static $instance = null;

        public function __construct() {
            add_action('save_post' , array ($this , 'mb_save_meta_data'));
            add_action('wp_ajax_save_mb_options' , array ($this , 'save_mb_options'));
        }

        /**
         * Returns the *Singleton* instance of this class.
         *
         * @return Singleton The *Singleton* instance.
         */
        public static function getInstance() {
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Save Meta options
         *
         * @return 
         */
        public function mb_save_meta_data($post_id = '') {
            if (!is_admin()) {
                return;
            }

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }
        }

        /**
         * Save Plugin options
         *
         * @return 
         */
        public function save_mb_options($post_id = '') {
            if (!is_admin()) {
                return;
            }
            update_option('mb_plugin_options' , $_POST);
            die('1');
        }

    }

    new TG_CoreBase();
}