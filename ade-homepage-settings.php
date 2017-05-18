<?php
/*
Plugin Name: ADE Homepage Plugin
Author: C. Walley
Version: 1.0
Text Domain: ade16
*/


/* ---------------------------------------------------------- *
 * GLOBAL CONSTANTS
 * ---------------------------------------------------------- */
 $originalblogid = get_current_blog_id(); // get current blog ID before entering function


/* ---------------------------------------------------------- *
 * CALL ADMIN OR OUTPUT HALF OF PLUGIN
 * ---------------------------------------------------------- */
if ( ! is_admin() ) {
  output_half();
} else {


/* ---------------------------------------------------------- *
 * ADMIN HALF OF PLUGIN
 * ---------------------------------------------------------- */


  /* ---------------------------------------------------------- *
   * ENQUEUE STYLES and SCRIPTS
   * ---------------------------------------------------------- */
   function ade_homepage_admin_stuff() {
      wp_register_style( 'ade-homepage-admin-style', plugins_url('ade-homepage/wp-admin.css' ) );
      wp_enqueue_style( 'ade-homepage-admin-style' );
  }
    add_action( 'admin_enqueue_scripts', 'ade_homepage_admin_stuff'  );


  /* ---------------------------------------------------------- *
   * ADMIN MENU PAGES -- FUNCTIONS
   * ---------------------------------------------------------- */

   function ade16_homepage_menu() {
      add_menu_page(
        'ADE Homepage Settings', //page title '$page_title'
        'ADE Homepage', // title in menu bar '$menu_title'
        'administrator', // permissions level '$capability'
        'ade_homepage_menu', // slug for menu '$menu_slug'
        'ade_homepage_menu_output', // function to call  '$function' - outputs content for this menu page
        'dashicons-smiley', // icon
        4 //position in dashboard menu
      );
      add_submenu_page( //Featured Posts as first submenu item
        'ade_homepage_menu', // slug for parent menu '$parent_slug'
        'ADE Homepage Featured Posts Settings', // page title for tags '$page_title'
        'Features', // menu title '$menu_title'
        'administrator', // permissions level '$capability'
        'features_menu', // slug for menu '$menu_slug'  --> $menu_page_slug
        'features_menu_output' // function to call to output page content '$function'
      );
      add_submenu_page( //Announcements
        'ade_homepage_menu', //top-menu slug
        'ADE Homepage Announcements Settings', // title in menu
        'Announcements', // page title
        'administrator', // permissions level
        'announcements_menu', // slug for menu
        'announcements_menu_output'  // function to call
      );
      add_submenu_page( //Post ID Lookup
        'ade_homepage_menu', //top-menu slug
        'Posts Lookup', // title in menu
        'Post ID Lookup', // page title
        'administrator', // permissions level
        'post_id_menu', // slug for menu
        'post_id_menu_output'  // function to call
      );
    } //end function ade16_homepage_menu

  add_action('admin_menu', 'ade16_homepage_menu' );

  /* ---------------------------------------------------------- *
   * SETTINGS FIELDS - FEATURES
   * ---------------------------------------------------------- */

  function ade16_features_init(){

/*** FEATURES PAGE ***/

      //register the below settings
      register_setting(
        'features_settings',
        'features_settings'
      );  // JUST KEEP THESE THE SAME

   // FEATURES POST 1
      // Page = Features, Section = Post 1
        add_settings_section(
          'features_post_1', //$id -- slug used in settings fields  - $section_slug
          'Post 1', // readable title on screen
          'features_post_1_callback', // function that echos content under Title
          'features_menu' //  $menu_page_slug / slug name of the settings page to show section
        );

      //Page = Features, Section = Post 1, Field = Select Blog
        add_settings_field(
          'ade16_features_1_1', //ID with ade16_ prefix
          'Select Blog', // field title
          'ade16_features_1_1_callback',  //field callback function
          'features_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
          'features_post_1' // get this from add_settings_section  $section_slug,
        );

      //Page = Features, Section = Post 1, Field = Select Post
        add_settings_field(
          'ade16_features_1_2', //ID with ade16_ prefix
          'Enter Post ID', // field title
          'ade16_features_1_2_callback',  //field callback function
          'features_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
          'features_post_1' // get this from add_settings_section  $section_slug,
        );

    // FEATURES POST 2
       // Page = Features, Section = Post 2
         add_settings_section(
           'features_post_2', //$id -- slug used in settings fields  - $section_slug
           'Post 2', // readable title on screen
           'features_post_2_callback', // function that echos content under Title
           'features_menu' //  $menu_page_slug / slug name of the settings page to show section
         );

       //Page = Features, Section = Post 1, Field = Select Blog
         add_settings_field(
           'ade16_features_2_1', //ID with ade16_ prefix
           'Select Blog', // field title
           'ade16_features_2_1_callback',  //field callback function
           'features_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
           'features_post_2' // get this from add_settings_section  $section_slug,
         );

       //Page = Features, Section = Post 1, Field = Select Post
         add_settings_field(
           'ade16_features_2_2', //ID with ade16_ prefix
           'Enter Post ID', // field title
           'ade16_features_2_2_callback',  //field callback function
           'features_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
           'features_post_2' // get this from add_settings_section  $section_slug,
         );

     // FEATURES POST 3
        // Page = Features, Section = Post 3
          add_settings_section(
            'features_post_3', //$id -- slug used in settings fields  - $section_slug
            'Post 3', // readable title on screen
            'features_post_3_callback', // function that echos content under Title
            'features_menu' //  $menu_page_slug / slug name of the settings page to show section
          );

        //Page = Features, Section = Post 3, Field = Select Blog
          add_settings_field(
            'ade16_features_3_1', //ID with ade16_ prefix
            'Select Blog', // field title
            'ade16_features_3_1_callback',  //field callback function
            'features_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
            'features_post_3' // get this from add_settings_section  $section_slug,
          );

        //Page = Features, Section = Post 1, Field = Select Post
          add_settings_field(
            'ade16_features_3_2', //ID with ade16_ prefix
            'Enter Post ID', // field title
            'ade16_features_3_2_callback',  //field callback function
            'features_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
            'features_post_3' // get this from add_settings_section  $section_slug,
          );

    // FEATURES POST 4
       // Page = Features, Section = Post 4
         add_settings_section(
           'features_post_4', //$id -- slug used in settings fields  - $section_slug
           'Post 4', // readable title on screen
           'features_post_4_callback', // function that echos content under Title
           'features_menu' //  $menu_page_slug / slug name of the settings page to show section
         );

       //Page = Features, Section = Post 4, Field = Select Blog
         add_settings_field(
           'ade16_features_4_1', //ID with ade16_ prefix
           'Select Blog', // field title
           'ade16_features_4_1_callback',  //field callback function
           'features_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
           'features_post_4' // get this from add_settings_section  $section_slug,
         );

       //Page = Features, Section = Post 4, Field = Select Post
         add_settings_field(
           'ade16_features_4_2', //ID with ade16_ prefix
           'Enter Post ID', // field title
           'ade16_features_4_2_callback',  //field callback function
           'features_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
           'features_post_4' // get this from add_settings_section  $section_slug,
         );

 /*** ANNOUNCEMENTS PAGE ***/

        //register the below settings
       register_setting(
         'announcements_settings',
         'announcements_settings'
       );  // JUST KEEP THESE THE SAME

    // ANNOUNCEMENTS POST 1
       // Page = Announcements, Section = Post 1
         add_settings_section(
           'announcements_post_1', //$id -- slug used in settings fields  - $section_slug
           'Post 1', // readable title on screen
           'announcements_post_1_callback', // function that echos content under Title
           'announcements_menu' //  $menu_page_slug / slug name of the settings page to show section
         );

       //Page = Announcements, Section = Post 1, Field = Select Blog
         add_settings_field(
           'ade16_announcements_1_1', //ID with ade16_ prefix
           'Select Blog', // field title
           'ade16_announcements_1_1_callback',  //field callback function
           'announcements_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
           'announcements_post_1' // get this from add_settings_section  $section_slug,
         );

       //Page = Announcements, Section = Post 1, Field = Select Post
         add_settings_field(
           'ade16_announcements_1_2', //ID with ade16_ prefix
           'Enter Post ID', // field title
           'ade16_announcements_1_2_callback',  //field callback function
           'announcements_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
           'announcements_post_1' // get this from add_settings_section  $section_slug,
         );

     // ANNOUNCEMENTS POST 2
        // Page = Announcements, Section = Post 2
          add_settings_section(
            'announcements_post_2', //$id -- slug used in settings fields  - $section_slug
            'Post 2', // readable title on screen
            'announcements_post_2_callback', // function that echos content under Title
            'announcements_menu' //  $menu_page_slug / slug name of the settings page to show section
          );

        //Page = Announcements, Section = Post 1, Field = Select Blog
          add_settings_field(
            'ade16_announcements_2_1', //ID with ade16_ prefix
            'Select Blog', // field title
            'ade16_announcements_2_1_callback',  //field callback function
            'announcements_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
            'announcements_post_2' // get this from add_settings_section  $section_slug,
          );

        //Page = Announcements, Section = Post 1, Field = Select Post
          add_settings_field(
            'ade16_announcements_2_2', //ID with ade16_ prefix
            'Enter Post ID', // field title
            'ade16_announcements_2_2_callback',  //field callback function
            'announcements_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
            'announcements_post_2' // get this from add_settings_section  $section_slug,
          );

      // ANNOUNCEMENTS POST 3
         // Page = Announcements, Section = Post 3
           add_settings_section(
             'announcements_post_3', //$id -- slug used in settings fields  - $section_slug
             'Post 3', // readable title on screen
             'announcements_post_3_callback', // function that echos content under Title
             'announcements_menu' //  $menu_page_slug / slug name of the settings page to show section
           );

         //Page = Announcements, Section = Post 3, Field = Select Blog
           add_settings_field(
             'ade16_announcements_3_1', //ID with ade16_ prefix
             'Select Blog', // field title
             'ade16_announcements_3_1_callback',  //field callback function
             'announcements_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
             'announcements_post_3' // get this from add_settings_section  $section_slug,
           );

         //Page = Announcements, Section = Post 1, Field = Select Post
           add_settings_field(
             'ade16_announcements_3_2', //ID with ade16_ prefix
             'Enter Post ID', // field title
             'ade16_announcements_3_2_callback',  //field callback function
             'announcements_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
             'announcements_post_3' // get this from add_settings_section  $section_slug,
           );

     // ANNOUNCEMENTS POST 4
        // Page = Announcements, Section = Post 4
          add_settings_section(
            'announcements_post_4', //$id -- slug used in settings fields  - $section_slug
            'Post 4', // readable title on screen
            'announcements_post_4_callback', // function that echos content under Title
            'announcements_menu' //  $menu_page_slug / slug name of the settings page to show section
          );

        //Page = Announcements, Section = Post 4, Field = Select Blog
          add_settings_field(
            'ade16_announcements_4_1', //ID with ade16_ prefix
            'Select Blog', // field title
            'ade16_announcements_4_1_callback',  //field callback function
            'announcements_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
            'announcements_post_4' // get this from add_settings_section  $section_slug,
          );

        //Page = Announcements, Section = Post 4, Field = Select Post
          add_settings_field(
            'ade16_announcements_4_2', //ID with ade16_ prefix
            'Enter Post ID', // field title
            'ade16_announcements_4_2_callback',  //field callback function
            'announcements_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
            'announcements_post_4' // get this from add_settings_section  $section_slug,
          );


  /*** Post ID PAGE ***/

     //register the below settings
     register_setting(
       'post_id_settings',
       'post_id_settings'
     );  // JUST KEEP THESE THE SAME

  // POST ID Section
     // Page = Post ID Settings, Section = Post ID
       add_settings_section(
         'post_id_settings', //$id -- slug used in settings fields  - $section_slug
         'Select Blog', // readable title on screen
         'post_id_blog_callback', // function that echos content under Title
         'post_id_menu' //  $menu_page_slug / slug name of the settings page to show section
       );

     //Page = Post ID Settings, Section = Post ID, Field = Select Blog
       add_settings_field(
         'ade16_post_id_blog', //ID with ade16_ prefix
         'Select Blog', // field title
         'ade16_post_id_blog_callback',  //field callback function
         'post_id_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
         'post_id_settings' // get this from add_settings_section  $section_slug,
       );

     //Page = Post ID Settings, Section = Post ID, Field = List Posts
       add_settings_field(
         'ade16_post_id_list', //ID with ade16_ prefix
         'List Posts', // field title
         'ade16_post_id_list_callback',  //field callback function
         'post_id_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
         'post_id_settings' // get this from add_settings_section  $section_slug,
       );


  } // end function ade16_features_init

  add_action( 'admin_init', 'ade16_features_init' );



  /* ---------------------------------------------------------- *
   * CALLBACKS - FEATURES
   * ---------------------------------------------------------- */

  // FEATURES POST 1

    function features_post_1_callback() { //Post 1 section
      } //end features_post_1_callback()

    //Features - Post 1 Fields
      function ade16_features_1_1_callback() {
        //The way this function stores the blog name and id means that when this value is queried it will first need to be parsed to extract just the ID. The reason this function stores both name and id is to make the select field more user-friendly.
        $setting = (array) get_option( 'features_settings');
        $field = 'ade16_features_1_1';
        $value = esc_attr( $setting[$field] );

        $html = "<select id='ade16_features_post_1_blog_select' name='features_settings[$field]' class='choose-new'>";
        $html .= "<option id='no_blog' name='no_blog' value='no_blog'>Select Blog</option>";

        if( is_multisite() ) {
          $all_sites = get_sites();
          foreach($all_sites as $site) {
            $optval = $site->blogname . " (" . $site->blog_id . ")";
            $selected = ($optval === $value) ? 'selected="selected"' : '';
            $html .= '<option value="'.$optval.'" ' . $selected . '>'.$site->blogname.'</option>';
          }
        } else {
            $site = get_bloginfo( 'name');
            $html .= $site;
        }

        $html .= '</select>';
        $html .= "<span class='current-choice'>Current Blog:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class='boldtitle'>".$value."</span>";

          echo $html;

        } //end ade16_features_1_1_callback

      function ade16_features_1_2_callback() {
        //Simple post ID input box -- waaaayyyy too difficult to create a dropdown to select posts based on blog change in post's blog selection field

        //get stored value for ade16_features_1_2
          $setting = (array) get_option( 'features_settings');

          $blog = 'ade16_features_1_1'; //get current blog setting
          $blog = esc_attr( $setting[$blog] );  //get current blog setting value

          $blog = strchr($blog, "(", false); //parse string for post ID
          $blog = strchr($blog, ")", true); //parse again
          $blog = ltrim($blog, '(' ); //parse again

          $current_post_field = 'ade16_features_1_2'; //get current post setting
          $current_post = esc_attr( $setting[$current_post_field] ); //get current post setting value

          //////// Query to get the current post's title
            global $originalblogid; //call global variable

            if ( is_multisite() ) {
              if ( strlen($blog) > 0 && $blog !== $originalblogid) {
                  $blog_id = $blog; //if so, then make that the blog_id
                } else {
                  $blog_id = $originalblogid;
                }
              switch_to_blog ($blog_id); // select correct blog, whether current or other
            }

            $current_post_object = get_post( $current_post, ARRAY_A );
            $current_post_title = $current_post_object['post_title'];

            if( is_multisite() ) {
              switch_to_blog ($originalblogid);
            }
          //end query

          $html = "<input type='text' name='features_settings[$current_post_field]' value='$current_post'  class='choose-new'/>";
          $html .= "<span class='current-choice'>Current Post: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='boldtitle'>".$current_post_title."</span>  (ID = ".$current_post.")";
          echo $html;
        } //end ade16_features_1_2_callback

  // FEATURES POST 2

    function features_post_2_callback() { //Post 2 section
    } //end features_post_2_callback()

    //Features - Post 2 Fields
      function ade16_features_2_1_callback() {
        //The way this function stores the blog name and id means that when this value is queried it will first need to be parsed to extract just the ID. The reason this function stores both name and id is to make the select field more user-friendly.
        $setting = (array) get_option( 'features_settings');
        $field = 'ade16_features_2_1';
        $value = esc_attr( $setting[$field] );
          $html = "<select id='ade16_features_post_2_blog_select' name='features_settings[$field]' class='choose-new'>";
          $html .= "<option id='no_blog' name='no_blog' value='no_blog'>Select Blog</option>";
          if( is_multisite() ) {
            $all_sites = get_sites();
            foreach($all_sites as $site) {
              $optval = $site->blogname . " (" . $site->blog_id . ")";
              $selected = ($optval === $value) ? 'selected="selected"' : '';
              $html .= '<option value="'.$optval.'" ' . $selected . '>'.$site->blogname.'</option>';
            }
          } else {
              $site = get_bloginfo( 'name');
              $html .= $site;
          }
          $html .= '</select>';
          $html .= "<span class='current-choice'>Current Blog:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class='boldtitle'>".$value."</span>";
          echo $html;

        } //end ade16_features_2_1_callback

      function ade16_features_2_2_callback() {
        //Simple post ID input box -- waaaayyyy too difficult to create a dropdown to select posts based on blog change in post's blog selection field

        //get stored value for ade16_features_2_2
          $setting = (array) get_option( 'features_settings');

          $blog = 'ade16_features_2_1'; //get current blog setting
          $blog = esc_attr( $setting[$blog] );  //get current blog setting value

          $blog = strchr($blog, "(", false); //parse string for post ID
          $blog = strchr($blog, ")", true); //parse again
          $blog = ltrim($blog, '(' ); //parse again

          $current_post_field = 'ade16_features_2_2'; //get current post setting
          $current_post = esc_attr( $setting[$current_post_field] ); //get current post setting value

          //////// Query to get the current post's title
            global $originalblogid; //call global variable
            if ( is_multisite() ) {
              if ( strlen($blog) > 0 && $blog !== $originalblogid) {
                  $blog_id = $blog; //if so, then make that the blog_id
                } else {
                  $blog_id = $originalblogid;
                }
              switch_to_blog ($blog_id); // select correct blog, whether current or other
            }

            $current_post_object = get_post( $current_post, ARRAY_A );
            $current_post_title = $current_post_object['post_title'];

            if( is_multisite() ) {
              switch_to_blog ($originalblogid);
            }
          //end query

          $html = "<input type='text' name='features_settings[$current_post_field]' value='$current_post'  class='choose-new'/>";
          $html .= "<span class='current-choice'>Current Post: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='boldtitle'>".$current_post_title."</span> (ID = ".$current_post.") ";
          echo $html;
        } //end ade16_features_2_2_callback

  // FEATURES POST 3

    function features_post_3_callback() { //Post 3 section
    } //end features_post_3_callback()

    //Features - Post 2 Fields
      function ade16_features_3_1_callback() {
        //The way this function stores the blog name and id means that when this value is queried it will first need to be parsed to extract just the ID. The reason this function stores both name and id is to make the select field more user-friendly.
        $setting = (array) get_option( 'features_settings');
        $field = 'ade16_features_3_1';
        $value = esc_attr( $setting[$field] );
          $html = "<select id='ade16_features_post_3_blog_select' name='features_settings[$field]' class='choose-new'>";
          $html .= "<option id='no_blog' name='no_blog' value='no_blog'>Select Blog</option>";
          if( is_multisite() ) {
            $all_sites = get_sites();
            foreach($all_sites as $site) {
              $optval = $site->blogname . " (" . $site->blog_id . ")";
              $selected = ($optval === $value) ? 'selected="selected"' : '';
              $html .= '<option value="'.$optval.'" ' . $selected . '>'.$site->blogname.'</option>';
            }
          } else {
              $site = get_bloginfo( 'name');
              $html .= $site;
          }
          $html .= '</select>';
          $html .= "<span class='current-choice'>Current Blog:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class='boldtitle'>".$value."</span>";
          echo $html;

        } //end ade16_features_3_1_callback

      function ade16_features_3_2_callback() {
        //Simple post ID input box -- waaaayyyy too difficult to create a dropdown to select posts based on blog change in post's blog selection field

        //get stored value for ade16_features_3_2
          $setting = (array) get_option( 'features_settings');

          $blog = 'ade16_features_3_1'; //get current blog setting
          $blog = esc_attr( $setting[$blog] );  //get current blog setting value

          $blog = strchr($blog, "(", false); //parse string for post ID
          $blog = strchr($blog, ")", true); //parse again
          $blog = ltrim($blog, '(' ); //parse again

          $current_post_field = 'ade16_features_3_2'; //get current post setting
          $current_post = esc_attr( $setting[$current_post_field] ); //get current post setting value

          //////// Query to get the current post's title
            global $originalblogid; //call global variable
            if ( is_multisite() ) {
              if ( strlen($blog) > 0 && $blog !== $originalblogid) {
                  $blog_id = $blog; //if so, then make that the blog_id
                } else {
                  $blog_id = $originalblogid;
                }
              switch_to_blog ($blog_id); // select correct blog, whether current or other
            }

            $current_post_object = get_post( $current_post, ARRAY_A );
            $current_post_title = $current_post_object['post_title'];

            if( is_multisite() ) {
              switch_to_blog ($originalblogid);
            }
          //end query

          $html = "<input type='text' name='features_settings[$current_post_field]' value='$current_post'  class='choose-new'/>";
          $html .= "<span class='current-choice'>Current Post: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='boldtitle'>".$current_post_title."</span> (ID = ".$current_post.") ";
          echo $html;
        } //end ade16_features_3_2_callback

  // FEATURES POST 4

    function features_post_4_callback() { //Post 4 section
    } //end features_post_4_callback()

    //Features - Post 2 Fields
      function ade16_features_4_1_callback() {
        //The way this function stores the blog name and id means that when this value is queried it will first need to be parsed to extract just the ID. The reason this function stores both name and id is to make the select field more user-friendly.
        $setting = (array) get_option( 'features_settings');
        $field = 'ade16_features_4_1';
        $value = esc_attr( $setting[$field] );
          $html = "<select id='ade16_features_post_4_blog_select' name='features_settings[$field]' class='choose-new'>";
          $html .= "<option id='no_blog' name='no_blog' value='no_blog'>Select Blog</option>";
          if( is_multisite() ) {
            $all_sites = get_sites();
            foreach($all_sites as $site) {
              $optval = $site->blogname . " (" . $site->blog_id . ")";
              $selected = ($optval === $value) ? 'selected="selected"' : '';
              $html .= '<option value="'.$optval.'" ' . $selected . '>'.$site->blogname.'</option>';
            }
          } else {
              $site = get_bloginfo( 'name');
              $html .= $site;
          }
          $html .= '</select>';
          $html .= "<span class='current-choice'>Current Blog:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class='boldtitle'>".$value."</span>";
          echo $html;

        } //end ade16_features_4_1_callback

      function ade16_features_4_2_callback() {
        //Simple post ID input box -- waaaayyyy too difficult to create a dropdown to select posts based on blog change in post's blog selection field

        //get stored value for ade16_features_4_2
          $setting = (array) get_option( 'features_settings');

          $blog = 'ade16_features_4_1'; //get current blog setting
          $blog = esc_attr( $setting[$blog] );  //get current blog setting value

          $blog = strchr($blog, "(", false); //parse string for post ID
          $blog = strchr($blog, ")", true); //parse again
          $blog = ltrim($blog, '(' ); //parse again

          $current_post_field = 'ade16_features_4_2'; //get current post setting
          $current_post = esc_attr( $setting[$current_post_field] ); //get current post setting value

          //////// Query to get the current post's title
            global $originalblogid; //call global variable
            if ( is_multisite() ) {
              if ( strlen($blog) > 0 && $blog !== $originalblogid) {
                  $blog_id = $blog; //if so, then make that the blog_id
                } else {
                  $blog_id = $originalblogid;
                }
              switch_to_blog ($blog_id); // select correct blog, whether current or other
            }

            $current_post_object = get_post( $current_post, ARRAY_A );
            $current_post_title = $current_post_object['post_title'];

            if( is_multisite() ) {
              switch_to_blog ($originalblogid);
            }
          //end query

          $html = "<input type='text' name='features_settings[$current_post_field]' value='$current_post'  class='choose-new'/>";
          $html .= "<span class='current-choice'>Current Post: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='boldtitle'>".$current_post_title."</span> (ID = ".$current_post.") ";
          echo $html;
        } //end ade16_features_4_2_callback


  /* ---------------------------------------------------------- *
   * CALLBACKS - ANNOUNCEMENTS
   * ---------------------------------------------------------- */

  // ANNOUNCEMENTS POST 1

    function announcements_post_1_callback() { //Post 1 section
      } //end announcements_post_1_callback()

    //Features - Post 1 Fields
      function ade16_announcements_1_1_callback() {
        //The way this function stores the blog name and id means that when this value is queried it will first need to be parsed to extract just the ID. The reason this function stores both name and id is to make the select field more user-friendly.
        $setting = (array) get_option( 'announcements_settings');
        $field = 'ade16_announcements_1_1';
        $value = esc_attr( $setting[$field] );

        $html = "<select id='post_1_blog_select' name='announcements_settings[$field]' class='choose-new'>";
        $html .= "<option id='no_blog' name='no_blog' value='no_blog'>Select Blog</option>";

        if( is_multisite() ) {
          $all_sites = get_sites();
          foreach($all_sites as $site) {
            $optval = $site->blogname . " (" . $site->blog_id . ")";
            $selected = ($optval === $value) ? 'selected="selected"' : '';
            $html .= '<option value="'.$optval.'" ' . $selected . '>'.$site->blogname.'</option>';
          }
        } else {
            $site = get_bloginfo( 'name');
            $html .= $site;
        }

        $html .= '</select>';
        $html .= "<span class='current-choice'>Current Blog:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class='boldtitle'>".$value."</span>";

          echo $html;

        } //end ade16_announcements_1_1_callback

      function ade16_announcements_1_2_callback() {
        //Simple post ID input box -- waaaayyyy too difficult to create a dropdown to select posts based on blog change in post's blog selection field

        //get stored value for ade16_announcements_1_2
          $setting = (array) get_option( 'announcements_settings');

          $blog = 'ade16_announcements_1_1'; //get current blog setting
          $blog = esc_attr( $setting[$blog] );  //get current blog setting value

          $blog = strchr($blog, "(", false); //parse string for post ID
          $blog = strchr($blog, ")", true); //parse again
          $blog = ltrim($blog, '(' ); //parse again

          $current_post_field = 'ade16_announcements_1_2'; //get current post setting
          $current_post = esc_attr( $setting[$current_post_field] ); //get current post setting value

          //////// Query to get the current post's title
            global $originalblogid; //call global variable

            if ( is_multisite() ) {
              if ( strlen($blog) > 0 && $blog !== $originalblogid) {
                  $blog_id = $blog; //if so, then make that the blog_id
                } else {
                  $blog_id = $originalblogid;
                }
              switch_to_blog ($blog_id); // select correct blog, whether current or other
            }

            $current_post_object = get_post( $current_post, ARRAY_A );
            $current_post_title = $current_post_object['post_title'];

            if( is_multisite() ) {
              switch_to_blog ($originalblogid);
            }
          //end query

          $html = "<input type='text' name='announcements_settings[$current_post_field]' value='$current_post'  class='choose-new'/>";
          $html .= "<span class='current-choice'>Current Post: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='boldtitle'>".$current_post_title."</span>  (ID = ".$current_post.")";
          echo $html;
        } //end ade16_announcements_1_2_callback

  // ANNOUNCEMENTS POST 2

    function announcements_post_2_callback() { //Post 2 section
    } //end announcements_post_2_callback()

    //Features - Post 2 Fields
      function ade16_announcements_2_1_callback() {
        //The way this function stores the blog name and id means that when this value is queried it will first need to be parsed to extract just the ID. The reason this function stores both name and id is to make the select field more user-friendly.
        $setting = (array) get_option( 'announcements_settings');
        $field = 'ade16_announcements_2_1';
        $value = esc_attr( $setting[$field] );
          $html = "<select id='post_2_blog_select' name='announcements_settings[$field]' class='choose-new'>";
          $html .= "<option id='no_blog' name='no_blog' value='no_blog'>Select Blog</option>";
          if( is_multisite() ) {
            $all_sites = get_sites();
            foreach($all_sites as $site) {
              $optval = $site->blogname . " (" . $site->blog_id . ")";
              $selected = ($optval === $value) ? 'selected="selected"' : '';
              $html .= '<option value="'.$optval.'" ' . $selected . '>'.$site->blogname.'</option>';
            }
          } else {
              $site = get_bloginfo( 'name');
              $html .= $site;
          }
          $html .= '</select>';
          $html .= "<span class='current-choice'>Current Blog:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class='boldtitle'>".$value."</span>";
          echo $html;

        } //end ade16_announcements_2_1_callback

      function ade16_announcements_2_2_callback() {
        //Simple post ID input box -- waaaayyyy too difficult to create a dropdown to select posts based on blog change in post's blog selection field

        //get stored value for ade16_announcements_2_2
          $setting = (array) get_option( 'announcements_settings');

          $blog = 'ade16_announcements_2_1'; //get current blog setting
          $blog = esc_attr( $setting[$blog] );  //get current blog setting value

          $blog = strchr($blog, "(", false); //parse string for post ID
          $blog = strchr($blog, ")", true); //parse again
          $blog = ltrim($blog, '(' ); //parse again

          $current_post_field = 'ade16_announcements_2_2'; //get current post setting
          $current_post = esc_attr( $setting[$current_post_field] ); //get current post setting value

          //////// Query to get the current post's title
            global $originalblogid; //call global variable
            if ( is_multisite() ) {
              if ( strlen($blog) > 0 && $blog !== $originalblogid) {
                  $blog_id = $blog; //if so, then make that the blog_id
                } else {
                  $blog_id = $originalblogid;
                }
              switch_to_blog ($blog_id); // select correct blog, whether current or other
            }

            $current_post_object = get_post( $current_post, ARRAY_A );
            $current_post_title = $current_post_object['post_title'];

            if( is_multisite() ) {
              switch_to_blog ($originalblogid);
            }
          //end query

          $html = "<input type='text' name='announcements_settings[$current_post_field]' value='$current_post'  class='choose-new'/>";
          $html .= "<span class='current-choice'>Current Post: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='boldtitle'>".$current_post_title."</span> (ID = ".$current_post.") ";
          echo $html;
        } //end ade16_announcements_2_2_callback

  // ANNOUNCEMENTS POST 3

    function announcements_post_3_callback() { //Post 3 section
    } //end announcements_post_3_callback()

    //Features - Post 2 Fields
      function ade16_announcements_3_1_callback() {
        //The way this function stores the blog name and id means that when this value is queried it will first need to be parsed to extract just the ID. The reason this function stores both name and id is to make the select field more user-friendly.
        $setting = (array) get_option( 'announcements_settings');
        $field = 'ade16_announcements_3_1';
        $value = esc_attr( $setting[$field] );
          $html = "<select id='post_3_blog_select' name='announcements_settings[$field]' class='choose-new'>";
          $html .= "<option id='no_blog' name='no_blog' value='no_blog'>Select Blog</option>";
          if( is_multisite() ) {
            $all_sites = get_sites();
            foreach($all_sites as $site) {
              $optval = $site->blogname . " (" . $site->blog_id . ")";
              $selected = ($optval === $value) ? 'selected="selected"' : '';
              $html .= '<option value="'.$optval.'" ' . $selected . '>'.$site->blogname.'</option>';
            }
          } else {
              $site = get_bloginfo( 'name');
              $html .= $site;
          }
          $html .= '</select>';
          $html .= "<span class='current-choice'>Current Blog:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class='boldtitle'>".$value."</span>";
          echo $html;

        } //end ade16_announcements_3_1_callback

      function ade16_announcements_3_2_callback() {
        //Simple post ID input box -- waaaayyyy too difficult to create a dropdown to select posts based on blog change in post's blog selection field

        //get stored value for ade16_announcements_3_2
          $setting = (array) get_option( 'announcements_settings');

          $blog = 'ade16_announcements_3_1'; //get current blog setting
          $blog = esc_attr( $setting[$blog] );  //get current blog setting value

          $blog = strchr($blog, "(", false); //parse string for post ID
          $blog = strchr($blog, ")", true); //parse again
          $blog = ltrim($blog, '(' ); //parse again

          $current_post_field = 'ade16_announcements_3_2'; //get current post setting
          $current_post = esc_attr( $setting[$current_post_field] ); //get current post setting value

          //////// Query to get the current post's title
            global $originalblogid; //call global variable
            if ( is_multisite() ) {
              if ( strlen($blog) > 0 && $blog !== $originalblogid) {
                  $blog_id = $blog; //if so, then make that the blog_id
                } else {
                  $blog_id = $originalblogid;
                }
              switch_to_blog ($blog_id); // select correct blog, whether current or other
            }

            $current_post_object = get_post( $current_post, ARRAY_A );
            $current_post_title = $current_post_object['post_title'];

            if( is_multisite() ) {
              switch_to_blog ($originalblogid);
            }
          //end query

          $html = "<input type='text' name='announcements_settings[$current_post_field]' value='$current_post'  class='choose-new'/>";
          $html .= "<span class='current-choice'>Current Post: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='boldtitle'>".$current_post_title."</span> (ID = ".$current_post.") ";
          echo $html;
        } //end ade16_announcements_3_2_callback

  // ANNOUNCEMENTS POST 4

    function announcements_post_4_callback() { //Post 4 section
    } //end announcements_post_4_callback()

    //Features - Post 2 Fields
      function ade16_announcements_4_1_callback() {
        //The way this function stores the blog name and id means that when this value is queried it will first need to be parsed to extract just the ID. The reason this function stores both name and id is to make the select field more user-friendly.
        $setting = (array) get_option( 'announcements_settings');
        $field = 'ade16_announcements_4_1';
        $value = esc_attr( $setting[$field] );
          $html = "<select id='post_4_blog_select' name='announcements_settings[$field]' class='choose-new'>";
          $html .= "<option id='no_blog' name='no_blog' value='no_blog'>Select Blog</option>";
          if( is_multisite() ) {
            $all_sites = get_sites();
            foreach($all_sites as $site) {
              $optval = $site->blogname . " (" . $site->blog_id . ")";
              $selected = ($optval === $value) ? 'selected="selected"' : '';
              $html .= '<option value="'.$optval.'" ' . $selected . '>'.$site->blogname.'</option>';
            }
          } else {
              $site = get_bloginfo( 'name');
              $html .= $site;
          }
          $html .= '</select>';
          $html .= "<span class='current-choice'>Current Blog:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class='boldtitle'>".$value."</span>";
          echo $html;

        } //end ade16_announcements_4_1_callback

      function ade16_announcements_4_2_callback() {
        //Simple post ID input box -- waaaayyyy too difficult to create a dropdown to select posts based on blog change in post's blog selection field

        //get stored value for ade16_announcements_4_2
          $setting = (array) get_option( 'announcements_settings');

          $blog = 'ade16_announcements_4_1'; //get current blog setting
          $blog = esc_attr( $setting[$blog] );  //get current blog setting value

          $blog = strchr($blog, "(", false); //parse string for post ID
          $blog = strchr($blog, ")", true); //parse again
          $blog = ltrim($blog, '(' ); //parse again

          $current_post_field = 'ade16_announcements_4_2'; //get current post setting
          $current_post = esc_attr( $setting[$current_post_field] ); //get current post setting value

          //////// Query to get the current post's title
            global $originalblogid; //call global variable
            if ( is_multisite() ) {
              if ( strlen($blog) > 0 && $blog !== $originalblogid) {
                  $blog_id = $blog; //if so, then make that the blog_id
                } else {
                  $blog_id = $originalblogid;
                }
              switch_to_blog ($blog_id); // select correct blog, whether current or other
            }

            $current_post_object = get_post( $current_post, ARRAY_A );
            $current_post_title = $current_post_object['post_title'];

            if( is_multisite() ) {
              switch_to_blog ($originalblogid);
            }
          //end query

          $html = "<input type='text' name='announcements_settings[$current_post_field]' value='$current_post'  class='choose-new'/>";
          $html .= "<span class='current-choice'>Current Post: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='boldtitle'>".$current_post_title."</span> (ID = ".$current_post.") ";
          echo $html;
        } //end ade16_announcements_4_2_callback


  /* ---------------------------------------------------------- *
   * POST ID CALLBACKS
   * ---------------------------------------------------------- */
   function post_id_blog_callback() {
   }

   //
     function ade16_post_id_blog_callback() {
       $setting = (array) get_option( 'post_id_settings');
       $field = 'ade16_post_id_blog';

       $value = esc_attr( $setting[$field] );
         $html = "<select id='post_id_blog_select' name='post_id_settings[$field]' class='choose-new'>";
         $html .= "<option id='no_blog' name='no_blog' value='no_blog'>Select Blog</option>";
         if( is_multisite() ) {
           $all_sites = get_sites();
           foreach($all_sites as $site) {
             $optval = $site->blogname . " (" . $site->blog_id . ")";
             $selected = ($optval === $value) ? 'selected="selected"' : '';
             $html .= '<option value="'.$optval.'" ' . $selected . '>'.$site->blogname.'</option>';
           }
         } else {
             $site = get_bloginfo( 'name');
             $html .= $site;
         }
         $html .= '</select>';
         echo $html;
       } //end

     function ade16_post_id_list_callback() {
       $setting = (array) get_option( 'post_id_settings');
       $blog = 'ade16_post_id_blog';
       $blog = esc_attr( $setting[$blog] );  //get current blog setting value
       $blog = strchr($blog, "(", false); //parse string for post ID
       $blog = strchr($blog, ")", true); //parse again
       $blog = ltrim($blog, '(' ); //parse again
       ////// Query to get the posts
         global $originalblogid; //call global variable
         if ( is_multisite() ) {
           if ( strlen($blog) > 0 && $blog !== $originalblogid) {
               $blogid = $blog; //if so, then make that the blog_id
             } else {
               $blogid = $originalblogid;
             }
           switch_to_blog ($blogid); // select correct blog, whether current or other
         }

         $args = array (
           'orderby' => 'date',
           'order' => 'DESC',
           'post_status' => 'publish',
           'post_type' => 'post'
         );
         $postlist = get_posts( $args );
         if( $postlist ) {

           $html = '<table id="postslist"><tr><th>Post Title</th><th>Post ID</th></tr>';
           foreach ( $postlist as $post ) :
             setup_postdata( $post );
             $PID = $post->ID;
             $PT = $post->post_title;
             $html .= "<tr><td>".$PT."</td><td>".$PID."</td></tr>";
           endforeach;
           wp_reset_postdata();
           $html .= '</table>';
         }
         if( is_multisite() ) {
           switch_to_blog ($originalblogid);
         }
         echo $html;
     }


  /* ---------------------------------------------------------- *
   * PAGE OUTPUT - FEATURES
   * ---------------------------------------------------------- */

  function features_menu_output(){
  if  (!current_user_can('administrator')) { return; } //check user permissions
  ?>
  <div class="wrap">
  <h1><?php echo esc_html(get_admin_page_title() ); ?></h1>
  <p><em>The Features section of the homepage consists of 4 featured posts that rotate in the order listed below.</em></p>
  <p><em> <strong>Important: Post 1 will be the post seen when the homepage loads.</strong> </em></p>
  <p><em>Use the Post ID Lookup menu page to list posts for a blog. Use the post IDs from that list for the Enter Post ID field below.</em></p>
    <form method="post" action="options.php" id="features-form" >
      <?php
         settings_fields( 'features_settings' );
     ?>
      <?php
         do_settings_sections( 'features_menu' );
     ?>
      <?php submit_button('Save Settings'); ?>
    </form>
  </div>
  <?php
  }

  /* ---------------------------------------------------------- *
   * PAGE OUTPUT - ANNOUNCEMENTS
   * ---------------------------------------------------------- */

  function announcements_menu_output(){
  if  (!current_user_can('administrator')) { return; } //check user permissions
  ?>
  <div class="wrap">
  <h1><?php echo esc_html(get_admin_page_title() ); ?></h1>
  <p><em>The Announcements section of the homepage consists of 4  posts that rotate in the order listed below.</em></p>
  <p><em> <strong>Important: Post 1 will be the post seen when the homepage loads.</strong> </em></p>
  <p><em>Use the Post ID Lookup menu page to list posts for a blog. Use the post IDs from that list for the Enter Post ID field below.</em></p>
    <form method="post" action="options.php" id="announcements-form" >
      <?php
         settings_fields( 'announcements_settings' );
     ?>
      <?php
         do_settings_sections( 'announcements_menu' );
     ?>
      <?php submit_button('Save Settings'); ?>
    </form>
  </div>
  <?php
  }


  /* ---------------------------------------------------------- *
   * PAGE OUTPUT - Find Post ID
   * ---------------------------------------------------------- */

  function post_id_menu_output(){
  if  (!current_user_can('administrator')) { return; } //check user permissions
  ?>
  <div class="wrap">
  <h1><?php echo esc_html(get_admin_page_title() ); ?></h1>
  <p><em>Use this page to get list of all blog posts and their IDs for selected blog.</em></p>
  <form method="post" action="options.php" id="post-id-form" >
    <?php
       settings_fields( 'post_id_settings' );
   ?>
    <?php
       do_settings_sections( 'post_id_menu' );
   ?>
   <?php submit_button('List Posts'); ?>


  </form>
  </div>
  <?php
  }

} // END admin_half()



