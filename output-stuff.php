<?php

/* ---------------------------------------------------------- *
 * FUNCTION: POSTS_QUERY
 * ---------------------------------------------------------- */
function post_query($blog, $post, $image_sizes) {

  global $originalblogid;

  $blog = strchr($blog, "(", false); //parse string for post ID
    $blog = strchr($blog, ")", true); //parse again
    $blog = ltrim($blog, '(' ); //parse again

  if( is_multisite()){
    if ( strlen($blog) > 0 && $blog !== $originalblogid) {
          $blog_id = $blog; //if so, then make that the blog_id
      } else {
          $blog_id = $originalblogid;
      }

    switch_to_blog ($blog_id); // select correct blog, whether current or other
  }

  $args = array( 'p' => $post);

  $newquery = new WP_Query( $args ); // query for post content

    while ( $newquery->have_posts() ): $newquery->the_post();

        $title = get_the_title();

        $post_object .= '<div class="post-wrap">';

          $post_object .= '<a href="'.get_permalink().'" title="'.$title.'">'.get_the_post_thumbnail($post_id, $image_sizes[0] ).'</a>'; //image

          $post_object .= '<div class="overlay">'; //create overlay
            $post_object .= '<a href="'.get_permalink().'" title="'.$title.'"><h4>'.$title.'</h4></a>';
            $post_object .= '</div>'; //close overlay

        $post_object .= '</div>'; //close .features-post-wrap

      $index_object .= get_the_post_thumbnail( $post_id, $image_sizes[1] );

    endwhile;

  wp_reset_query();

  return array('boxslider' => $post_object, 'pager' => $index_object, 'title' => $title );


  if(is_multisite()){  //switch back to original blog
    switch_to_blog($originalblogid);
  }

} // end post_query()



/* ---------------------------------------------------------- *
 * FEATURES WIDGET
 * ---------------------------------------------------------- */
function features_widget( $atts ){

  extract( shortcode_atts( array(), $atts));

  //get settings from Features menu page
  $setting = (array) get_option( 'features_settings' );
  $prefix = 'ade16_features_';

  $blog_1 = esc_attr( $setting[$prefix.'1_1']);
  $blog_2 = esc_attr( $setting[$prefix.'2_1']);
  $blog_3 = esc_attr( $setting[$prefix.'3_1']);
  $blog_4 = esc_attr( $setting[$prefix.'4_1']);

  $post_1 = esc_attr( $setting[$prefix.'1_2']);
  $post_2 = esc_attr( $setting[$prefix.'2_2']);
  $post_3 = esc_attr( $setting[$prefix.'3_2']);
  $post_4 = esc_attr( $setting[$prefix.'4_2']);

  $features_images = array( 'features-image-largest', 'features-image-small' );

  //call post_query() for each settings pair
  $output_1 = post_query($blog_1, $post_1, $features_images);
  $output_2 = post_query($blog_2, $post_2, $features_images);
  $output_3 = post_query($blog_3, $post_3, $features_images);
  $output_4 = post_query($blog_4, $post_4, $features_images);


  //build the boxslider object
  $boxslider = '<ul id="features-slider" class="bxslider">';
    $boxslider .= '<li>'.$output_1['boxslider'].'</li>';
    $boxslider .= '<li>'.$output_2['boxslider'].'</li>';
    $boxslider .= '<li>'.$output_3['boxslider'].'</li>';
    $boxslider .= '<li>'.$output_4['boxslider'].'</li>';
  $boxslider .= '</ul>'; //close out boxslider object

  $pager = '<div id="features-pager" class="features-pager">';  //build the pager object
    $pager .= '<a data-slide-index="0" href="" title="'.$output_1['title'].'">'.$output_1['pager'].'</a>';
    $pager .= '<a data-slide-index="1" href="" title="'.$output_2['title'].'">'.$output_2['pager'].'</a>';
    $pager .= '<a data-slide-index="2" href="" title="'.$output_3['title'].'">'.$output_3['pager'].'</a>';
    $pager .= '<a data-slide-index="3" href="" title="'.$output_4['title'].'">'.$output_4['pager'].'</a>';
  $pager .= '</div>';  //close the pager object

  $final = '<div id="features-widget">'; //create features-widget div
  $final .= $boxslider;
  $final .= $pager;
  $final .= '</div>';
  return $final;

} // END features_widget()

