Bookmark
Theme Version: 1.0.1
Author: Michael Van Den Berg 
Author URL: https://michaelvandenberg.com/

--------------------
=== Description ===
--------------------

A free blogging theme with nice typography and customizable colors.


--------------------
=== Copyright ===
--------------------

Bookmark WordPress Theme, Copyright 2016 Michael Van Den Berg.
Bookmark is distributed under the terms of the GNU GPL license 3.0 or later.

Bookmark is based on Underscores http://underscores.me/, (C) 2012-2017 Automattic, Inc.


--------------------
=== Installation ===
--------------------

1. Sign into your WordPress dashboard, go to Appearance > Themes, and click Add New.
2. Click Add New.
3. Click Upload.
4. Click Choose File and select the theme zip file.
5. Click Install Now.
6. Click Add New, then click Upload, then click Choose File.
7. After WordPress installs the theme, click Activate.
8. You've successfully installed your new theme!


--------------------
=== Licenses ===
--------------------

-- Fonts.
*
*  Merriweather / by Sorkin Type.
*  URL: https://fonts.google.com/specimen/Merriweather
*  License: Open Font License / http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL_web
*
*  Source Sans Pro / by Paul D. Hunt.
*  URL: https://fonts.google.com/specimen/Source%20Sans%20Pro
*  License: Open Font License / http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL_web
*
*  Genericons / by Automattic.
*  URL: http://genericons.com/
*  License: GNU GPL License 2.0 / https://www.gnu.org/licenses/gpl-2.0.html
*

-- Images.
*
*  The images on the theme screenshot are based on pictures from Arto Marttinen.
*  URL: https://unsplash.com/@whiteboytravels
*  Licensed: CC0 / http://creativecommons.org/publicdomain/zero/1.0/
*

-- Other.
*
*  Based on Underscores, Copyright (C) 2012-2017 Automattic, Inc.
*  URL: http://underscores.me/
*  License: GNU GPL License 2.0 [or later] / https://www.gnu.org/licenses/gpl-2.0.html
*
*  Normalize.css, Copyright (C) 2012-2017 Nicolas Gallagher and Jonathan Neal.
*  URL: http://necolas.github.io/normalize.css/
*  License: MIT License / http://opensource.org/licenses/MIT
*
*  Waves.js, Copyright (C) 2014-2017 Alfiana E. Sibuea.
*  URL: http://fian.my.id/Waves/
*  License: MIT License / http://opensource.org/licenses/MIT
*


--------------------
=== Issues ===
--------------------

1. Weird color flickering when hovering over social icons in Safari 10.0.3 (works fine in Chrome, FireFox and Opera).
2. Strange transition in menu lines animation in Safari (again, works fine in Chrome, FireFox and Opera).
3. Erratic behaviour of developer (that's me) after discovering these "bugs".


--------------------
=== Changelog ===
--------------------

*
* 1.0.1 / 19.03.2016
* - Replaced 'alt' => get_the_title() with 'alt' => the_title_attribute( 'echo=0' ) in template-tags.php.
* - Changed "date( 'Y' )"" to date_i18n( __( 'Y', 'bookmark' ) )" in site-info.php.
* - Removed rtl.css in the document root folder.
* - Added copyright for waves.js in the readme file.
* - Moved "Comments are closed." message in comments.php down a few lines to a more logical location.
* - Accessibility fix: clicking back-to-top button moves focus to the top of the site.
* - Header overlay colors and the link color can now be customized.
* - Fixed content width for search results.
* - Set "default-text-color" for header text color.
*
* 1.0.0 / 26.11.2016
* - Changed theme URI to: https://michaelvandenberg.com/themes/#bookmark
* - Optimized screenshot.png (reduced file size by 79%).
* - Added sidebar to search, 404 and not-found pages.
* - Fixed content width of search, 404 and not-found pages.
* - Fixed title width of pages listed above, and the archives.
* - Fixed color of search field and search submit in widgets and pages.
* - Fixed accessibility issues. This theme should pass the accessibility review.
*
* 0.9.1 / 01.10.2016
* - Fixed issue with sidebar not appearing on pages.
* - Fixed page styling issues.
* - Added full width page template.
* - Tweaked font height for smaller screens.
* - And some more minor tweaks to the scss/css.
*
* 0.9.0 / 30.09.2016
* Initial (early) release.
*
