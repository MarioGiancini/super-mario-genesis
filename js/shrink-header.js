jQuery(function( $ ){

  $(window).scroll(function () {
    if ($(document).scrollTop() > 80 ) {
      $('.site-header').addClass('shrink');
      $('#click-menu').addClass('shrink');
    } else {
      $('.site-header').removeClass('shrink');
      $('#click-menu').removeClass('shrink');
    }
  });

});
