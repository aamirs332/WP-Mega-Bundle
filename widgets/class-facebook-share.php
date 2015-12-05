<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

if (!class_exists('MB_Facebook_share')) {

    class MB_Facebook_share extends WP_Widget {

        /**
         * @init Facebook Share
         * $return {}
         */
        public function __construct() {
            $widget_ops  = array ('classname' => 'facebook_share' , 'description' => 'To Displays facebook share button.');
            $control_ops = array ('width' => 300 , 'height' => 250 , 'id_base' => 'facebook_share');
            parent::__construct('facebook_share' , __('MB Facebook share' , 'social_mb') , $widget_ops , $control_ops);
        }

        /**
         * @Facebook Share form
         *
         */
        public function form($instance) {
            $title                = isset( $instance['title'] ) && !empty( $instance['title'] ) ? $instance['title'] : __('Title','social_mb');
            $fb_share_button_url  = isset( $instance['fb_share_button_url'] ) && !empty( $instance['fb_share_button_url'] ) ? $instance['fb_share_button_url'] : '';
            $mb_fb_share_layout   = isset( $instance['mb_fb_share_layout'] ) && !empty( $instance['mb_fb_share_layout'] ) ? $instance['mb_fb_share_layout'] : '';
            ?>

            <p>
                <label for="title">
                    <?php _e('<strong>Title</strong>' , 'social_mb'); ?>
                </label>
                <input id="title" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fb_share_button_url'); ?>">
                    <?php _e('<strong>Facebook Page URL</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('fb_share_button_url'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_share_button_url')); ?>" type="text" value="<?php echo esc_attr($fb_share_button_url); ?>"/>
            </p>
            <p>
        	<label for="<?php echo $this->get_field_id('mb_fb_share_layout'); ?>"> 
                    <?php _e('Facebook Like Button layout:', 'social_mb') ?>
                </label>
            	<select id="<?php echo $this->get_field_id('mb_fb_share_layout'); ?>" name="<?php echo $this->get_field_name('mb_fb_share_layout'); ?>">
                    <option value="button_count" <?php echo isset($mb_fb_share_layout) && $mb_fb_share_layout == 'button_count' ? 'selected': '';?>><?php _e('Button Count', 'social_mb') ?></option>
                    <option value="box_count" <?php echo isset($mb_fb_share_layout) && $mb_fb_share_layout == 'box_count' ? 'selected': '';?>><?php _e('Box Count', 'social_mb') ?></option>
                    <option value="button" <?php echo isset($mb_fb_share_layout) && $mb_fb_share_layout == 'button' ? 'selected': '';?>><?php _e('Button', 'social_mb') ?></option>
                    <option value="icon_link" <?php echo isset($mb_fb_share_layout) && $mb_fb_share_layout == 'icon_link' ? 'selected': '';?>><?php _e('Icon Link', 'social_mb') ?></option>
                    <option value="icon" <?php echo isset($mb_fb_share_layout) && $mb_fb_share_layout == 'icon' ? 'selected': '';?>><?php _e('Icon', 'social_mb') ?></option>
                    <option value="link" <?php echo isset($mb_fb_share_layout) && $mb_fb_share_layout == 'link' ? 'selected': '';?>><?php _e('Link', 'social_mb') ?></option>
                 </select>
            </p>
            <?php
        }

        /**
         * @Update Facebook Share
         *
         *
         */
        public function update($new_instance , $old_instance) {
            $instance          = $old_instance;
            $instance['title']               = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
            $instance['fb_share_button_url'] = (!empty($new_instance['fb_share_button_url']) ) ? strip_tags($new_instance['fb_share_button_url']) : '';
            $instance['mb_fb_share_layout']  = (!empty($new_instance['mb_fb_share_layout']) ) ? strip_tags($new_instance['mb_fb_share_layout']) : '';
            return $instance;
        }

        /**
         * @Display Facebook Share
         *
         *
         */
        public function widget($args , $instance) {
            extract($args);
            $title = $instance['title'];
            
            $atts                           = array();
            $atts['fb_share_button_url']    = $instance['fb_share_button_url'];
            $atts['mb_fb_share_layout']     = $instance['mb_fb_share_layout'];
            
            echo '<div class="widget mb-widget">';
            if (!empty($title)) {
                echo force_balance_tags($args['before_title'] . apply_filters('widget_title' , esc_attr($title)) . $args['after_title']);
            }
            
            do_action('mb_prepare_facebook_share',$atts);
            echo $args['after_widget'];
            echo '</div>';
        }

    }

    add_action('widgets_init' , create_function('' , 'return register_widget("MB_Facebook_share");'));
}
?>