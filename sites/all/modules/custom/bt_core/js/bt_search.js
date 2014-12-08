(function ($) {

  Drupal.behaviors.bt_search = {
    attach: function (context, settings) {
      // Remove the last HR ;)
      if ($('.search-results hr:last').length) {
        $('.search-results hr:last').remove();
      }
    }
  };


})(jQuery);