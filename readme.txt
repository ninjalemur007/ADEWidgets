=== ADE Homepage Settings Plugin ===
Contributors: C. Walley, Arizona Department of Education
Version:
Updated:

== Development Log ==

= May 23, 2017 =
  * Blog Corner sections (4 [boxwidget]) created and styled, along with blog_corner_menu page

= May 22, 2017 =
  * [headlines] widget created
  * Page template for ADE homepage created and styled for existing widgets
  * Admin screen for [headlines] created

= May 17, 2017 =
  * Managed to get multiple sliders on same page to work by moving the post_query function outside the shortcoded functions
  * Refined styles for [features] and [announcements]


= May 16, 2017 =
  * added if is_admin and pushed output functions to output.php
  * created features_widget() and [features] to wrap and call features widget via output.php
  * styled features_widget
  * integrated jQuery content slider 'bxSlider' (bxslider.com by Steven Wanderski)
  * added announcements_menu page settings

  Notes
    - [features] and [announcements] work independently, but not on same page

= May 15, 2017 =
  * can now show titles of current posts on features admin screen
  * added Post ID Lookup menu page to pull up list of posts with their IDs for selected blog
  * roughed out the features-query page template query and added as page template to ADETheme2016 (for testing)

= May 13, 2017 =
  * wp-admin.css successfully loading via native action admin_enqueue_scripts
  * ade16_homepage_menu successfully creates admin menu item ADE Homepage Settings and subitems Features and Announcements
  * ade16_features_init successfully registers features_post_1 section and fields
  * features_post_1_callback successfully posts and gets values from database
    - built blog select menu populated with list of all subsites
  * features_menu_output successfully outputs features settings and callback

  Notes
    - experimented with ajax to dynamically retrieve list of blog posts based on selected blog, but determined would be too unwieldy and require too many posts/page reloads

++++ To-Do List ++++
  > Populate all menu pages and fields
  > Create query to return name of current post (not new choice)
  > Create query using settings as arguments
  > Output query into shortcoded display widget
  > Style display widget, including working sliders

#### Plugin Concept ####
  ADE homepage will include various content widgets populated by blog posts originally published on various ADE subsites. Each widget's blog posts will be indicated via menu pages with settings or options inputs.
  Queries will run based on settings.

  >> TO DECIDE >>
    - Hardwire the settings page to the homepage template?
    - Create shortcodes that can also be used to embed posts elsewhere?
    - Truly widgetize code so can add similar widgets in other pages and sites?
    - Create way for person to recommend post for homepage inclusion, with link, blog name and post id sent to editor for easy input
