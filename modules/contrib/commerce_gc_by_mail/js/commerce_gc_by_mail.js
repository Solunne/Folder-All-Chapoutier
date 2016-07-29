(function($) {
  Drupal.behaviors.fadeAndSlide = {
    attach: function (context, settings) {
      // http://stackoverflow.com/questions/734554/jquery-fadeout-then-slideup
      if (jQuery.fn.fadeOutAndSlideUp == undefined) {
        jQuery.fn.fadeOutAndSlideUp = function(speed, easing, callback) {
          return this.fadeTo(speed, 0, easing).slideUp(speed, easing, callback);
        };
      }

      if (jQuery.fn.slideDownAndFadeIn == undefined) {
        jQuery.fn.slideDownAndFadeIn = function(speed, easing, callback) {
          return this.slideDown(speed, easing).fadeTo(speed, 1, easing, callback);
        };
      }
    }
  };

  Drupal.behaviors.commerceGcManualOption = {
    attach: function (context, settings) {
      var targetForms = $('form.commerce-add-to-cart, form#commerce-checkout-form-checkout');

      targetForms.once('transitions', function() {
        targetForms.bind('state:visible', function(e) {
          if (e.trigger) {
            var closestElement = $(e.target).closest('.form-item, .form-submit, .form-wrapper'),
                action         = [e.value ? 'slideDownAndFadeIn' : 'fadeOutAndSlideUp'];

            closestElement[action]();
            e.stopPropagation();
          }
        });
      });
    }
  };
})(jQuery);