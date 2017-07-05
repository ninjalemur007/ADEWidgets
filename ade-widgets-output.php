<?php

/* ---------------------------------------------------------- *
 * FUNCTION: POSTS_QUERY
 * ---------------------------------------------------------- */
function ade_widgets_post_query($blog, $post, $image_sizes) {

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

  $args = array(
    'p' => $post,
    'post_type' => array( 'post', 'ai1ec_event' )
 );

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

  if( ms_is_switched() == true ){  //switch back to original blog
    switch_to_blog($originalblogid);
  }

    wp_reset_postdata();

    return array('boxslider' => $post_object, 'pager' => $index_object, 'title' => $title );

} // end post_query()



  /* ---------------------------------------------------------- *
   * ANNOUNCEMENTS WIDGET
   * ---------------------------------------------------------- */

   function ade_widgets_announcements_widget( $atts ){

     //extract shortcode attributes
      extract( shortcode_atts( array(), $atts));

   //get settings
     $setting = (array) get_option( 'ade_widgets_announcements_settings' );
     $prefix = 'ade_widgets_announcements_';

     $blog_1 = esc_attr( $setting[$prefix.'1_1']);
     $blog_2 = esc_attr( $setting[$prefix.'2_1']);
     $blog_3 = esc_attr( $setting[$prefix.'3_1']);
     $blog_4 = esc_attr( $setting[$prefix.'4_1']);

     $post_1 = esc_attr( $setting[$prefix.'1_2']);
     $post_2 = esc_attr( $setting[$prefix.'2_2']);
     $post_3 = esc_attr( $setting[$prefix.'3_2']);
     $post_4 = esc_attr( $setting[$prefix.'4_2']);

     $announcements_images = array( 'ade-announcements-image-largest', 'ade-announcements-image-small' );

    //call ade_features_post_query() for each settings pair
    $output_1 = ade_widgets_post_query($blog_1, $post_1, $announcements_images);
    $output_2 = ade_widgets_post_query($blog_2, $post_2, $announcements_images);
    $output_3 = ade_widgets_post_query($blog_3, $post_3, $announcements_images);
    $output_4 = ade_widgets_post_query($blog_4, $post_4, $announcements_images);

     //build the boxslider object
     $boxslider = '<div id="ade-widgets-announcements-widget-wrap" '.$style.'><div id="ade-widgets-announcements-widget"><ul id="ade-widgets-announcements-slider" class="bxslider">';
       $boxslider .= '<li>'.$output_1['boxslider'].'</li>';
       $boxslider .= '<li>'.$output_2['boxslider'].'</li>';
       $boxslider .= '<li>'.$output_3['boxslider'].'</li>';
       $boxslider .= '<li>'.$output_4['boxslider'].'</li>';
     $boxslider .= '</ul></div>'; //close out boxslider object

     $pager = '<div id="ade-widgets-announcements-pager">';  //build the pager object
        $pager .= '<div id="ade-widgets-announce-prev-one"></div><div id="ade-widgets-announce-pager-dots">';
        $pager .= '<a href="" data-slide-index="0" class="ade-widgets-announce-pager-link active"><i class="fa fa-circle"></i></a>';
        $pager .= '<a href="" data-slide-index="1" class="ade-widgets-announce-pager-link"><i class="fa fa-circle"></i></a>';
        $pager .= '<a href="" data-slide-index="2" class="ade-widgets-announce-pager-link"><i class="fa fa-circle"></i></a>';
        $pager .= '<a href="" data-slide-index="3" class="ade-widgets-announce-pager-link"><i class="fa fa-circle"></i></a>';
        $pager .= '</div><div id="ade-widgets-announce-next-one"></div>';
        $pager .= '</div></div>';  //close the pager object

     $final .= $boxslider;
     $final .= $pager;


     return $final;

   } // END announcements_widget()


//SHORTCODE
add_shortcode( 'ade-widgets-announcements', 'ade_widgets_announcements_widget');

/* ---------------------------------------------------------- *
 * FUNCTION: HEADLINES WIDGET
 * ---------------------------------------------------------- */
function ade_widgets_category_widget_query( $blog, $category, $number ) {

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

    if( ms_is_switched() == true ){  //switch back to original blog
      switch_to_blog($originalblogid);
    }

    wp_reset_postdata();

    return $post_object;

} //end

