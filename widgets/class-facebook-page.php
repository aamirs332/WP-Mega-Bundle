<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

if (!class_exists('MB_Facebook_page')) {

    class MB_Facebook_page extends WP_Widget {

        /**
         * @init Facebook Page
         * $return {}
         */
        public function __construct() {
            $widget_ops  = array ('classname' => 'facebook_page' , 'description' => 'To Displays facebook page button.');
            $control_ops = array ('width' => 300 , 'height' => 250 , 'id_base' => 'facebook_page');
            parent::__construct('facebook_page' , __('MB Facebook page' , 'social_mb') , $widget_ops , $control_ops);
        }

        /**
         * @Facebook Page form
         *
         */
        public function form($instance) {
            $title                      = isset( $instance['title'] ) && !empty( $instance['title'] ) ? $instance['title'] : __('Title','social_mb');
            $fb_page_url                = isset( $instance['fb_page_url'] ) && !empty( $instance['fb_page_url'] ) ? $instance['fb_page_url'] : '';
            $fb_width                   = isset( $instance['fb_width'] ) && !empty( $instance['fb_width'] ) ? $instance['fb_width'] : '';
            $fb_height                  = isset( $instance['fb_height'] ) && !empty( $instance['fb_height'] ) ? $instance['fb_height'] : '';
            $show_posts                 = isset( $instance['show_posts'] ) && !empty( $instance['show_posts'] ) ? $instance['show_posts'] : '';
            $fb_small_header            = isset( $instance['fb_small_header'] ) && !empty( $instance['fb_small_header'] ) ? $instance['fb_small_header'] : '';
            $fb_hide_cover_photo        = isset( $instance['fb_hide_cover_photo'] ) && !empty( $instance['fb_hide_cover_photo'] ) ? $instance['fb_hide_cover_photo'] : '';
            $fb_show_friends_faces      = isset( $instance['fb_show_friends_faces'] ) && !empty( $instance['fb_show_friends_faces'] ) ? $instance['fb_show_friends_faces'] : '';
            ?>

            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">
                    <?php _e('<strong>Title</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fb_page_url'); ?>">
                    <?php _e('<strong>Facebook Page URL</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('fb_page_url'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_page_url')); ?>" type="text" value="<?php echo esc_attr($fb_page_url); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fb_width'); ?>">
                    <?php _e('<strong>Facebook Page Width</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('fb_width'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_width')); ?>" type="number" value="<?php echo esc_attr($fb_width); ?>"/>
                <span><?php _e('Leave empty to auto width','social_mb');?></span>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fb_height'); ?>">
                    <?php _e('<strong>Facebook Page Height</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('fb_height'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_height')); ?>" type="number" value="<?php echo esc_attr($fb_height); ?>"/>
                 <span><?php _e('Leave empty to auto height','social_mb');?></span>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fb_page_url'); ?>">
                    <?php _e('<strong>Facebook Page URL</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('fb_page_url'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_page_url')); ?>" type="text" value="<?php echo esc_attr($fb_page_url); ?>"/>
            </p>
            <p>
        	<label for="<?php echo $this->get_field_id('fb_small_header'); ?>"> 
                    <?php _e('Small Header on/off:', 'social_mb') ?>
                </label>
            	<select id="<?php echo $this->get_field_id('fb_small_header'); ?>" name="<?php echo $this->get_field_name('fb_small_header'); ?>">
                    <option value="no" <?php echo isset($fb_small_header) && $fb_small_header == 'no' ? 'selected': '';?>><?php _e('No', 'social_mb') ?></option>
                    <option value="yes" <?php echo isset($fb_small_header) && $fb_small_header == 'yes' ? 'selected': '';?>><?php _e('Yes', 'social_mb') ?></option>
                 </select>
               <span><?php _e('Uses a smaller version of the page header','social_mb');?></span>
            </p>
            <p>
        	<label for="<?php echo $this->get_field_id('fb_hide_cover_photo'); ?>"> 
                    <?php _e('Hide Cover Photo:', 'social_mb') ?>
                </label>
            	<select id="<?php echo $this->get_field_id('fb_hide_cover_photo'); ?>" name="<?php echo $this->get_field_name('fb_hide_cover_photo'); ?>">
                    <option value="no" <?php echo isset($fb_hide_cover_photo) && $fb_hide_cover_photo == 'no' ? 'selected': '';?>><?php _e('No', 'social_mb') ?></option>
                    <option value="yes" <?php echo isset($fb_hide_cover_photo) && $fb_hide_cover_photo == 'yes' ? 'selected': '';?>><?php _e('Yes', 'social_mb') ?></option>
                 </select>
               <span><?php _e('Uses a smaller version of the page header','social_mb');?></span>
            </p>
           <p>
        	<label for="<?php echo $this->get_field_id('show_posts'); ?>"> 
                    <?php _e('Show Page Posts', 'social_mb') ?>
                </label>
            	<select id="<?php echo $this->get_field_id('show_posts'); ?>" name="<?php echo $this->get_field_name('show_posts'); ?>">
                    <option value="no" <?php echo isset($show_posts) && $show_posts == 'no' ? 'selected': '';?>><?php _e('No', 'social_mb') ?></option>
                    <option value="yes" <?php echo isset($show_posts) && $show_posts == 'yes' ? 'selected': '';?>><?php _e('Yes', 'social_mb') ?></option>
                 </select>
               <span><?php _e('Show posts from the Pages timeline','social_mb');?></span>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('fb_show_friends_faces'); ?>" <?php checked($fb_show_friends_faces, 'on'); ?> class="widefat" name="<?php echo esc_attr($this->get_field_name('fb_show_friends_faces')); ?>" type="checkbox"/>
                <label for="<?php echo $this->get_field_id('fb_show_friends_faces'); ?>">
                    <?php _e('Show Friends Faces?' , 'social_mb'); ?>
                </label>
            </p>
            <?php
        }

        /**
         * @Update Facebook Page
         *
         *
         */
        public function update($new_instance , $old_instance) {
            $instance          = $old_instance;
            
            $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
            $instance['fb_page_url'] = (!empty($new_instance['fb_page_url']) ) ? strip_tags($new_instance['fb_page_url']) : '';
            $instance['fb_width']    = (!empty($new_instance['fb_width']) ) ? strip_tags($new_instance['fb_width']) : '';
            $instance['fb_height']   = (!empty($new_instance['fb_height']) ) ? strip_tags($new_instance['fb_height']) : '';
            $instance['show_posts']  = (!empty($new_instance['show_posts']) ) ? strip_tags($new_instance['show_posts']) : '';
            $instance['fb_show_friends_faces'] = (!empty($new_instance['fb_show_friends_faces']) ) ? strip_tags($new_instance['fb_show_friends_faces']) : '';
            $instance['fb_small_header'] = (!empty($new_instance['fb_small_header']) ) ? strip_tags($new_instance['fb_small_header']) : '';
            $instance['fb_hide_cover_photo'] = (!empty($new_instance['fb_hide_cover_photo']) ) ? strip_tags($new_instance['fb_hide_cover_photo']) : '';
            
            return $instance;
        }

        /**
         * @Display Facebook Page
         *
         *
         */
        public function widget($args , $instance) {
            extract($args);
            $title = $instance['title'];

            $atts                           = array();
            $atts['fb_page_url']            = $instance['fb_page_url'];
            $atts['fb_width']               = $instance['fb_width'];
            $atts['fb_height']              = $instance['fb_height'];
            $atts['show_posts']             = $instance['show_posts'];
            $atts['fb_show_friends_faces']  = $instance['fb_show_friends_faces'];
            $atts['fb_small_header']        = $instance['fb_small_header'];
            $atts['fb_hide_cover_photo']    = $instance['fb_hide_cover_photo'];
            
            echo '<div class="widget mb-widget">';
            if (!empty($title)) {
                echo force_balance_tags($args['before_title'] . apply_filters('widget_title' , esc_attr($title)) . $args['after_title']);
            }
            
            do_action('mb_prepare_facebook_page',$atts);
            echo $args['after_widget'];
            echo '</div>';
        }

    }

    add_action('widgets_init' , create_function('' , 'return register_widget("MB_Facebook_page");'));
}
?>