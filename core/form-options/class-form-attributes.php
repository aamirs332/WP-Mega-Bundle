<?php defined('ABSPATH') or die('No script kiddies please!');
/**
 * @Class		Process Form Elements
 * @package	 	WordPress
 * @subpackage  Z-Theme
 * @link 		http://www.zaraar.com
 * @Author 		Zaraar
 * @copyright   Copyright (c) 2015, Zraar.com 
 */

if (!class_exists('MB_FormProcess')) {

    class MB_FormProcess {

        public function __construct() {
            global $mb_plugin_options;
            $mb_plugin_options  = get_option('mb_plugin_options');
        }

        /* ------------------------------------------------
         * Process Left Menu
         * ----------------------------------------------- */

        public function do_process_menu($name = '', $id = '', $icon = '', $open = '') {
            global $mb_plugin_options;
            $mb_is_open = $open == true ? 'class=open' : '';
            $mb_menu_icon = !empty($icon) ? $icon : 'flaticon-2440';
            $output  = '<li>';
            $output .= '<a href="javascript:;" ' . $mb_is_open . ' data-id="mb-'.esc_attr($id).'-wrapper" id="mb-open-menu"><i class="' . esc_attr($mb_menu_icon) . '"></i><strong>' . $name . '</strong></a>';
            $output .= '</li>';
            echo $output;
        }
        
        /* ------------------------------------------------
         * Process Form Label
         * ----------------------------------------------- */
        public function form_process_heading( $id ='id-wrap' , $name='' ){
              return '<h3 id="' . $id . '_heading">'.$name.'</h3>';
        }
        
        /* ------------------------------------------------
         * Process Form Wrapper Start
         * ----------------------------------------------- */
        public function form_process_wrapper_start( $atts = array() ){
             global $mb_plugin_options;
             extract($atts);
             
             echo '<div id="'.$id.'-wrapper" class="'.$class.'-wrapper" style="display:'.$display.'">';
        }
        
        /* ------------------------------------------------
         * Process Form Tab
         * ----------------------------------------------- */
        public function form_process_tab( $atts = array() ){
             global $mb_plugin_options;
             extract($atts);
             
             echo '<div id="'.$id.'" class="mb-heading-tab '.$class.'">'.$name.'</div>';
        }
        
        /* ------------------------------------------------
         * Process Form Wrapper End
         * ----------------------------------------------- */
        public function form_process_wrapper_end(){
              echo '</div>';
        }
        
        /* ------------------------------------------------
         * Process Note HTML
         * ----------------------------------------------- */
        public function form_process_note($atts=  array ()){
            global $mb_plugin_options;
            extract($atts);
            
            $output  = '';
            if ($desc) {
                $output .= '<div class="mb-notes">';
                $output .= '<p>' . $desc . '</p>';
                $output .= '</div>';
            }
            
            echo force_balance_tags ( $output );
        }
        
        /* ------------------------------------------------
         * Process Form Description
         * ----------------------------------------------- */
        public function form_process_description( $desc='' ){
            $output  = '';
            if ($desc) {
                $output .= '<div class="mb_desc">';
                $output .= '<p>' . $desc . '</p>';
                $output .= '</div>';
            }
            return $output;
        }

        /* ------------------------------------------------
         * Process Form Input type text
         * ----------------------------------------------- */

        public function form_process_text($atts = '') {
            global $mb_plugin_options;
            extract($atts);

            $val          = '';

            if (isset($mb_plugin_options)) {
                
                if (isset($mb_plugin_options[$id])) {
                    $val = $mb_plugin_options[$id];
                }else{
                    $val = $std;
                }
            } else {
                $val = $std;
            }

            $output = '';
            $output .= '<div class="mb_option_wraper">';
            $output .= $this->form_process_heading( $id , $name );
            $output .= $this->form_process_description( $desc );
            $output .= '<div class="mb_field">';
            $output .= '<input type="text" id="' . $id . '" name="' . $id . '" value="' . esc_attr($val) . '" />';
            $output .= '</div>';
            $output .= '</div>';
            echo $output;
        }
        /* ------------------------------------------------
         * Process Form Input type text
         * ----------------------------------------------- */

        public function form_process_number($atts = '') {
            global $mb_plugin_options;
            extract($atts);

            $val          = '';

            if (isset($mb_plugin_options)) {
                
                if (isset($mb_plugin_options[$id])) {
                    $val = $mb_plugin_options[$id];
                }else{
                    $val = $std;
                }
            } else {
                $val = $std;
            }

            $output = '';
            $output .= '<div class="mb_option_wraper">';
            $output .= $this->form_process_heading( $id , $name );
            $output .= $this->form_process_description( $desc );
            $output .= '<div class="mb_field">';
            $output .= '<input type="number" min="'.$min.'" max="'.$max.'" id="' . $id . '" name="' . $id . '" value="' . esc_attr($val) . '" />';
            $output .= '</div>';
            $output .= '</div>';
            echo $output;
        }

        /* ------------------------------------------------
         * Process Form Input type text
         * ----------------------------------------------- */

        public function form_process_select($atts = '') {
            global $mb_plugin_options;
            extract($atts);

            $val          = '';

            if (isset($mb_plugin_options)) {
                
                if (isset($mb_plugin_options[$id])) {
                    $val = $mb_plugin_options[$id];
                }else{
                    $val = $std;
                }
            } else {
                $val = $std;
            }

            $output = '';
            $output .= '<div class="mb_option_wraper">';
            $output .= $this->form_process_heading( $id , $name );
            $output .= $this->form_process_description( $desc );
            $output .= '<div class="mb_field dropdown-style">';
            $output .= '<select id="' . $id . '" name="' . $id . '">';
            foreach ($options as $key => $option) {
                if ($val == $key) {
                    $selected = 'selected="selected"';
                } else {
                    $selected = '';
                }

                $output .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
            }
            $output .= '</select>';
            $output .= '</div>';
            $output .= '</div>';
            echo $output;
        }

        /* ------------------------------------------------
         * Process Form Input type textarea
         * ----------------------------------------------- */

        public function form_process_textarea($atts = '') {
            global $mb_plugin_options;
            extract($atts);

            $val          = '';

            if (isset($mb_plugin_options)) {
                
                if (isset($mb_plugin_options[$id])) {
                    $val = $mb_plugin_options[$id];
                }else{
                    $val = $std;
                }
            } else {
                $val = $std;
            }
	    
            $settings = array( 'media_buttons' => false );
            $output = '';
            $output .= '<div class="mb_option_wraper">';
            $output .= $this->form_process_heading( $id , $name );
            $output .= $this->form_process_description( $desc );
            $output .= '<div class="mb_field">';
            //$output .= wp_editor( $val, 'mb_'.$id ,$settings );
			$output .= '<textarea cols="125" rows="8" id="' . $id . '" name="' . $id . '">' . $val . '</textarea>';
            $output .= '</div>';
            $output .= '</div>';
            echo $output;
        }

        /* ------------------------------------------------
         * Process Form Input type hidden
         * ----------------------------------------------- */

        public function form_process_hidden($id = '', $val = '', $echo = true) {
            global $mb_plugin_options;
            if (isset($echo) && $echo == true) {
                echo '<input type="hidden" id="' . $id . '" name="' . $id . '" value="' . esc_attr($val) . '" />';
            } else {
                return '<input type="hidden" id="' . $id . '" name="' . $id . '" value="' . esc_attr($val) . '" />';
            }
        }

        /* ------------------------------------------------
         * Process Form Input type Submit
         * ----------------------------------------------- */

        public function form_process_submit($atts = '') {
            global $mb_plugin_options;
        }

        /* ------------------------------------------------
         * Process Form Input type Button
         * ----------------------------------------------- */

        public function form_process_button($atts = '') {
            global $mb_plugin_options;
        }

        /* ------------------------------------------------
         * Process Form Input type Date
         * ----------------------------------------------- */

        public function form_process_date($atts = '') {
            global $mb_plugin_options;
        }

        /* ------------------------------------------------
         * Process Form Input type Range Slider
         * ----------------------------------------------- */

        public function form_process_range($atts = '') {
            global $mb_plugin_options;
        }

        /* ------------------------------------------------
         * Process Form Input type Checkbox
         * ----------------------------------------------- */

        public function form_process_checkbox($atts = '') {
            global $mb_plugin_options;
            extract($atts);

            $val            = '';
            $saved_std      = '';
            if (isset($mb_plugin_options)) {
                if (isset($mb_plugin_options[$id])) {
                    $saved_std = $mb_plugin_options[$id];
                }else{
                    $saved_std = $std;
                }
            } else {
                $val = $std;
            }

            $checked = '';
            if (!empty($saved_std)) {
                if ($saved_std == 'on') {
                    $checked = 'checked="checked"';
                } else {
                    $checked = '';
                }
            } elseif ($std == 'on') {
                $checked = 'checked="checked"';
            } else {
                $checked = '';
            }

            $output = '';
            $output .= '<div class="mb_option_wraper mb-checkbox">';
            $output .= $this->form_process_heading( $id , $name );
            $output .= '<div class="mb_checkbox">';
            $output .= $this->form_process_hidden($id, 'off', false);
            $output .= '<input type="checkbox" id="' . $id . '" name="' . $id . '" ' . $checked . ' />';
            $output .= '</div>';
            $output .= $this->form_process_description( $desc );
            
            $output .= '</div>';
            echo $output;
        }

        /* ------------------------------------------------
         * Process Form Input type Radio
         * ----------------------------------------------- */

        public function form_process_radio($atts = '') {
            global $mb_plugin_options;
        }

        /* ------------------------------------------------
         * Process Form Input type Upload
         * ----------------------------------------------- */

        public function form_process_upload($atts = '') {
            global $mb_plugin_options;
            extract($atts);

            $val          = '';

            if (isset($mb_plugin_options)) {
                
                if (isset($mb_plugin_options[$id])) {
                    $val = $mb_plugin_options[$id];
                }else{
                    $val = $std;
                }
            } else {
                $val = $std;
            }

            $display = ( $val <> '' ? 'inline-block' : 'none' );

            $output = '';
            $output .= '<div class="mb_option_wraper">';
            $output .= $this->form_process_heading( $id , $name );
            $output .= $this->form_process_description( $desc );
            $output .= '<div class="mb_field">';
            $output .= '<div class="section-upload">';
            $output .= '<div class="mb-option-uploader">';
            $output .= '<div class="input-sec">';
            $output .= '<input id="' . $id . '" name="' . $id . '" type="text" class="upload" value="' . $val . '" />';
            $output .= '</div>';
            $output .= '<div class="mb-buttons">';
            $output .= '<span id="upload" class="button media_upload_button">Upload</span>';
            $output .= '<span style="display:' . $display . ';" id="reset_upload" class="button remove-item" title="Upload">Remove</span>';
            $output .= '</div>';
            $output .= '<div class="screenshot" style="display:' . $display . ';">
								<a href="' . $val . '"><img src="' . $val . '" class="mb-upload-image"></a>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            echo $output;
        }

        /* ------------------------------------------------
         * Process Form Input type Upload
         * ----------------------------------------------- */

        public function form_process_gallery($atts = '') {
           global $mb_plugin_options;
            extract($atts);

            $val          = '';

            if (isset($mb_plugin_options)) {
                
                if (isset($mb_plugin_options[$id])) {
                    $val = $mb_plugin_options[$id];
                }else{
                    $val = $std;
                }
            } else {
                $val = $std;
            }

            $gallery_ids = array();
            $display = ( $val <> '' ? 'inline-block' : 'none' );
            $gallery_ids = explode(',', $val);

            $output = '';
            $output .= '<div class="mb_option_wraper">';
            $output .= $this->form_process_heading( $id , $name );
            $output .= $this->form_process_description( $desc );
            $output .= '<div class="mb_field">';
            $output .= '<div class="section-upload">';
            $output .= '<div class="mb-option-uploader mb-gallery">';
            $output .= '<div class="input-sec">';
            $output .= $this->form_process_hidden($id, $val, false);
            $output .= '</div>';
            $output .= '<div class="mb-buttons">';
            $output .= '<span id="upload" class="button multi_open">Add Gallery</span>';
            $output .= '<span style="display:' . $display . ';" id="reset_gallery" class="button remove-gallery" title="Upload">Remove All</span>';
            $output .= '</div>';
            $output .= '<div class="gallery-container" style="display:' . $display . '">';
            $output .= '<ul class="gallery-list">';

            if (isset($gallery_ids) && $gallery_ids != '') {
                foreach ($gallery_ids as $key) {
                    $image_path = wp_get_attachment_image_src($key, array(150, 150));
                    if (isset($image_path[0]) && $image_path[0] != '') {
                        $output .= '<li class="image" data-attachment_id="' . $key . '">';
                        $output .= '<img src="' . $image_path[0] . '" alt="gallery" />';
                        $output .= '<a href="javascript:;" class="del-node"  title=""><i class="fa fa-times"></i></a>';

                        $output .= '</li>';
                    }
                }
            }

            $output .= '</ul>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            echo $output;
        }

        /* ------------------------------------------------
         * Process Form Input type Color
         * ----------------------------------------------- */

        public function form_process_color($atts = '') {
            global $mb_plugin_options;
            extract($atts);

            $val          = '';

            if (isset($mb_plugin_options)) {
                
                if (isset($mb_plugin_options[$id])) {
                    $val = $mb_plugin_options[$id];
                }else{
                    $val = $std;
                }
            } else {
                $val = $std;
            }

            $output = '';
            $output .= '<div class="mb_option_wraper">';
            $output .= $this->form_process_heading( $id , $name );
            $output .= $this->form_process_description( $desc );
            $output .= '<div class="mb_field">';
            $output .= '<input type="text" class="mb_color_picker" id="' . $id . '" name="' . $id . '" value="' . esc_attr($val) . '" />';
            $output .= '</div>';
            $output .= '</div>';
            echo $output;
        }

        /* ------------------------------------------------
         * Process Form Input type Checkbox
         * ----------------------------------------------- */

        public function form_process_mb_menu($atts = '') {
            global $mb_plugin_options;
            $this->do_process_menu('MailChimp (Newsletters)', 'mailchimp', 'flaticon-mailchimp', true);
            $this->do_process_menu('Twitter', 'twitter', 'flaticon-twitter1', false);
            $this->do_process_menu('Instagram', 'instagram', 'flaticon-instagram12', false);
            $this->do_process_menu('Flickr', 'flickr', 'flaticon-flickr5', false);
            $this->do_process_menu('Facebook', 'facebook', 'flaticon-facebook55', false);
        }

    }

}
?>

