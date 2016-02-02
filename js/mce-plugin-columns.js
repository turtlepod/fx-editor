/**
 * WP Editor Column Addon
 * 
 * @author    David Chandra Purnama <david@shellcreeper.com>
 * @copyright Copyright (c) 2013, David Chandra Purnama
 * @link      http://my.wp-editor.com
 * @link      http://shellcreeper.com
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

(function (d) {

	/**
	 * ================================================
	 * Toolbar Button Click Action
	 * ================================================
	 */
	/* 1212 */
	function wpe_columns_button_1212( ed, url ){
		/* First column content if any text selected, use it. */
		var content = '<p>Column 1</p>';
		var selected_content = tinyMCE.activeEditor.selection.getContent();
		if ( selected_content ){
			content = '<p>' + selected_content + '</p>';
		}
		/* Insert */
		var insert  = '<div class="wpe-col wpe-col-12-12">';
			insert += '<div class="wpe-col-1">';
			insert += content;
			insert += '</div>';
			insert += '<div class="wpe-col-2">';
			insert += '<p>Column 2</p>';
			insert += '</div>';
			insert += '</div>';
		tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, insert + ' ' );
	};
	/* 1323 */
	function wpe_columns_button_1323( ed, url ){
		/* First column content if any text selected, use it. */
		var content = '<p>Column 1</p>';
		var selected_content = tinyMCE.activeEditor.selection.getContent();
		if ( selected_content ){
			content = '<p>' + selected_content + '</p>';
		}
		/* Insert */
		var insert  = '<div class="wpe-col wpe-col-13-23">';
			insert += '<div class="wpe-col-1">';
			insert += content;
			insert += '</div>';
			insert += '<div class="wpe-col-2">';
			insert += '<p>Column 2</p>';
			insert += '</div>';
			insert += '</div>';
		tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, insert + ' ' );
	};
	/* 2313 */
	function wpe_columns_button_2313( ed, url ){
		/* First column content if any text selected, use it. */
		var content = '<p>Column 1</p>';
		var selected_content = tinyMCE.activeEditor.selection.getContent();
		if ( selected_content ){
			content = '<p>' + selected_content + '</p>';
		}
		/* Insert */
		var insert  = '<div class="wpe-col wpe-col-23-13">';
			insert += '<div class="wpe-col-1">';
			insert += content;
			insert += '</div>';
			insert += '<div class="wpe-col-2">';
			insert += '<p>Column 2</p>';
			insert += '</div>';
			insert += '</div>';
		tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, insert + ' ' );
	};
	/* 131313 */
	function wpe_columns_button_131313( ed, url ){
		/* First column content if any text selected, use it. */
		var content = '<p>Column 1</p>';
		var selected_content = tinyMCE.activeEditor.selection.getContent();
		if ( selected_content ){
			content = '<p>' + selected_content + '</p>';
		}
		/* Insert */
		var insert  = '<div class="wpe-col wpe-col-13-13-13">';
			insert += '<div class="wpe-col-1">';
			insert += content;
			insert += '</div>';
			insert += '<div class="wpe-col-2">';
			insert += '<p>Column 2</p>';
			insert += '</div>';
			insert += '<div class="wpe-col-3">';
			insert += '<p>Column 3</p>';
			insert += '</div>';
			insert += '</div>';
		tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, insert + ' ' );
	};

	/**
	 * ================================================
	 * Setting to Remove Column
	 * ================================================
	 */
	function wpe_columns_inline_setting( e ){

		/* Column */
		var col_element = jQuery( tinymce.activeEditor.dom.select('.wpe-col') );

		/* Add inline setting */
		col_element.mousemove(function(){

			/* Add active class */
			jQuery( this ).addClass('wpe-col-active');

			/* If inline setting not exist, add it */
			if ( jQuery( this ).children('.wpe-col-remove').length <= 0 ) {
				jQuery( this ).prepend( '<div class="wpe-col-remove"></div>' );
			}
		});

		/* Remove inline setting */
		col_element.mouseleave(function(){
			jQuery( this ).removeClass('wpe-col-active');
			jQuery( this ).find( '.wpe-col-remove' ).remove();
		});
	};

	/**
	 * ================================================
	 * Do Inline Setting
	 * ================================================
	 */
	function wpe_column_do_inline_setting( e ){

		/* Column Remove Icon */
		var col_remove_icon = jQuery( tinymce.activeEditor.dom.select('.wpe-col-remove') );

		/* Remove Column on Click */
		col_remove_icon.click(function(){

			/* Add class to delete setting */
			jQuery(this).addClass( "wpe-col-setting-ready-remove" );

			/* Add class to delete the current box */
			jQuery(this).parent( '.wpe-col' ).addClass( "wpe-col-ready-remove" );

			var this_col = jQuery(this).parent( '.wpe-col' );

			if ( this_col.hasClass('wpe-col-ready-remove') ){

				/* Get content of each columns in active column as variable */
				var col_1_content = this_col.find('.wpe-col-1').html();
				var col_2_content = this_col.find('.wpe-col-2').html();
				var col_3_content = '';
				if ( this_col.find('.wpe-col-3').length > 0 ){
					col_3_content += this_col.find('.wpe-col-3').html();
				}

				/* Add each column content to editor */
				this_col.after( col_1_content + col_2_content + col_3_content );

				/* Remove the remove icon */
				this_col.find('.wpe-col-setting-ready-remove').remove();

				/* Remove the column */
				this_col.remove();
			}
		});
	};

	/**
	 * ================================================
	 * Presistent adding column, to make sure no column is deleted.
	 * ================================================
	 */
	function wpe_columns_fix( e ){

		/* Column */
		var col_element = jQuery( tinymce.activeEditor.dom.select('.wpe-col') );

		/* if there's a remove icon */
		if ( col_element.children('.wpe-col-remove').length == 0 ) {
			/* No 1st col */
			if ( col_element.children('.wpe-col-1').length == 0 ) {
				/* Add after remove icon */
				col_element.children('.wpe-col-remove').after( '<div class="wpe-col-1"><p>&nbsp;</p></div>' );
			}
		}
		/* No remove icon */
		else{
			/* No 1st column, add it in the beginning */
			if ( col_element.children('.wpe-col-1').length == 0 ) {
				col_element.prepend( '<div class="wpe-col-1"><p>&nbsp;</p></div>' );
			}
		}
		/* No 2nd column */
		if ( col_element.children('.wpe-col-2').length == 0 ) {
			/* Add it after 1st column */
			col_element.children('.wpe-col-1').after( '<div class="wpe-col-2"><p>&nbsp;</p></div>' );
		}
		/* 3rd column, only in 13-13-13 */
		if ( col_element.hasClass('wpe-col-13-13-13') ) {
			/* No 3rd column */
			if ( col_element.children('.wpe-col-3').length == 0 ) {
				col_element.children('.wpe-col-2').after( '<div class="wpe-col-3"><p>&nbsp;</p></div>' );
			}
		}
	};

	/**
	 * ================================================
	 * Create TinyMCE Plugin for Boxes
	 * Modified from Crazy Pills Plugins
	 * http://wordpress.org/extend/plugins/crazy-pills/
	 * ================================================
	 */
	tinymce.create( 'tinymce.plugins.wpe_addon_columns', {

		/* Load inline setting on editor click */
		init : function( ed, url ) {

			/* Column 1/2 - 1/2 Button */
			ed.addButton('wpe_addon_col_12_12', {
				title : 'Columns 1/2-1/2',
				image : url + '/../images/tool-icon-12-12.png',
				onclick : function() {
					wpe_columns_button_1212( ed, url );
				},
			});
			/* Column 1/3 - 2/3 Button */
			ed.addButton('wpe_addon_col_13_23', {
				title : 'Columns 1/3-2/3',
				image : url + '/../images/tool-icon-13-23.png',
				onclick : function() {
					wpe_columns_button_1323( ed, url );
				},
			});
			/* Column 2/3 - 1/3 Button */
			ed.addButton('wpe_addon_col_23_13', {
				title : 'Columns 2/3-1/3',
				image : url + '/../images/tool-icon-23-13.png',
				onclick : function() {
					wpe_columns_button_2313( ed, url );
				},
			});
			/* Column 1/3 - 1/3 - 1/3 Button */
			ed.addButton('wpe_addon_col_13_13_13', {
				title : 'Columns 1/3-1/3-1/3',
				image : url + '/../images/tool-icon-13-13-13.png',
				onclick : function() {
					wpe_columns_button_131313( ed, url );
				},
			});

			/* Load funtions on Event */
			ed.on( 'init', function( e ) {
				wpe_columns_fix( e );
				wpe_columns_inline_setting( e );
				wpe_column_do_inline_setting( e );
			});
			ed.on( 'change', function( e ) {
				wpe_columns_fix( e );
			});
			ed.on( 'focus', function( e ) {
				wpe_columns_fix( e );
				wpe_columns_inline_setting( e );
				wpe_column_do_inline_setting( e );
			});
			ed.on( 'click', function( e ) {
				wpe_columns_fix( e );
				wpe_columns_inline_setting( e );
				wpe_column_do_inline_setting( e );
			});
			ed.on( 'show', function( e ) {
				wpe_columns_fix( e );
				wpe_columns_inline_setting( e );
				wpe_column_do_inline_setting( e );
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
				longname : "WP Editor Columns",
				author : "David Chandra Purnama",
				authorurl : 'http://shellcreeper.com',
				infourl : 'http://wp-editor.com',
				version : "0.1.1"
			};
		}
	});

	tinymce.PluginManager.add( 'wpe_addon_columns', tinymce.plugins.wpe_addon_columns );
}(jQuery));