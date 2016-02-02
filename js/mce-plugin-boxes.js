/**
 * WP Editor Boxes Addon
 * 
 * @author    David Chandra Purnama <david@shellcreeper.com>
 * @copyright Copyright (c) 2013, David Chandra Purnama
 * @link      http://my.wp-editor.com
 * @link      http://shellcreeper.com
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

(function(){

	/**
	 * ================================================
	 * Inline Setting
	 * ================================================
	 */
	function wpe_boxes_inline_setting( e ){

		/* Box */
		var box_element = jQuery( tinymce.activeEditor.dom.select('.wpe-box') );

		/* Add inline setting */
		box_element.mousemove(function(){

			/* Add active class */
			jQuery( this ).addClass('wpe-box-active');

			/* If inline setting not exist, add it */
			if ( jQuery( this ).children('.wpe-box-remove').length <= 0 ) {
				jQuery( this ).prepend( '<div class="wpe-box-remove"></div>' );
			}
		});

		/* Remove inline setting */
		box_element.mouseleave(function(){
			jQuery( this ).removeClass('wpe-box-active');
			jQuery( this ).children( '.wpe-box-remove' ).remove();
		});
	};


	/**
	 * ================================================
	 * Do Inline Setting
	 * ================================================
	 */
	function wpe_boxes_do_inline_setting( e ){

		/* Column Remove Icon */
		var box_remove_icon = jQuery( tinymce.activeEditor.dom.select('.wpe-box-remove') );

		/* Remove box */
		box_remove_icon.unbind("click").click(function(){

			/* This box */
			var this_box = jQuery( this ).parent( '.wpe-box' );

			/* Get content */
			jQuery( this ).remove();
			var box_content = this_box.html();
			this_box.after( box_content );
			this_box.remove();
		});
	};

	/**
	 * ================================================
	 * Create TinyMCE Plugin for Boxes
	 * Modified from Crazy Pills Plugins
	 * http://wordpress.org/extend/plugins/crazy-pills/
	 * ================================================
	 */
	tinymce.create( 'tinymce.plugins.wpe_addon_boxes', {

		/* Load inline setting on editor click */
		init : function( ed, url ) {

			/* Add drop down */
			ed.addButton( 'wpe_addon_boxes', {
				type: 'listbox',
				text: 'Boxes',
				classes: 'btn widget fixed-width',
				icon: false,
				onselect: function(e) {}, 
				values: [
					{text: 'Note', onclick : function() {
						var sel_txt = false;
						var sel_content = sel_txt = tinyMCE.activeEditor.selection.getContent();
						if ( sel_txt !== '' ) {
							sel_content = '<div class="wpe-box wpe-box-note"><p>' + sel_txt +  '</p></div>';
						} else {
							sel_content = '<div class="wpe-box wpe-box-note"><p>Message box contents...</p></div>';
						}
						tinymce.execCommand('mceInsertContent', false, sel_content);
					}},
					{text: 'Alert', onclick : function() {
						var sel_txt = false;
						var sel_content = sel_txt = tinyMCE.activeEditor.selection.getContent();
						if ( sel_txt !== '' ) {
							sel_content = '<div class="wpe-box wpe-box-alert"><p>' + sel_txt +  '</p></div>';
						} else {
							sel_content = '<div class="wpe-box wpe-box-alert"><p>Message box contents...</p></div>';
						}
						tinymce.execCommand('mceInsertContent', false, sel_content);
					}},
					{text: 'Error', onclick : function() {
						var sel_txt = false;
						var sel_content = sel_txt = tinyMCE.activeEditor.selection.getContent();
						if ( sel_txt !== '' ) {
							sel_content = '<div class="wpe-box wpe-box-error"><p>' + sel_txt +  '</p></div>';
						} else {
							sel_content = '<div class="wpe-box wpe-box-error"><p>Message box contents...</p></div>';
						}
						tinymce.execCommand('mceInsertContent', false, sel_content);
					}},
					{text: 'Download', onclick : function() {
						var sel_txt = false;
						var sel_content = sel_txt = tinyMCE.activeEditor.selection.getContent();
						if ( sel_txt !== '' ) {
							sel_content = '<div class="wpe-box wpe-box-download"><p>' + sel_txt +  '</p></div>';
						} else {
							sel_content = '<div class="wpe-box wpe-box-download"><p>Message box contents...</p></div>';
						}
						tinymce.execCommand('mceInsertContent', false, sel_content);
					}},
				]
			});

			/* Load functions on Event */
			ed.on( 'init', function( e ) {
				wpe_boxes_inline_setting( e );
				wpe_boxes_do_inline_setting( e );
			});
			ed.on( 'focus', function( e ) {
				wpe_boxes_inline_setting( e );
				wpe_boxes_do_inline_setting( e );
			});
			ed.on( 'click', function( e ) {
				wpe_boxes_inline_setting( e );
				wpe_boxes_do_inline_setting( e );
			});
			ed.on( 'show', function( e ) {
				wpe_boxes_inline_setting( e );
				wpe_boxes_do_inline_setting( e );
			});
		},

		/**
		 * Creates control instances based in the incomming name.
		 */
		createControl: function (n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 */
		getInfo : function() {
			return {
				longname : "WP Editor Boxes",
				author : "David Chandra Purnama",
				authorurl : 'http://shellcreeper.com',
				infourl : 'http://wp-editor.com',
				version : "0.1.1"
			};
		}
	});

	tinymce.PluginManager.add( 'wpe_addon_boxes', tinymce.plugins.wpe_addon_boxes );
})();