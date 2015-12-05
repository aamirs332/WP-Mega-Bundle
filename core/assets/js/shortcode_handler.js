(function() {

    tinymce.create('tinymce.plugins.WRAP', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished its initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {

            /* insert text with list box */
            var mb_twitter          = '[mb_tweets title="Title Here" view="list" username="" no_of_tweets="5"]';
            var mb_instagram        = '[mb_instagram title="Title Here" view="" username="" no_of_photos=""]';
            var mb_mailchimp        = '[mb_mailchimp title="Title Here" firstname="on" lastname="on" success="" error=""]';
            var mb_flickr           = '[mb_flickr title="Title Here" view="list" username="" no_of_photos="5"]';
            var mb_facebook_like    = '[mb_facebook_like title="Title Here" url_to_like="" mb_fb_like_layout="" fb_like_width="" fb_show_friends_faces="yes" mb_fb_include_button="no"]';
            var mb_facebook_page    = '[mb_facebook_page title="Title Here" fb_page_url="" show_posts="" fb_show_friends_faces="" fb_small_header="" fb_hide_cover_photo=""]';
            var mb_facebook_share   = '[mb_facebook_share title="Title Here" fb_share_button_url="" mb_fb_share_layout=""]';
			
            ed.addButton('MBSocials', {
                type: 'listbox', 
				cmd: 'button_green_cmd',
                text: 'Add Shortcode', // dashes to alleviate some padding issues
                fixedWidth: false,
                icon: false,
                values: [
                    {text: 'Latest Tweets', value: mb_twitter},
                    {text: 'Instagram Gallery', value: mb_instagram},
                    {text: 'Newsletter Form', value: mb_mailchimp},
                    {text: 'Flickr Gallery', value: mb_flickr},
                    {text: 'Facebook Like Page', value: mb_facebook_like},
                    {text: 'Facebook Page', value: mb_facebook_page},
                    {text: 'Facebook Share', value: mb_facebook_share},
                ],
                onselect: function(e) {
                    ed.insertContent(this.value());
                }
            });

        }

    });

    // Register plugin
    tinymce.PluginManager.add('MB', tinymce.plugins.WRAP);

})();