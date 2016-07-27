/**
 * Created by adelannoy on 22/04/16.
 */
(function ($) {
    $(document).ready(function () {
        var $yesText = $('input[name="yes_text"]');
        var $noText = $('input[name="no_text"]');
        var $submitText = $('input[name="submit_text"]');
        var $selectDisplay = $('select[name="display_mode"]');
        // When the page is loaded, toggle the display of the form element depending to the display mode.
        toggleFormElements($selectDisplay.val());

        // Add event listener to the display mode form field.
        $selectDisplay.bind('change', function(event) {
            console.debug('display_mode', event);
            var $this = $(this);
            // If the display mode change, toggle the display of the form element.
            toggleFormElements($this.val());
        });

        /**
         * Toggle the display of form elements depending to the display mode.
         *
         * @param {string} displayMode - Display mode (ex: "buttons", "birthselect").
         */
        function toggleFormElements(displayMode) {
            switch (displayMode) {
                case 'buttons':
                    $yesText.val('').parents('.form-item-yes-text').show();
                    $noText.val('').parents('.form-item-no-text').show();
                    $submitText.val('').parents('.form-item-submit-text').hide();
                    break;
                case 'birthselect':
                    $yesText.val('').parents('.form-item-yes-text').hide();
                    $noText.val('').parents('.form-item-no-text').hide();
                    $submitText.val('').parents('.form-item-submit-text').show();
                    break;
                default:
                    $yesText.val('').parents('.form-item-yes-text').hide();
                    $noText.val('').parents('.form-item-no-text').hide();
                    $submitText.val('').parents('.form-item-submit-text').hide();
                    break;
            }
        }
    });
}) (jQuery);