/* ---------------------------------------------------------------------------*/
/* ---------------------------------------------------------------------------*/
/* ---------------------------------------------------------------------------*/



/* ---------------------------------------------------------- *
 * OUTPUT HALF OF PLUGIN
 * ---------------------------------------------------------- */
function output_half(){

  /* ---------------------------------------------------------- *
   * ENQUEUE STYLES and SCRIPTS
   * ---------------------------------------------------------- */
   function ade_homepage_output_stuff() {
     wp_enqueue_style( 'ade-homepage-output-style', plugins_url('ade-homepage/output-styles.css' ) );
    wp_enqueue_style( 'boxslider-style', plugins_url('ade-homepage/jquery.bxslider/modified.jquery.bxslider.css' ) );
     wp_enqueue_script( 'output-scripts', plugins_url('ade-homepage/output-scripts.js') );
     wp_enqueue_script( 'boxslider-scripts' , plugins_url('ade-homepage/jquery.bxslider/jquery.bxslider.min.js') );
   }
   add_action( 'wp_enqueue_scripts', 'ade_homepage_output_stuff' );

  /* ---------------------------------------------------------- *
   * CALL OUTPUT FILE/FUNCTIONS
   * ---------------------------------------------------------- */
  // include 'features.php';
  // include 'announcements.php';
  include 'output-stuff.php';


} // END output_half()



?>
