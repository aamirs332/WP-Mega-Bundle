<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * @init Mailchimp Template
 * $return {}
 */
if (!class_exists('MB_Template_MailChimp')) {

    class MB_Template_MailChimp extends MB_System_Helper {

        public static $flag = 0;

        /**
         * @init Mailchimp
         * $return {}
         */
        public function __construct() {
            global $mb_plugin_options;
            
            $mb_plugin_options = get_option('mb_plugin_options');
            add_action('mb_prepare_mailchimp' , array (&$this , 'mb_render_mailchimp_html') , 5);
            add_action('wp_ajax_nopriv_mb_mailchimp_form' , array (&$this , 'mb_mailchimp_form'));
            add_action('wp_ajax_mb_mailchimp_form' , array (&$this , 'mb_mailchimp_form'));
            add_action('wp_ajax_nopriv_subscribe_mailchimp' , array (&$this , 'mb_subscribe_mailchimp'));
            add_action('wp_ajax_subscribe_mailchimp' , array (&$this , 'mb_subscribe_mailchimp'));
            add_action('wp_head' , array (&$this , 'mb_init_mailchimp_script'));
        }

        /**
         * @return Mailchimp HTML
         */
        public function mb_render_mailchimp_html($args = array ()) {
            global $mb_plugin_options,$success;
            $flag = $this->mb_get_uniqueue_flag(5);

            $fname   = $args['firstname'];
            $lname   = $args['lastname'];
            $success = $args['success'];
            $error   = $args['error'];

            if (isset($mb_plugin_options['mb_mailchimp_key']) && trim($mb_plugin_options['mb_mailchimp_key']) != '') {
                ?>
                <div class="mb-widget-wrap">
                    <form class="newsletter-form mb-form" id="mailchimpwidget_<?php echo esc_attr($flag); ?>">
                        <fieldset>
                            <div id="newsletter_message_<?php echo esc_attr($flag); ?>" data-mb_success="<?php echo esc_attr( $success );?>" data-mb_error="<?php echo esc_attr( $error );?>" style="display:none" class="mb_message_div"><div class="mailchimp-message"></div></div>
                            <?php if (isset($fname) && $fname === 'on') { ?>
                                <div class="mb-form-group">
                                    <input type="text" id="mb_fname" placeholder="First Name" required>
                                </div>
                            <?php } ?>
                            <?php if (isset($lname) && $lname === 'on') { ?>
                                <div class="mb-form-group">
                                    <input type="text" id="mb_lname" placeholder="Last Name" required>
                                </div>
                            <?php } ?>

                            <div class="mb-form-group">
                                <input type="email" id="mb_email" placeholder="Your Email ID" required>
                            </div>
                            <div class="mb-form-group pull-left">
                                <button type="button"  data-counter="<?php echo esc_attr($flag); ?>" class="theme-btn subscribe_me"><?php _e('Subscribe' , 'social_mb'); ?></button>
                            </div>
                            <div id="newsletter_<?php echo esc_attr($flag); ?>" class="mb-spinner"></div> 
                        </fieldset>
                    </form>
                </div>
                <?php
            } else {
                _e('Please set API Key First.' , 'social_mb');
            }
        }

        /**
         * @get Mail chimp list
         *
         */
        public static function prepare_mailchimp_list($apikey) {
            $MailChimp      = new MailChimp($apikey);
            $mailchimp_list = $MailChimp->call('lists/list');
            return $mailchimp_list;
        }

        /**
         * @get Mail chimp list
         *
         */
        public function mb_subscribe_mailchimp() {
            global $flag , $mb_plugin_options;

            $mailchimp_key = '';
            $json          = array ();

            $mailchimp_key        = $mb_plugin_options['mb_mailchimp_key'];
            $mailchimp_key        = $mb_plugin_options['mb_mailchimp_key'];
            $list                 = $mb_plugin_options['mb_mailchimp_list'];
            $mb_mailchimp_success = isset($_POST['success']) && !empty($_POST['success']) && !empty($_POST['success']) === 'undefined' ? $_POST['success'] : __('Subscribed Successfully' , 'social_mb');
            $mb_mailchimp_error   = isset($_POST['error']) && !empty($_POST['error']) && !empty($_POST['error']) === 'undefined'  ? $_POST['error'] : __('some error occur,please try again later.' , 'social_mb');


            if (isset($_POST) and ! empty($list) and $mailchimp_key != '') {
                if ($mailchimp_key <> '') {
                    $MailChimp = new MailChimp($mailchimp_key);
                }

                $email   = $_POST['email'];
                $list_id = $list;
                
                
                if (isset($_POST['fname']) && !empty($_POST['fname'])) {
                    $fname = $_POST['fname'];
                } else {
                    $fname = '';
                }

                if (isset($_POST['lname']) && !empty($_POST['lname'])) {
                    $lname = $_POST['lname'];
                } else {
                    $lname = '';
                }

                //https://apidocs.mailchimp.com/api/1.3/listsubscribe.func.php
                $result = $MailChimp->call('lists/subscribe' , array (
                                         'id'                => $list_id ,
                                         'email'             => array ('email' => $email) ,
                                         'merge_vars'        => array ('FNAME' => $fname , 'LNAME' => $lname) ,
                                         'double_optin'      => false ,
                                         'update_existing'   => false ,
                                         'replace_interests' => false ,
                                         'send_welcome'      => true ,
                ));

                if ($result <> '') {
                    if (isset($result['status']) and $result['status'] == 'error') {
                        $json['type']    = 'error';
                        $json['message'] = $result['error'];
                    } else {
                        $json['type'] = 'success';
                        if (isset($mb_mailchimp_success) && $mb_mailchimp_success != '') {
                            $json['message'] = $mb_mailchimp_success;
                        } else {
                            $json['message'] = __('Subscribed Successfully' , 'social_mb');
                        }
                    }
                }
            } else {
                $json['type'] = 'error';
                if (isset($mb_mailchimp_error) && $mb_mailchimp_error != '') {
                    $json['message'] = $mb_mailchimp_success;
                } else {
                    $json['message'] = __('some error occur,please try again later.' , 'social_mb');
                }
            }
            echo json_encode($json);
            die();
        }

        /**
         * @init mailchimp script
         */
        public function mb_init_mailchimp_script() {
            ?>
            <script>
                jQuery(document).ready(function(e) {
                    jQuery(document).on('click', '.subscribe_me', function(event) {
                        'use strict';
                        event.preventDefault();
                        $ = jQuery;
                        var fname = jQuery(this).parents('form').find('#mb_fname').val();
                        var lname = jQuery(this).parents('form').find('#mb_lname').val();
                        var email = jQuery(this).parents('form').find('#mb_email').val();
                        var list_id = jQuery(this).parents('form').find('#list_id').val();
                        var counter = jQuery(this).data('counter');
                        var success = jQuery(this).parents('.mb-form').find('.mb_message_div').data('mb_success');
                        var error   = jQuery(this).parent('.mb-form').find('.mb_message_div').data('mb_error');
                        //alert(counter);
                        jQuery('#newsletter_message_' + counter + " .mailchimp-message").html('');
                        jQuery('#newsletter_' + counter).html('<i class="flaticon-spinner2"></i>');
                        jQuery.ajax({
                            type: 'POST',
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            data: 'success=' + success + '&error=' + error + '&fname=' + fname + '&lname=' + lname + '&email=' + email + '&list_id=' + list_id + '&action=subscribe_mailchimp',
                            dataType: "json",
                            success: function(response) {
                                if (response.type == 'suucess') {
                                    jQuery('#mailchimpwidget_' + counter).get(0).reset();
                                    jQuery('#newsletter_message_' + counter).fadeIn(600);
                                    jQuery('#newsletter_message_' + counter + " .mailchimp-message").html(response.message);
                                    jQuery('#newsletter_' + counter).html('');
                                } else {
                                    jQuery('#newsletter_message_' + counter).fadeIn(600);
                                    jQuery('#newsletter_message_' + counter + " .mailchimp-message").html(response.message);
                                    jQuery('#newsletter_' + counter).html('');
                                }

                            }
                        });
                    });
                });

            </script>
            <?php
        }

    }

    new MB_Template_MailChimp();
}
