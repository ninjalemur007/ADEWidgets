// Features Slider - bxSlider
$(document).ready(function(){
  $('#features-slider').bxSlider({
      autoStart: false,
      pagerCustom: '#features-pager',
      preloadImages: 'all'
  }); //end bxSlider() for #features-slider
});

// Announcements Slider - bxSlider
$(document).ready(function(){
  $('#announcements-slider').bxSlider({
      autoStart: false,
      controls: true,
      nextSelector: '#next-one',
      prevSelector: '#prev-one',
      nextText: 'Keep Going <i class="fa fa-hand-o-right"></i>',
      prevText: '<i class="fa fa-hand-o-left"></i> Go Back'
      // pagerCustom: '#announcements-pager'
  }); //end bxSlider() for #announcements-slider
});
