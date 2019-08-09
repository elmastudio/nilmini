
------------------------------------------------------------------------------------------------------------
For the detailed theme documentation visit:
- https://www.elmastudio.de/en/themes/docs/ (English)
- https://www.elmastudio.de/wordpress-themes/doks/ (German)

Please ask all theme questions in our theme support forum: https://elmastudio.ticksy.com/
------------------------------------------------------------------------------------------------------------

Changelog:

Version 1.0.6 (21/12/2018)
------------------------------------------------------------------------------------------------------------
- New: Gutenberg editor support
- New: Support of WordPress GDPR options.
- Enhancement: Update of translations files.
- Bugfix: Update of functions.php for PHP 7.2 compatibility.

Version 1.0.5 - 17/03/2017
------------------------------------------------------------------------------------------------------------
- New: Support for the One Click Demo Import plugin.
- Bugfix: Updated deprecated functions.
- Enhancement: Updated all links to https.
- Enhancement: Support for Wordpress title-tag.

Version 1.0.4 - 03/04/2014
------------------------------------------------------------------------------------------------------------
- Bugfix: Updated jquery.fitvids.js in folder "js" to fix Chrome font bug
- Enhancement: Deleted deprecated code in functions.php and includes/theme-options.php
- Enhancement: Code update for custom header in header.php

Version 1.0.3 - November 28th 2011
------------------------------------------------------------------------------------------------------------
1. Updated to jQuery 1.7.0 (see functions.php line 49).
2. Removed the respond.js script (js-folder and functions.php line 63). Please use the respond.js WordPress
	 plugin instead if needed (https://wordpress.org/extend/plugins/respondjs/).
3. Changed CSS classes "cat-links" and "tag-links" to "cats" and "tags" due to a CSS conflict (in the following
	 files: content, content-single, content-aside, content-audio, content-chat, content-gallery, content-image,
	content-link, content-quote, content-status, content-video and style.css).
4. Fixed layout bug with gallery post format on search results (in content-gallery.php)
5. Added styling for category descriptions (see style.css from line 1440).
6. Updated WP-PageNavi styles (bugfix for Firefox and IE).
7. Added WordPress featured image support, so large included featured images will be used as header image on posts and pages
	 if the header image option is activated (see header.php line 102 - 114).
8. Added -ms-text-size-adjust: none; and -webkit-text-size-adjust: none; to prevent iOS and Windows Mobile font-size changes (see style.css line 1925).
9. Added 500px, Pinterest, Soundcloud, Delicious, Behance Network, DeviantART and Squidoo to the Social Links Widgets.
10. Included option to hide sub navigations menus in mobile devices (tablets, smartphones) to the theme options page.
		This way the menu is reduced in height and the blog content will get more focus.
11. Bug fixes for RTL language support (updated the rtl.css file).
12. Further style optimizations for IE7 (see style.css from line 1940).
13. Updated functions.php (see line 47) to avoid registering the alternate Google jQuery library on admin pages.
14. Updated custom.js to use jQuery no.conflict (for more information see: https://docs.jquery.com/Using_jQuery_with_Other_Libraries).

Version 1.0.2 - October 06th 2011
------------------------------------------------------------------------------------------------------------
1. Added theme translation for Dutch to the languages folder.
2. Updated to jQuery 1.6.4 (see functions.php line 42).
3. Call of the HTML5 enabling script (for IE 7+8) via Google code (see https://code.google.com/p/html5shim/)
	 therefore deleted the html5.js in the js folder.
4. Bugfix for WPPagenavi plugin (added display: inline-block in style.css line 1761).
5. Added Featured Video widget (you can just include the iframe embed code from YouTube or Vimeo into the widget.
6. Included the fitvids.js script for elastic embedded videos (and also added a stlye to style.css line 1724 for the max. video size).
7. Updated the rtl.css to support rtl languages.

Version 1.0.1 - September 05th 2011
------------------------------------------------------------------------------------------------------------
1. Resized font size in smartphone view so longer titles will still fit (line 2281-2286).
2. Updated the Google+ button code in share-posts.php line 10 and the tweet button code in line 3-4.
3. Added the Respond.js script via functions.php line 62 to the theme to support media queries in
	 Internet Explorer 6-8. See the Scripts details on GitHub: https://github.com/scottjehl/Respond
4. Added standard header text color in function line 93 to prevent error in header image option.
5. Added Hover-Effekt for contact form input and textarea line 1862-67 in style.css.
6. Fixed IE problem with dropdown men�s by changing top value in line 444 of style.css.
7. Added styles for Smart Archives plugin in smartphone view (style.css, line 2421-34)
8. Deleted js for tweet button from file share-posts.php and included it to footer.php to avoid including
	 the script multiple times on one page.
9. Added styles for elastic video box to make responsive iframe videos possible (line 822-41 in style.css)
	 Use it like this:
	 <div class="elastic-video-wrapper"><div class="elastic-video">Put your iframe embed code from YouTube or Vimeo here</div></div>
	 The "elastic-video-wrapper" div container is optional and sets a width for the video container (you can change the standard width of 680px in line 823, style.css)
	 (Credit: https://webdesignerwall.com/tutorials/css-elastic-videos)

Version 1.0 - August 15th 2011
------------------------------------------------------------------------------------------------------------
1. Nilmini theme release

------------------------------------------------------------------------------------------------------------
Social Icons used for Social Links widget: Icons by Gedy Rivera: https://lifetreecreative.com/icons/
