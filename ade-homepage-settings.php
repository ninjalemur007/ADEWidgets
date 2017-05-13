<?php
/*
Plugin Name: ADE Homepage Plugin
Author: C. Walley
Version: 1.0
Text Domain: ade16
*/




/* ---------------------------------------------------------- *
 * ENQUEUE STYLES and SCRIPTS
 * ---------------------------------------------------------- */
 function ade16_homepage_admin_stuff() {
    wp_register_style( 'ade-homepage-admin-style', plugins_url('ade-homepage/admin-style.css' ) );
    wp_enqueue_style( 'ade-homepage-admin-style' );
}
  add_action( 'admin_enqueue_scripts', 'ade16_homepage_admin_stuff'  );


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

  } //end function ade16_homepage_menu

add_action('admin_menu', 'ade16_homepage_menu' );

/* ---------------------------------------------------------- *
 * SETTINGS FIELDS - FEATURES
 * ---------------------------------------------------------- */

function ade16_features_init(){

    //register the below settings
    register_setting(
      'features_settings',
      'features_settings'
    );  // JUST KEEP THESE THE SAME

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
        'Select Post', // field title
        'ade16_features_1_2_callback',  //field callback function
        'features_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
        'features_post_1' // get this from add_settings_section  $section_slug,
      );

      // //Page = Features, Section = Post 1, Field = Post Title
      //   add_settings_field(
      //     'ade16_features_1_3', //ID with ade16_ prefix
      //     'Post Title', // field title
      //     'ade16_features_1_3_callback',  //field callback function
      //     'features_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
      //     'features_post_1' // get this from add_settings_section  $section_slug,
      //   );
      //
      // //Page = Features, Section = Post 1, Field = Post ID
      //   add_settings_field(
      //     'ade16_features_1_4', //ID with ade16_ prefix
      //     'Post ID', // field title
      //     'ade16_features_1_4_callback',  //field callback function
      //     'features_menu', //  $menu_page_slug - should be $menu_slug from do_settings_sections()
      //     'features_post_1' // get this from add_settings_section  $section_slug,
      //   );

} // end function ade16_features_init

add_action( 'admin_init', 'ade16_features_init' );


/* ---------------------------------------------------------- *
 * CALLBACKS - FEATURES
 * ---------------------------------------------------------- */
function features_post_1_callback() { //Post 1 section

} //end features_post_1_callback()

//Features - Post 1 Fields
  function ade16_features_1_1_callback() {
    //The way this function stores the blog name and id means that when this value is queried it will first need to be parsed to extract just the ID. The reason this function stores both name and id is to make the select field more user-friendly.
    $setting = (array) get_option( 'features_settings');
    $field = 'ade16_features_1_1';
    $value = esc_attr( $setting[$field] );
      $html = "<select id='post_1_blog_select' name='features_settings[$field]' class='bloginput'>";
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
      $html .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Current Blog: <span class='boldtitle'>".$value."</span>";
      echo $html;

    } //end ade16_features_1_1_callback

  function ade16_features_1_2_callback() {
    //Simple post ID input box -- waaaayyyy too difficult to create a dropdown to select posts based on blog change in post's blog selection field

    //get stored value for ade16_features_1_2
      $setting = (array) get_option( 'features_settings');
      $field = 'ade16_features_1_2';
      $value = esc_attr( $setting[$field] );
      $html = "<input type='text' name='features_settings[$field]' value='$value' />";
      $html .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Current Post ID: <span class='boldtitle'>".$value."</span>";
      echo $html;
    } //end ade16_features_1_2_callback

  // function ade16_features_1_3_callback() {
  //     $setting = (array) get_option( 'features_settings');
  //     $field = 'ade16_features_1_3';
  //     $value = esc_attr( $setting[$field] );
  //     echo "<input type='text' name='features_settings[$field]' value='$value' />";
  //   }
  //
  // function ade16_features_1_4_callback() {
  //     $setting = (array) get_option( 'features_settings');
  //     $field = 'ade16_features_1_4';
  //     $value = esc_attr( $setting[$field] );
  //     echo "<input type='text' name='features_settings[$field]' value='$value' />";
  //   }


/* ---------------------------------------------------------- *
 * SCRIPTS TO HANDLE DROPDOWNS
 * ---------------------------------------------------------- */

// add_action( 'admin_footer', 'get_selected_blog' );
//
// function get_selected_blog() {
//   <  ?  >
  //   <!-- <script type="text/javascript">
  //     jQuery(document).ready(function($) {
  //
  //       $('.bloginput').change(function(){
  //         var selected_blog = $(this).val();
  //         var field_id = $(this).attr("name");
  //         var data = {
  //           'action': 'blog_handler',
  //           'field': field_id,
  //           'blog': selected_blog
  //         }
  //
  //         jQuery.post(ajaxurl, data, function(response) {
  //
  //
  //       });
  //     });
  //   });
  //     </script> -->
  //   <!-- <?php
  // }

// add_action( 'wp_ajax_blog_handler', 'blog_handler' );  //"my_action" must match the action: _______ value in js above
//   function blog_handler(){
//     global $wpdb; // this gives us access to database
//     $GLOBALS['post_1_blog'] = $_POST['blog']; //gets the value of 'whatever' declared in js;
//     echo $GLOBALS['post_1_blog'];
//     wp_die(); // always include
//   }


/* ---------------------------------------------------------- *
 * PAGE OUTPUT - FEATURES
 * ---------------------------------------------------------- */

function features_menu_output(){
if  (!current_user_can('administrator')) { return; } //check user permissions
?>
<div class="wrap">
<h1><?php echo esc_html(get_admin_page_title() ); ?></h1>
  <form method="post" action="options.php">
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



?>
