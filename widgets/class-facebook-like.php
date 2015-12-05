<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

if (!class_exists('MB_Facebook_like')) {

    class MB_Facebook_like extends WP_Widget {

        /**
         * @init Facebook Like
         * $return {}
         */
        public function __construct() {
            $widget_ops  = array ('classname' => 'facebook_like' , 'description' => 'To Displays facebook like button.');
            $control_ops = array ('width' => 300 , 'height' => 250 , 'id_base' => 'facebook_like');
            parent::__construct('facebook_like' , __('MB Facebook like' , 'social_mb') , $widget_ops , $control_ops);
        }

        /**
         * @Facebook Like form
         *
         */
        public function form($instance) {
            $title                      = isset( $instance['title'] ) && !empty( $instance['title'] ) ? $instance['title'] : __('Title','social_mb');
            $url_to_like                = isset( $instance['url_to_like'] ) && !empty( $instance['url_to_like'] ) ? $instance['url_to_like'] : '';
            $mb_fb_like_layout          = isset( $instance['mb_fb_like_layout'] ) && !empty( $instance['mb_fb_like_layout'] ) ? $instance['mb_fb_like_layout'] : '';
            $fb_like_width              = isset( $instance['fb_like_width'] ) && !empty( $instance['fb_like_width'] ) ? $instance['fb_like_width'] : '';
            $fb_show_like_friends_faces = isset( $instance['fb_show_like_friends_faces'] ) && !empty( $instance['fb_show_like_friends_faces'] ) ? $instance['fb_show_like_friends_faces'] : '';
            $mb_fb_include_button       = isset( $instance['mb_fb_include_button'] ) && !empty( $instance['mb_fb_include_button'] ) ? $instance['mb_fb_include_button'] : '';
            ?>

            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">
                    <?php _e('<strong>Title</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('url_to_like'); ?>">
                    <?php _e('<strong>Facebook Like Page URL</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('url_to_like'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('url_to_like')); ?>" type="text" value="<?php echo esc_attr($url_to_like); ?>"/>
                <span><?php _e('For example https://www.facebook.com/facebook','social_mb');?></span>
            </p>
           <p>
        	<label for="<?php echo $this->get_field_id('mb_fb_like_layout'); ?>"> 
                    <?php _e('<strong>Select Layout:</strong>', 'social_mb') ?>
                </label>
            	<select id="<?php echo $this->get_field_id('mb_fb_like_layout'); ?>" name="<?php echo $this->get_field_name('mb_fb_like_layout'); ?>">
                    <option value="standard" <?php echo isset($mb_fb_like_layout) && $mb_fb_like_layout == 'standard' ? 'selected': '';?>><?php _e('Standrad', 'social_mb') ?></option>
                    <option value="button_count" <?php echo isset($mb_fb_like_layout) && $mb_fb_like_layout == 'button_count' ? 'selected': '';?>><?php _e('Button Count', 'social_mb') ?></option>
                    <option value="box_count" <?php echo isset($mb_fb_like_layout) && $mb_fb_like_layout == 'box_count' ? 'selected': '';?>><?php _e('Box Count', 'social_mb') ?></option>
                    <option value="button" <?php echo isset($mb_fb_like_layout) && $mb_fb_like_layout == 'button' ? 'selected': '';?>><?php _e('Button', 'social_mb') ?></option>
                </select>
            </p>
           
            <p>
                <label for="<?php echo $this->get_field_id('fb_like_width'); ?>">
                    <?php _e('<strong>Facebook Like Page Width</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('fb_like_width'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_like_width')); ?>" type="number" value="<?php echo esc_attr($fb_like_width); ?>"/>
                <span><?php _e('The pixel width of the embed (Min. 180 to Max. 500)','social_mb');?></span>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('fb_show_like_friends_faces'); ?>" <?php checked($fb_show_like_friends_faces, 'on'); ?> class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_show_like_friends_faces')); ?>" type="checkbox" />
                <label for="<?php echo $this->get_field_id('fb_show_like_friends_faces'); ?>">
                    <?php _e('Show Friends Faces?' , 'social_mb'); ?>
                </label>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('mb_fb_include_button'); ?>" <?php checked($mb_fb_include_button, 'on'); ?> class="widefat" name="<?php echo esc_attr($this->get_field_name('mb_fb_include_button')); ?>" type="checkbox"/>
                <label for="<?php echo $this->get_field_id('mb_fb_include_button'); ?>">
                    <?php _e('Include Button?' , 'social_mb'); ?>
                </label>
            </p>
            <?php
        }

        /**
         * @Update Facebook Like
         *
         *
         */
        public function update($new_instance , $old_instance) {
            $instance          = $old_instance;
            $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
            $instance['url_to_like'] = (!empty($new_instance['url_to_like']) ) ? strip_tags($new_instance['url_to_like']) : '';
            $instance['mb_fb_like_layout'] = (!empty($new_instance['mb_fb_like_layout']) ) ? strip_tags($new_instance['mb_fb_like_layout']) : '';
            $instance['fb_like_width'] = (!empty($new_instance['fb_like_width']) ) ? strip_tags($new_instance['fb_like_width']) : '';
            $instance['fb_show_like_friends_faces'] = (!empty($new_instance['fb_show_like_friends_faces']) ) ? strip_tags($new_instance['fb_show_like_friends_faces']) : '';
            $instance['mb_fb_include_button'] = (!empty($new_instance['mb_fb_include_button']) ) ? strip_tags($new_instance['mb_fb_include_button']) : '';
            
            return $instance;
        }

        /**
         * @Display Facebook Like
         *
         *
         */
        public function widget($args , $instance) {
            extract($args);
            $title = $instance['title'];
            
            $atts                  = array();
            $atts['url_to_like']      = $instance['url_to_like'];
            $atts['mb_fb_like_layout']      = $instance['mb_fb_like_layout'];
            $atts['fb_like_width']          = $instance['fb_like_width'];
            $atts['fb_show_friends_faces']  = $instance['fb_show_like_friends_faces'];
            $atts['mb_fb_include_button']   = $instance['mb_fb_include_button'];
            
            echo '<div class="widget mb-widget">';
            if (!empty($title)) {
                echo force_balance_tags($args['before_title'] . apply_filters('widget_title' , esc_attr($title)) . $args['after_title']);
            }
            
            do_action('mb_prepare_facebook_like',$atts);
            echo $args['after_widget'];
            echo '</div>';
        }

    }

    add_action('widgets_init' , create_function('' , 'return register_widget("MB_Facebook_like");'));
}
?>