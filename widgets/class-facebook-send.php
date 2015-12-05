<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

if (!class_exists('MB_Facebook_Send')) {

    class MB_Facebook_Send extends WP_Widget {

        /**
         * @init Facebook 
         * $return {}
         */
        public function __construct() {
            $widget_ops  = array ('classname' => 'facebook_send' , 'description' => 'To Displays facebook send button.');
            $control_ops = array ('width' => 300 , 'height' => 250 , 'id_base' => 'facebook_send');
            parent::__construct('facebook_send' , __('MB Facebook send' , 'social_mb') , $widget_ops , $control_ops);
        }

        /**
         * @Facebook SharSende form
         *
         */
        public function form($instance) {
            $title                = isset( $instance['title'] ) && !empty( $instance['title'] ) ? $instance['title'] : __('Title','social_mb');
            $fb_send_to_url  = isset( $instance['fb_send_to_url'] ) && !empty( $instance['fb_send_to_url'] ) ? $instance['fb_send_to_url'] : '';
            ?>

            <p>
                <label for="title">
                    <?php _e('<strong>Title</strong>' , 'social_mb'); ?>
                </label>
                <input id="title" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fb_send_to_url'); ?>">
                    <?php _e('<strong>Facebook Send to URL</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('fb_send_to_url'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_send_to_url')); ?>" type="text" value="<?php echo esc_attr($fb_send_to_url); ?>"/>
            </p>
            <?php
        }

        /**
         * @Update Facebook Send
         *
         *
         */
        public function update($new_instance , $old_instance) {
            $instance          = $old_instance;
            $instance['title']               = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
            $instance['fb_send_to_url'] = (!empty($new_instance['fb_send_to_url']) ) ? strip_tags($new_instance['fb_send_to_url']) : '';
            return $instance;
        }

        /**
         * @Display Facebook Send
         *
         *
         */
        public function widget($args , $instance) {
            extract($args);
            $title = $instance['title'];
            
            $atts                      = array();
            $atts['fb_send_to_url']    = $instance['fb_send_to_url'];
            echo '<div class="widget mb-widget">';
            if (!empty($title)) {
                echo force_balance_tags($args['before_title'] . apply_filters('widget_title' , esc_attr($title)) . $args['after_title']);
            }
            
            do_action('mb_prepare_facebook_send',$atts);
            echo $args['after_widget'];
            echo '</div>';
        }

    }

    add_action('widgets_init' , create_function('' , 'return register_widget("MB_Facebook_Send");'));
}
?>