<?php

if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * @init Instagram Template
 * $return {}
 */
if (!class_exists('MB_Template_Instagram')) {

    class MB_Template_Instagram extends MB_System_Helper {

        public static $counter;

        /**
         * @init Instagram
         * $return {}
         */
        public function __construct() {
            global $mb_plugin_options;
            $mb_plugin_options = get_option('mb_plugin_options');
            add_action('mb_prepare_instagram' , array (&$this , 'mb_render_instagram_html') , 5);
        }

        /**
         * @return Instagram HTML
         */
        public function mb_render_instagram_html( $args = array() ) {
            global $mb_plugin_options;
            $flag = $this->mb_get_uniqueue_flag(5);

            $accessToken = $mb_plugin_options['mb_instagram_access_token'];

            $user_id        = $args['user_id'];
            $no_of_photos   = $args['no_of_photos'];
            $mb_flickr_view = $args['view'];
            $fetch = wp_remote_get("https://api.instagram.com/v1/users/{$user_id}/media/recent/?access_token={$accessToken}");
            
            $response   = wp_remote_retrieve_body( $fetch );
            $response   = json_decode($response);
            
            if (is_wp_error($response)) {
                $error_message = $fetch->get_error_message();
                echo esc_attr("Something went wrong: $error_message");
            } else {  ?>
                <ul class="instagram-gallery">
                    <?php
                        if (!empty($response->data)) {
                            foreach ($response->data as $post) {
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($post->images->standard_resolution->url); ?>" data-rel="prettyPhoto[gallery1]">
                                        <img src="<?php echo esc_url($post->images->thumbnail->url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                        <div class="img-hover">
                                            <div class="holder">
                                                <span>+</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php
                            }//endif
                        } else {
                            _e('Opps! Some error occur, please try again later. ' , 'social_mb');
                        }
                    ?>
                </ul>
            <?php }
        }
    }

    new MB_Template_Instagram();
}
