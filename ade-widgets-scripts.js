// Announcements Slider - bxSlider
jQuery(document).ready(function( $ ){
  $('#ade-widgets-announcements-slider').bxSlider({
    auto: true,
    autoStart: true,
    pause: 5000,
    controls: true,
    infiniteLoop: true,
    preloadImages: 'visible',
    autoHover: true,
    touchEnabled: true,
    autoControls: true,
    nextSelector: '#ade-widgets-announce-next-one',
    prevSelector: '#ade-widgets-announce-prev-one',
    nextText: '<span class="screen-reader-text">next</span><i class="fa fa-hand-o-right"></i>',
    prevText: '<span class="screen-reader-text">previous</span><i class="fa fa-hand-o-left"></i>',
    pagerCustom: '#ade-widgets-announcements-pager',
    startText: '<span class="screen-reader-text">play</span><i class="fa fa-play"></i>',
    stopText: '<span class="screen-reader-text">pause</span><i class="fa fa-pause"></i>',
    autoControlsSelector: '#stopstart',
    autoControlsCombine: true
  }); //end bxSlider()
});