add_shortcode( 'features', 'features_widget');


  /* ---------------------------------------------------------- *
   * ANNOUNCEMENTS WIDGET
   * ---------------------------------------------------------- */

   function announcements_widget( $atts ){

     //extract shortcode attributes
      extract( shortcode_atts( array(), $atts));


   //get settings
     $setting = (array) get_option( 'announcements_settings' );
     $prefix = 'ade16_announcements_';

     $blog_1 = esc_attr( $setting[$prefix.'1_1']);
     $blog_2 = esc_attr( $setting[$prefix.'2_1']);
     $blog_3 = esc_attr( $setting[$prefix.'3_1']);
     $blog_4 = esc_attr( $setting[$prefix.'4_1']);

     $post_1 = esc_attr( $setting[$prefix.'1_2']);
     $post_2 = esc_attr( $setting[$prefix.'2_2']);
     $post_3 = esc_attr( $setting[$prefix.'3_2']);
     $post_4 = esc_attr( $setting[$prefix.'4_2']);

     $announcements_images = array( 'announcements-image-largest', 'announcements-image-small' );

    //call post_query() for each settings pair
    $output_1 = post_query($blog_1, $post_1, $announcements_images);
    $output_2 = post_query($blog_2, $post_2, $announcements_images);
    $output_3 = post_query($blog_3, $post_3, $announcements_images);
    $output_4 = post_query($blog_4, $post_4, $announcements_images);

     //build the boxslider object
     $boxslider = '<ul id="announcements-slider" class="bxslider">';
       $boxslider .= '<li>'.$output_1['boxslider'].'</li>';
       $boxslider .= '<li>'.$output_2['boxslider'].'</li>';
       $boxslider .= '<li>'.$output_3['boxslider'].'</li>';
       $boxslider .= '<li>'.$output_4['boxslider'].'</li>';
     $boxslider .= '</ul>'; //close out boxslider object

    //  $pager = '<div id="announcements-pager" class="announcements-pager">';  //build the pager object
    //    $pager .= '<a data-slide-index="0" href="" title="'.$output_1['title'].'">'.$output_1['pager'].'</a>';
    //    $pager .= '<a data-slide-index="1" href="" title="'.$output_2['title'].'">'.$output_2['pager'].'</a>';
    //    $pager .= '<a data-slide-index="2" href="" title="'.$output_3['title'].'">'.$output_3['pager'].'</a>';
    //    $pager .= '<a data-slide-index="3" href="" title="'.$output_4['title'].'">'.$output_4['pager'].'</a>';
    //  $pager .= '</div>';  //close the pager object

     $final = '<div id="announcements-widget">'; //create announcements-widget div
     $final .= $boxslider;
    //  $final .= $pager;

    $final .= '<div class="prev-next-wrap"><div id="prev-one" class="prev"></div><div id="next-one" class="next"></div></div>';
     $final .= '</div>'; //close announcements-widget div
     return $final;

   } // END announcements_widget()


//SHORTCODE
add_shortcode( 'announcements', 'announcements_widget');

/* ---------------------------------------------------------- *
 * FUNCTION: HEADLINES WIDGET
 * ---------------------------------------------------------- */
function category_headlines_widget_query( $blog, $category, $number ) {
  global $originalblogid;

  $number = intval($number);

  $blog = strchr($blog, "(", false); //parse string for post ID
    $blog = strchr($blog, ")", true); //parse again
    $blog = ltrim($blog, '(' ); //parse again

  if( is_multisite()){
    if ( strlen($blog) > 0 && $blog !== $originalblogid) {
          $blog_id = $blog; //if so, then make that the blog_id
      } else {
          $blog_id = $originalblogid;
      }

    switch_to_blog ($blog_id); // select correct blog, whether current or other
  }

  $args = array(
    'category_name' => $category,
    'posts_per_page' => $number,
    'post_status' => 'publish'
  );

  $newquery = new WP_Query( $args ); // query for post content

    while ( $newquery->have_posts() ): $newquery->the_post();
      $postid = get_the_ID();
      $title = get_the_title();
      $link = get_permalink();
      $date = get_the_date('F j, Y');
      $post_object .= '<li id="'.$postid.'"><a href="'.$link.'">'.$title.'</a>  <span style="font-style:italic; font-size:90%;">('.$date.')</span></li>';
    endwhile;

    wp_reset_query();

    return $post_object;

  if(is_multisite()){  //switch back to original blog
    switch_to_blog($originalblogid);
  }

} //end Headlines Widget

