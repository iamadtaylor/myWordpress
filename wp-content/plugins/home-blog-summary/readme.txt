=== Blog Summary ===
CONTRIBUTORS: scottwallick
DONATE LINK: http://www.plaintxt.org/about/#donate
TAGS: recent posts, recent entries, summary, latest posts, latest entires, shorcode, hatom, microformats, sandbox, excerpt
REQUIRES AT LEAST: 2.5
TESTED UP TO: 2.6.1
STABLE TAG: 0.1.2

Blog Summary produces a semantic, hAtom-enabled list of the latest blog post excerpts with the shortcode `[blog-summary]`.

== Description ==

Blog Summary produces a semantic, hAtom-enabled list of latest blog entries with excerpts, dates, and comments links that is generated with the shortcode `[blog-summary]` on any post or page. Shortcode attributes are available to customize the output as well as specify number of entries to show.

Blog Summary is the easiest way to show the latest blog entries on a static page, marked up in the hAtom microformat and utilizing the semantic class funtions when the  [Sandbox](http://www.plaintxt.org/themes/sandbox/ "Sandbox theme for WordPress") (or Sandbox-based) theme is active.

Blog Summary is for WordPress 2.6.x and features:

* Out-of-the-box function using shortcode without editing any files
* Advanced shortcode attribute parsing for easy and complete customization
* Highly semantic XHTML in the [hAtom](http://microformats.org/wiki/hatom/ "hAtom 0.1 microformat") microformat
* Integration with Sandbox (or Sandbox-based) class-generating functions

== Installation ==

This plugin is installed just like any other WordPress plugin. More [detailed installation instructions](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins "Installing Plugins - WordPress Codex") are available on the WordPress Codex.

1. Download Blog Summary
2. Extract the `/blog-summary/` folder from the archive
3. Upload this folder to `../wp-contents/plugins/`
4. Activate the plugin in *Dashboard > Plugins*
5. Use the shortcode `[blog-summary]` on any page/post
6. Enjoy. And then consider donating

In other words, just upload the `/blog-summary/` folder and its contents to your plugins folder.

== Use ==

After activating this plugin, simply use the shortcode `[blog-summary]` wherever you want a list of recent entries. The following optional attributes are parsed by this shortcode to customize the output:

* `count` - Number of recent entries to show. Default is 5.
* `grouptag` - HTML element to wrap all recent entries. Default is `ol`.
* `entrytag` - HTML element to wrap each entry. Default is `li`.
* `titletag` - HTML element to wrap each entry title. Default is `h4`.
* `datetag` - HTML element to wrap each entry date. Default is `span`.
* `commentstag` - HTML element to wrap each entry comments link. Default is `span`.
* `summarytag` - HTML element to wrap each entry summary. Default is `div`.

You may specify all or some of the attributes above. Attributes are optional and can be given in any order.

`[blog-summary count="3" titletag="h2" datetag="p" commentstag="div"]`


And so on. A very simple plugin.

== License ==

Blog Summary, a plugin for WordPress, (C) 2008 by Scott Allan Wallick, is licensed under the [GNU General Public License](http://www.gnu.org/licenses/gpl.html "GNU General Public License").

Blog Summary is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

Blog Summary is distributed in the hope that it will be useful, but **without any warranty**; without even the implied warranty of **merchantability** or **fitness for a particular purpose**. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Blog Summary.  If not, see http://www.gnu.org/licenses/.

== Frequently Asked Questions ==

= What does this plugin do? =

It inserts list of your latest blog posts where the shortcode `[blog-summary]` is used on a post or page. Nothing more, nothing less.

= Can I customize the output of this shortcode? =

Yes. You can specify shortcode attributes to customize the HTML elements that group the output. See the [plugin page](http://www.plaintxt.org/experiments/blog-summary/ "Blog Summary, a plaintxt.org experiment") for more information on attributes that this shortcode will parse.

= Why does the post content look all funny, without tags, etc? =

This plugin uses the WordPress function `the_excerpt` to produced a short 'summary' of your latest blog posts. You can specify your excerpt in the post editor. See [Writing Posts](http://codex.wordpress.org/Writing_Posts "Writing Posts in the WordPress Codex") in the WordPress Codex for more information.

= Can this post show the full post instead of the excerpt? =

It could, but you will have to modify the plugin. Search for `the_excerpt` and modify accordingly, but you're on your own for this.

= What's all this about 'sematic class-generating functions' and the Sandbox theme? =

The [Sandbox](http://www.plaintxt.org/themes/sandbox/ "Sandbox theme for WordPress") is a design-less theme for WordPress that has a highly extensible XHTML structure powered by these nifty functions that create semantic classes, i.e., classes that have meaningful names related to the content. For more information on this, see the [Sandbox documentation](http://www.plaintxt.org/themes/sandbox/#learn "Sandbox documentation, readme.html").

= So is the Sandbox required? =

No, it is not required. But its advanced class-generating functions are supported by this plugin.
