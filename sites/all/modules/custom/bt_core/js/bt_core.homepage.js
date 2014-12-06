(function ($) {

  Drupal.behaviors.bt_core_homepage = {
    attach: function (context, settings) {
      $('.slides').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        lazyLoad: 'ondemand'
      });
    }
  };


})(jQuery);