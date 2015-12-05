<?php
defined('ABSPATH') or die('No script kiddies please!');
/**
 * @Module Configuration
 */
if (!class_exists('Mb_Modules_Configuration')) {

    class Mb_Modules_Configuration {

        public function __construct() {
            global $mb_plugin_options;
            $mb_plugin_options = get_option('mb_plugin_options');
            add_action('admin_menu' , array (&$this , 'mb_prepare_menu'));
        }

        /**
         * Mene Prepare
         */
        public function mb_prepare_menu() {
            add_menu_page('Mega Bundle' , 'Mega Bundle' , 'manage_options' , 'mb_settings' , array (&$this , 'mb_register_plugin_page') , '' , 23);
        }

        /**
         * Register Page 
         */
        public function mb_register_plugin_page() {
            ?>
            <div class="mb-options-panel">
                <div class="mb-header">
                    <div class="mb-logo"><img src="<?php echo Wp_Mega_Bundle::plugin_url() . '/core/assets/images/logo.png'; ?>" alt="" /></div>
                    <div class="mb-actions">
                        <div class="option-action">
                            <a href="#" target="_blank" id="mb_link" class="button-primary"><?php _e('Live Demo','social_mb');?></a>
                            <input type="button" id="mb_save" name="submit_btn" class="button-primary" value="Save Settings">
                        </div>
                    </div>
                </div>
                <div class="mb-options-inner">
                    <div class="mb-nav-panel"><?php $this->mb_module_pagination(); ?></div>
                    <form id="mb-save-options" method="post">
                        <div class="mb-panel-contents"  style="display:block">
                            <?php $this->mb_module_contents(); ?>
                        </div>
                    </form>
                </div>
            </div>

            <?php
        }

        /**
         * @Module Pagination 
         */
        public function mb_module_pagination() {
            $obj = new MB_FormProcess();
            ?>
            <ul><?php $obj->form_process_mb_menu(); ?></ul>
            <?php
        }

        /**
         * @Module Contents 
         */
        public function mb_module_contents() {
            Mb_Modules_MailChimp::mb_prepare_settings();
            Mb_Modules_Twitter::mb_prepare_settings();
            Mb_Modules_Instagram::mb_prepare_settings();
            Mb_Modules_Flickr::mb_prepare_settings();
            Mb_Modules_Facebook::mb_prepare_settings();
        }

        /*
         * @get Mail chimp list
         *
         */

        public static function prepare_mailchimp_options() {
            global $mb_plugin_options;

            $mailchimp_list[]  = '';
            $mailchimp_list[0] = 'Select List';
            $api_key           = $mb_plugin_options['mb_mailchimp_key']; //Default Use :e12c8ee5546cf3134b83f02b8b12702e-us11;

            if (isset($api_key) && !empty($api_key)) {
                if ($api_key <> '') {
                    $lists = MB_Template_MailChimp::prepare_mailchimp_list($api_key);
                    if (is_array($lists) && isset($lists['data'])) {
                        foreach ($lists['data'] as $list) {
                            if (!empty($list['name'])) :
                                $mailchimp_list[$list['id']] = $list['name'];
                            endif;
                        }
                    }
                }
            }

            return $mailchimp_list;
        }

    }

    new Mb_Modules_Configuration();
}