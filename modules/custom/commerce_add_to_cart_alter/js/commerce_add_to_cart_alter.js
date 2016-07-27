(function ($) {
  Drupal.behaviors.commerce_add_to_cart_confirmation_alter = {
    attach:function (context, settings) {
      if ($('#cart-confirmation').length > 0) {
        $('#cart-confirmation').modal()
      }
    }
  }
})(jQuery);
