(function() {

    tinymce.create('tinymce.plugins.wen_responsive_columns', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {

            var our_url = url.replace("admin/js", "");

            ed.addButton('wen_responsive_columns', {
                title : ed.getLang('wen_responsive_columns.button_title'),
                cmd : 'wen_responsive_columns',
                image : our_url + '/admin/images/wrc-button.png',
                onClick : function(){
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                    W = W - 80;
                    H = H - 84;
                    tb_show( ed.getLang('wen_responsive_columns.popup_title'), '#TB_inline?width=' + W + '&height=' + H + '&inlineId=wrc-popup-form' );
                    return;
                }
            });

        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'WRC Buttons',
                author : 'WEN',
                authorurl : 'http://wenthemes.com/',
                infourl : 'http://wenthemes.com/',
                version : "0.1"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add( 'wen_responsive_columns', tinymce.plugins.wen_responsive_columns );

})();