function ade_widgets_category_widget() {

  $setting = (array) get_option( 'ade_widgets_headlines_settings' );
  $prefix = 'ade_widgets_headlines_';

  $blog = esc_attr( $setting[$prefix.'1_1']);
  $category = esc_attr( $setting[$prefix.'1_2']);
  $number = esc_attr( $setting[$prefix.'1_3']);

  $widget_output = ade_widgets_category_widget_query( $blog, $category, $number);

  $ourwidget = '<div id="ade-widgets-category-widget"><div class="innerborder"><h3>Latest Headlines</h3><ul>'.$widget_output.'</ul></div></div>';

  return $ourwidget;
}

//SHORTCODE
add_shortcode( 'ade-widgets-headlines', 'ade_widgets_category_widget');




 /* ---------------------------------------------------------- *
  * FUNCTION: QUICK LINKS
  * ---------------------------------------------------------- */
 function ade_widgets_quicklinks() {


   $setting = (array) get_option( 'ade_widgets_quicklinks_settings' );
   $prefix = 'ade_widgets_quicklinks_';

   $icon_1 = esc_attr( $setting[$prefix.'1_1']);
   $link_1 = esc_attr( $setting[$prefix.'1_2']);
   $title_1 = esc_attr( $setting[$prefix.'1_3']);

   $icon_2 = esc_attr( $setting[$prefix.'2_1']);
   $link_2 = esc_attr( $setting[$prefix.'2_2']);
   $title_2 = esc_attr( $setting[$prefix.'2_3']);

   $icon_3 = esc_attr( $setting[$prefix.'3_1']);
   $link_3 = esc_attr( $setting[$prefix.'3_2']);
   $title_3 = esc_attr( $setting[$prefix.'3_3']);

   $icon_4 = esc_attr( $setting[$prefix.'4_1']);
   $link_4 = esc_attr( $setting[$prefix.'4_2']);
   $title_4 = esc_attr( $setting[$prefix.'4_3']);

   $icon_5 = esc_attr( $setting[$prefix.'5_1']);
   $link_5 = esc_attr( $setting[$prefix.'5_2']);
   $title_5 = esc_attr( $setting[$prefix.'5_3']);

   $icon_6 = esc_attr( $setting[$prefix.'6_1']);
   $link_6 = esc_attr( $setting[$prefix.'6_2']);
   $title_6 = esc_attr( $setting[$prefix.'6_3']);

   $quicklink_1 = '<div class="ade-widgets-quicklink"><a href="'.$link_1.'" title="'.$title_1.'"><i class="fa fa-3x fa-'.$icon_1.'"></i><br class="donotfilter"><span class="ade-widgets-quicklink-title">'.$title_1.'</span></a></div>';
   $quicklink_2 = '<div class="ade-widgets-quicklink"><a href="'.$link_2. '" title="'.$title_2. '"><i class="fa fa-3x fa-'.$icon_2. '"></i><br class="donotfilter"><span class="ade-widgets-quicklink-title">'.$title_2.'</span></a></div>';
   $quicklink_3 = '<div class="ade-widgets-quicklink"><a href="'.$link_3. '" title="'.$title_3. '"><i class="fa fa-3x fa-'.$icon_3. '"></i><br class="donotfilter"><span class="ade-widgets-quicklink-title">'.$title_3.'</span></a></div>';
   $quicklink_4 = '<div class="ade-widgets-quicklink"><a href="'.$link_4. '" title="'.$title_4. '"><i class="fa fa-3x fa-'.$icon_4. '"></i><br class="donotfilter"><span class="ade-widgets-quicklink-title">'.$title_4.'</span></a></div>';
   $quicklink_5 = '<div class="ade-widgets-quicklink"><a href="'.$link_5. '" title="'.$title_5. '"><i class="fa fa-3x fa-'.$icon_5. '"></i><br class="donotfilter"><span class="ade-widgets-quicklink-title">'.$title_5.'</span></a></div>';
   $quicklink_6 = '<div class="ade-widgets-quicklink"><a href="'.$link_6. '" title="'.$title_6. '"><i class="fa fa-3x fa-'.$icon_6. '"></i><br class="donotfilter"><span class="ade-widgets-quicklink-title">'.$title_6.'</span></a></div>';

   $quicklinks .= '<div id="ade-widgets-quicklinks" class="col-xs-12">';
  $quicklinks .= $quicklink_1;
  $quicklinks .= $quicklink_2;
  $quicklinks .= $quicklink_3;
  $quicklinks .= $quicklink_4;
  $quicklinks .= $quicklink_5;
  $quicklinks .= $quicklink_6;
  $quicklinks .= '</div>';

  return $quicklinks;
 }

 //SHORTCODE
 add_shortcode( 'ade-widgets-quicklinks', 'ade_widgets_quicklinks');


?>
