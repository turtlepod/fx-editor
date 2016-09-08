=== f(x) Editor ===
Contributors: turtlepod
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TT23LVNKA3AU2
Tags: tinymce, editor, wp editor, visual editor, boxes, buttons, columns
Requires at least: 4.0
Tested up to: 4.6
Stable tag: 1.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Power-up Your WordPress Visual Editor with Boxes, Buttons, Columns, and more...

== Description ==

**[f(x) Editor](http://genbumedia.com/plugins/fx-editor/)** is a plugin to enhance your content editing experience by enabling WordPress features such as Page Break and Text Background Color/Highlight.

You can also easily create information boxes, colorful buttons, and columns to make your content richer and engage to your audience more.

After installation of this plugin, you can enable each features by navigating to "Settings > Visual Editor" menu in your administration panel.

**Features:**

1. Easy settings to disable/enable features.
1. Create boxes (Note, Alert, Error, Downloads) via visual editor.
1. Create buttons (White, Black, Red, Green, Blue) via visual editor.
1. Create columns ( up to 3 columns: "1/2 - 1/2" ; "1/3 - 2/3" ; "2/3 - 1/3" ; "1/3 - 1/3 - 1/3" ) via visual editor.
1. Add page break button.
1. Enable text background color option (not only text color).
1. Switch paragraph to BR(line break).
1. Easy to use. No shortcode to remember.
1. The GPL v2.0 or later license. :) Use it to make something cool.
1. Support available at [Genbu Media](https://genbumedia.com/contact/).


== Installation ==

1. Navigate to "Plugins > Add New" Page from your Admin.
2. To install directly from WordPress.org repository, search the plugin name in the search box and click "Install Now" button to install the plugin.
3. To install from plugin .zip file, click "Upload Plugin" button in "Plugins > Add New" Screen. Browse the plugin .zip file, and click "Install Now" button.
4. Activate the plugin.
5. Navigate to "Settings > Visual Editor" page in your admin panel to manage the plugin settings.

== Frequently Asked Questions ==

= Where is the settings ? =

The settings is available at "Settings > Visual Editor" page.

= How to disable/override the CSS? =

This plugin have no option to disable CSS. If you want to disable the CSS you need to remove the stylesheet via hooks. Read the "Other Notes" section for more info.

= How to add content after boxes? =

You can jump-off the boxes by pressing "Enter" twice.

= How to add content after columns? =

If a little trickier, you need to press "Enter" twice 2 times. That's 4 times. The first 2 is for jump-off the individual column and the second 2 is to actually jump the overall column section.

== Screenshots ==

1. Editor Settings.
2. Boxes.
3. Buttons.
4. Columns.
5. Text background Color.
6. Line Break.
7. Coder Module.
8. Coder Front View.

== Changelog ==

= 1.2.0 - 8 Sep 2016 =
* Remove WP 4.0 required notice.
* Move uninstall function to uninstall.php file for easier maintenance.
* Remove activation hook function.
* Change assets folder structure
* Add "Coder" Module using google pretify.
* Add support url in plugin action link.

= 1.1.0 - 2 March 2016 =
* New option: enable only for "content" editor (default: true).
* Each buttons editor ids now filterable. this will allow dev to fine tune where the buttons appear.
* Delete options in database on plugin uninstall.

= 1.0.1 - 3 Feb 2016 =
* Update language stings, language POT file.
* Check version using WP version instead of tinyMCE version. (use min 4.3)
* Add admin notice for minimum requirements.

= 1.0.0 - 2 Feb 2016 =
* Initial release.

== Upgrade Notice ==

= 1.2.0 =
New Coder Module.

= 1.1.0 =
Enable features in all editor instance.

= 1.0.1 =
Minor fix. Language files.

= 1.0.0 =
1st version

== Other Notes ==

Notes for developer: 

= Github =

Development of this plugin is hosted at [GitHub](https://github.com/turtlepod/fx-editor). Pull request and bug reports are welcome.

= Options =

This plugin save the options in single option name: `fx-editor`.

= Scripts =

This plugin load one CSS in site front-end and one css in editor. If you are a theme author and want to override the styling it is recommended to remove the CSS and add the CSS in your theme stylesheet and editor style CSS.

To disable the front end CSS, add this code in your theme functions.php:

`add_filter( 'fx_editor_load_front_css', '__return_false' );`

and then you can copy the CSS "css/front.css" to your theme style.css and make adjustment as needed.

To disable the back-end/editor CSS, add this code in your theme functions.php:

`add_filter( 'fx_editor_load_editor_css', '__return_false' );`

And then you can copy the CSS "css/editor.css" to your theme editor styles and make adjustment as needed. Note: You need to make sure all the needed elements such as "remove icon" and "columns info" are styled properly to make sure user can properly edit the content.

For coder module, there are separate filters to disable it:

`add_filter( 'fx_editor_load_coder_editor_css', '__return_false' );
add_filter( 'fx_editor_load_coder_front_css', '__return_false' );
add_filter( 'fx_editor_load_coder_front_js', '__return_false' );`
