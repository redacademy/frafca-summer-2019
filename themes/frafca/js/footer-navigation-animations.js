(function ($) {
  let transitionTime = 400;

  //Footer drop down menu only on mobile//
  $('.footer-navigation').on('click', function () {
    if ($(window).width() < 1200) {
      $(this)
        .children('.footer-menu-container')
        .slideToggle(transitionTime);

      $(this)
        .find('.footer-arrow-down-icon')
        .toggleClass('open');
    }
  });
})(jQuery);
