jQuery(function( $ ){

  $('#home-featured-top .wrap') .css({'height': (($(window).height())) +'px'});
  $(window).resize(function(){
    $('#home-featured-top .wrap') .css({'height': (($(window).height())) +'px'});
  });

  $("#home-featured-top .home-1 .widget:last-child").after('<p class="find-out fade-in-delay">Find Out More</p><p class="arrow fade-in-delay"><a href="#home-featured-2" class="animate-red-fading"></a></p>');

  $.localScroll({
    duration: 750
  });

});
