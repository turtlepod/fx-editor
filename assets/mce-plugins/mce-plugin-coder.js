/**
 * WP Editor Coder Addon
 * 
 * @copyright Copyright (c) 2016, Genbu Media
 * @link      https://genbumedia.com/plugins/fx-editor/
 * @copyright Copyright (c) 2016, David Chandra Purnama
 * @link      https://shellcreeper.com/
 * @author    David Chandra Purnama <david@shellcreeper.com>
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

(function (d) {

	/**
	 * ================================================
	 * Create TinyMCE Plugin for Boxes
	 * http://wordpress.org/plugins/tinymce-code-element/
	 * ================================================
	 */
	tinymce.create( 'tinymce.plugins.wpe_addon_coder', {

		/* Load inline setting on editor click */
		init : function( ed, url ) {

			/* Code */
			ed.addButton('wpe_addon_coder_code', {
				title : 'Code',
				image : url + '/../images/tool-code-icon.png',
				cmd : 'wpe_addon_coder_code',
				stateSelector : 'code',
			});
			ed.addCommand('wpe_addon_coder_code', function() {
				var e = ed.dom.getParent(ed.selection.getNode(), 'CODE');
				if (e===null){
					//add code element
					if ( ed.selection.isCollapsed() ) {
						ed.execCommand('mceInsertContent', false, " <code>code</code> ");
					} else {
                        var code = jQuery('<code />');
                        code.html(ed.selection.getContent());
						ed.execCommand(
                            'mceReplaceContent',
                            false,
                            jQuery('<div />').append(code).html()
                        );
					}
				} else {
					//remove code element
					ed.execCommand('mceRemoveNode', false, e);
					ed.nodeChanged();
				}
			});

			/* Preformatted */
			ed.addButton('wpe_addon_coder_pre', {
				title : 'Pre',
				image : url + '/../images/tool-pre-icon.png',
				cmd : 'wpe_addon_coder_pre',
				stateSelector : 'pre',
			});
			ed.addCommand('wpe_addon_coder_pre', function() {
				var p = ed.dom.getParent(ed.selection.getNode(), 'P');
				var e = ed.dom.getParent(ed.selection.getNode(), 'PRE');
				if (p !== null){
					var this_p = jQuery( p );
					var this_p_html = '<pre>' + this_p.html() + '</pre>';
					this_p.replaceWith( this_p_html );
				}
				else{
					if (e === null){
						if ( ed.selection.isCollapsed() ) {
							ed.execCommand('mceInsertContent', false, "<pre>code</pre>");
						} else {
							var pre = jQuery('<pre />');
							pre.html(ed.selection.getContent());
							ed.execCommand(
								'mceReplaceContent',
								false,
								jQuery('<div />').append(pre).html()
							);
						}
					} else {
						//remove code element
						ed.execCommand('mceRemoveNode', false, e);
						ed.nodeChanged();
					}
				}
			});

			/* HTML */
			ed.addButton('wpe_addon_coder_html', {
				title : 'HTML',
				image : url + '/../images/tool-html-icon.png',
				stateSelector : 'pre.lang-html',
				onPostRender: function() {
					var that = this;
					ed.on('NodeChange', function(e) {
						that.disabled( e.element.nodeName != 'PRE' );
					});
				},
				onclick : function() {
					var this_pre = jQuery( ed.dom.getParent( ed.selection.getNode(), 'PRE' ) );
					if ( this_pre.hasClass("lang-html") ){
						this_pre.removeClass();
					}
					else{
						this_pre.removeClass().addClass( "lang-html" );
					}
				},
			});

			/* PHP */
			ed.addButton('wpe_addon_coder_php', {
				title : 'PHP',
				image : url + '/../images/tool-php-icon.png',
				stateSelector : 'pre.lang-php',
				onPostRender: function() {
					var that = this;
					ed.on('NodeChange', function(e) {
						that.disabled( e.element.nodeName != 'PRE' );
					});
				},
				onclick : function() {
					var this_pre = jQuery( ed.dom.getParent( ed.selection.getNode(), 'PRE' ) );
					if ( this_pre.hasClass("lang-php") ){
						this_pre.removeClass();
					}
					else{
						this_pre.removeClass().addClass( "lang-php" );
					}
				},
			});

			/* CSS */
			ed.addButton('wpe_addon_coder_css', {
				title : 'CSS',
				image : url + '/../images/tool-css-icon.png',
				stateSelector : 'pre.lang-css',
				onPostRender: function() {
					var that = this;
					ed.on('NodeChange', function(e) {
						that.disabled( e.element.nodeName != 'PRE' );
					});
				},
				onclick : function() {
					var this_pre = jQuery( ed.dom.getParent( ed.selection.getNode(), 'PRE' ) );
					if ( this_pre.hasClass("lang-css") ){
						this_pre.removeClass();
					}
					else{
						this_pre.removeClass().addClass( "lang-css" );
					}
				},
			});

			/* JS */
			ed.addButton('wpe_addon_coder_js', {
				title : 'JS',
				image : url + '/../images/tool-js-icon.png',
				stateSelector : 'pre.lang-js',
				onPostRender: function() {
					var that = this;
					ed.on('NodeChange', function(e) {
						that.disabled( e.element.nodeName != 'PRE' );
					});
				},
				onclick : function() {
					var this_pre = jQuery( ed.dom.getParent( ed.selection.getNode(), 'PRE' ) );
					if ( this_pre.hasClass("lang-js") ){
						this_pre.removeClass();
					}
					else{
						this_pre.removeClass().addClass( "lang-js" );
					}
				},
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
				longname : "f(x) Editor Coder",
				author : "David Chandra Purnama",
				authorurl : 'https://shellcreeper.com',
				infourl : 'https://genbumedia.com/plugins/fx-editor/',
				version : "1.0.0"
			};
		}
	});

	tinymce.PluginManager.add( 'wpe_addon_coder', tinymce.plugins.wpe_addon_coder );
}(jQuery));