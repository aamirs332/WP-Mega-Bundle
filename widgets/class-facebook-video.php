<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

if (!class_exists('MB_Facebook_Video')) {

    class MB_Facebook_Video extends WP_Widget {

        /**
         * @init Facebook 
         * $return {}
         */
        public function __construct() {
            $widget_ops  = array ('classname' => 'facebook_video' , 'description' => 'To Displays facebook video button.');
            $control_ops = array ('width' => 300 , 'height' => 250 , 'id_base' => 'facebook_video');
            parent::__construct('facebook_video' , __('MB Facebook video' , 'social_mb') , $widget_ops , $control_ops);
        }

        /**
         * @Facebook SharVideoe form
         *
         */
        public function form($instance) {
            $title         = isset($instance['title']) && !empty($instance['title']) ? $instance['title'] : __('Title' , 'social_mb');
            $fb_video_url  = isset($instance['fb_video_url']) && !empty($instance['fb_video_url']) ? $instance['fb_video_url'] : '';
            $fb_fullscreen = isset($instance['fb_fullscreen']) && !empty($instance['fb_fullscreen']) ? $instance['fb_fullscreen'] : '';
            $fb_width      = isset($instance['fb_video_url']) && !empty($instance['fb_width']) ? $instance['fb_width'] : '';
            $fb_autoplay   = isset($instance['fb_autoplay']) && !empty($instance['fb_autoplay']) ? $instance['fb_autoplay'] : '';
            ?>

            <p>
                <label for="title">
                    <?php _e('<strong>Title</strong>' , 'social_mb'); ?>
                </label>
                <input id="title" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fb_video_url'); ?>">
                    <?php _e('<strong>Facebook Video to URL</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('fb_video_url'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_video_url')); ?>" type="text" value="<?php echo esc_attr($fb_video_url); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fb_width'); ?>">
                    <?php _e('<strong>Facebook Page Width</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('fb_width'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_width')); ?>" type="number" value="<?php echo esc_attr($fb_width); ?>"/>
                <span><?php _e('Leave empty to auto width' , 'social_mb'); ?></span>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('fb_fullscreen'); ?>" <?php checked($fb_fullscreen , 'on'); ?> class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_fullscreen')); ?>" type="checkbox"/>
                <label for="<?php echo $this->get_field_id('fb_fullscreen'); ?>">
                    <?php _e('Allow Full Screen?' , 'social_mb'); ?>
                </label>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('fb_autoplay'); ?>" <?php checked($fb_autoplay , 'on'); ?> class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_autoplay')); ?>" type="checkbox"/>
                <label for="<?php echo $this->get_field_id('fb_autoplay'); ?>">
                    <?php _e('Autoplay?' , 'social_mb'); ?>
                </label>
            </p>
            <?php
        }

        /**
         * @Update Facebook Video
         *
         *
         */
        public function update($new_instance , $old_instance) {
            $instance                  = $old_instance;
            $instance['title']         = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
            $instance['fb_video_url']  = (!empty($new_instance['fb_video_url']) ) ? strip_tags($new_instance['fb_video_url']) : '';
            $instance['fb_width']      = (!empty($new_instance['fb_width']) ) ? strip_tags($new_instance['fb_width']) : '';
            $instance['fb_fullscreen'] = (!empty($new_instance['fb_fullscreen']) ) ? strip_tags($new_instance['fb_fullscreen']) : '';
            $instance['fb_autoplay']   = (!empty($new_instance['fb_autoplay']) ) ? strip_tags($new_instance['fb_autoplay']) : '';
            return $instance;
        }

        /**
         * @Display Facebook Video
         *
         *
         */
        public function widget($args , $instance) {
            extract($args);
            $title = $instance['title'];

            $atts                  = array ();
            $atts['fb_video_url']  = $instance['fb_video_url'];
            $atts['fb_width']      = $instance['fb_width'];
            $atts['fb_fullscreen'] = $instance['fb_fullscreen'];
            $atts['fb_autoplay']   = $instance['fb_autoplay'];

            echo '<div class="widget mb-widget">';
            if (!empty($title)) {
                echo force_balance_tags($args['before_title'] . apply_filters('widget_title' , esc_attr($title)) . $args['after_title']);
            }

            do_action('mb_prepare_facebook_video' , $atts);
            echo $args['after_widget'];
            echo '</div>';
        }

    }

    add_action('widgets_init' , create_function('' , 'return register_widget("MB_Facebook_Video");'));
}
?>