function category_headlines_widget() {

//GET SETTINGS
  // $widget_name
  // $blog
  // $category
  // $number

  $setting = (array) get_option( 'headlines_settings' );
  $prefix = 'ade16_headlines_';

  $blog = esc_attr( $setting[$prefix.'1_1']);
  $category = esc_attr( $setting[$prefix.'1_2']);
  $number = esc_attr( $setting[$prefix.'1_3']);

  $widget_output = category_headlines_widget_query( $blog, $category, $number);

  $ourwidget = '<div id="headlines"><div class="category-widget"><div class="innerborder"><h3>Latest Headlines</h3><ul>'.$widget_output.'</ul></div></div></div>';

  return $ourwidget;
}

//SHORTCODE
add_shortcode( 'headlines', 'category_headlines_widget');


/* ---------------------------------------------------------- *
 * BOX WIDGET
 * ---------------------------------------------------------- */

// function box_widget_query( $blog, $post, $image ) {
//
//
// }

 function box_widget( $atts ){

   //extract shortcode attributes
    extract( shortcode_atts( array(
      // 'set' => '',  // 'setting' attribute should be slug used in register_setting()
      'box' => ''           // 'box' attribute should equal distinguishing number in settings section slug from add_settings_section()
    ), $atts));

    $setting = (array) get_option( 'blog_corner_settings');

   $prefix = 'ade16_blog_corner_box_';
   $prefix .= $box;
   $prefix .= '_';

   $blog = esc_attr( $setting[$prefix.'1'] );
   $post = esc_attr( $setting[$prefix.'2'] );
   $icon = esc_attr( $setting[$prefix.'4'] );
   $text = esc_attr( $setting[$prefix.'5'] );
   $image = 'box-widget-image';

   $boxwidget = '<div id="'.$box.'" class="box-widget"><div class="box-widget-banner box-widget-top"><i class="fa fa-'.$icon.' fa-lg"></i> '.$text.'</div><div class="box-widget-post">';

   global $originalblogid;

   $blog = strchr($blog, "(", false); //parse string for post ID
     $blog = strchr($blog, ")", true); //parse again
     $blog = ltrim($blog, '(' ); //parse again

   if( is_multisite()){
     if ( strlen($blog) > 0 && $blog !== $originalblogid) {
           $blog_id = $blog; //if so, then make that the blog_id
       } else {
           $blog_id = $originalblogid;
       }
     switch_to_blog ($blog_id); // select correct blog, whether current or other
   }

   $args = array( 'p' => $post );

   $newquery = new WP_Query( $args ); // query for post content

     while ( $newquery->have_posts() ): $newquery->the_post();

           $title = get_the_title();

           $boxwidget .= '<a href="'.get_permalink().'" title="'.$title.'">'.get_the_post_thumbnail( $post_id, $image ).'</a>'; //image

           $boxwidget .= '<div class="box-widget-overlay">'; //create overlay
           $boxwidget .= '<a href="'.get_permalink().'" title="'.$title.'"><h4>'.$title.'</h4></a>';
           $boxwidget .= '</div>'; //close overlay

     endwhile;

   wp_reset_query();

   if(is_multisite()){  //switch back to original blog
     switch_to_blog($originalblogid);
   }

  //  $box_widget_query_output = box_widget_query( $blog, $post, $image );

   $boxwidget .= '</div></div>';

   return $boxwidget;

 } // END


//SHORTCODE
add_shortcode( 'boxwidget', 'box_widget');



?>
