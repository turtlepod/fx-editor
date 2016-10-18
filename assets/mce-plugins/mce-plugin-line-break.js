/**
 * f(x) Editor TinyMCE Plugin: Line Break
 * 
 * @copyright Copyright (c) 2016, Genbu Media
 * @link      https://genbumedia.com/plugins/fx-editor/
 * @copyright Copyright (c) 2016, David Chandra Purnama
 * @link      https://shellcreeper.com/
 * @author    David Chandra Purnama <david@shellcreeper.com>
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
(function (d) {

	tinymce.create( 'tinymce.plugins.wpe_line_break', {

		/* Load inline setting on editor click */
		init : function( ed, url ) {

			/* Code */
			ed.addButton('wpe_line_break', {
				title : 'Line Break',
				image : url + '/../images/tool-line-break.png',
				cmd : 'wpe_line_break',
				//stateSelector : 'BR',
			});
			ed.addCommand('wpe_line_break', function() {
				tinymce.execCommand( 'mceInsertContent', false, "<br>\n" );
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
				longname : "f(x) Editor Line Break",
				author : "David Chandra Purnama",
				authorurl : 'https://shellcreeper.com',
				infourl : 'https://genbumedia.com/plugins/fx-editor/',
				version : "1.0.0"
			};
		}
	});

	tinymce.PluginManager.add( 'wpe_line_break', tinymce.plugins.wpe_line_break );
}(jQuery));