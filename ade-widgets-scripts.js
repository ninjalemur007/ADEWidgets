// Announcements Slider - bxSlider
jQuery(document).ready(function( $ ){
  $('#ade-widgets-announcements-slider').bxSlider({
      autoStart: false,
      controls: true,
      nextSelector: '#ade-widgets-announce-next-one',
      prevSelector: '#ade-widgets-announce-prev-one',
      nextText: '<i class="fa fa-hand-o-right"></i>',
      prevText: '<i class="fa fa-hand-o-left"></i>',
      pagerCustom: '#ade-widgets-announcements-pager'
  }); //end bxSlider()

  $('#test').bxSlider({
    autoStart: false,
    controls: true
  });
});
