// Announcements Slider - bxSlider
$(document).ready(function( $ ){
  $('#ade-announcements-slider').bxSlider({
      autoStart: true,
      controls: true,
      nextSelector: '#announce-next-one',
      prevSelector: '#announce-prev-one',
      nextText: 'Keep Going <i class="fa fa-hand-o-right"></i>',
      prevText: '<i class="fa fa-hand-o-left"></i> Go Back'
      // pagerCustom: '#announcements-pager'
  }); //end bxSlider() for #announcements-slider
});
