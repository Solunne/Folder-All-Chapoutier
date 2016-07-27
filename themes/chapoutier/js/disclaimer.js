/**
 * Print a popup disclaimer depending to the locale.
 * @author Anthony Delannoy <anthony.delannoy@wassa.fr>
 */
(function ($) {
    $(document).ready(function() {
        if ($('body').hasClass('page-node-2197')) {
            return false;
        }
        // Get the disclaimer modal.
        var $html =  $('#modal-disclaimer');
        // Get the country code
        var country = $('html').attr('data-user-ip-country');
        // By default, do nothing.
        var countryControlType = 'none';
        // The configuration configuration for countries.
        var countriesControlType = [
            {country_code: ['FR'], control_type: 'none'},
            {country_code: ['US'], control_type: 'ue21'},
            {country_code: ['UK'], control_type: 'ue18'},
            {country_code: ['CH'], control_type: 'stranger'},
        ];
        // The CGU terms link.
        var termLink = '/node/2197';
        // Get the isDisclaimerSigned flag value.
        var isDisclaimerSigned = $.jStorage.get('isDisclaimerSigned');

        if (isDisclaimerSigned == null || isDisclaimerSigned == '' || !isDisclaimerSigned) {

            // Get the control type for the ip country.
            var cctObject = $.grep(countriesControlType, function(n, i) {
                return $.inArray(country, n.country_code) > -1;
            });

            if (cctObject && typeof cctObject != 'undefined' && cctObject.length > 0) {
                countryControlType = cctObject[0].control_type;
            }

            console.debug('CountryControlType', countryControlType);
            switch (countryControlType) {
                case 'ue21':
                    console.debug('ue21');
                    // Init and display the datepicker.
                    $("#minor-birthdate").birthdayPicker({sizeClass: 'form-control'});
                    $('#minor-birthdate').find('.birthdayPicker').addClass('form-inline text-center');
                    $('#disclaimer-birthselect, .disclaimer-birthselect').removeClass('hidden');
                    $html.modal('show');
                    break;
                case 'ue18':
                    console.debug('ue18');
                    // Init and display the datepicker.
                    $("#minor-birthdate").birthdayPicker({sizeClass: 'form-control'});
                    $('#minor-birthdate').find('.birthdayPicker').addClass('form-inline text-center');
                    $('#disclaimer-birthselect, .disclaimer-birthselect').removeClass('hidden');
                    $html.modal('show');
                    break;
                case 'stranger':
                    console.debug('stranger');
                    // Display the Yes/No buttons.
                    $('#disclaimer-buttons, .disclaimer-buttons').removeClass('hidden');
                    $html.modal('show');
                    break;
                default:
                    console.debug('none');
                    // Do nothing, do not display the popup.
                    break;
            }
        }



        // If the visitor click on the "I am minor" button.
        $html.find('#minor-btn').on('click', function(event) {
            event.preventDefault();
            $.jStorage.set('isDisclaimerSigned', false);
            window.location.assign(termLink);
        });

        // If the visitor click on the "I am major" button.
        $html.find('#major-btn').on('click', function(event) {
            event.preventDefault();
            $.jStorage.set('isDisclaimerSigned', true);
        });

        $html.find('#submit-btn').on('click', function(event) {
            event.preventDefault();
            var birthDate = moment($html.find('#minor-birthdate input').val());
            var legalAge = 18;
            switch (countryControlType) {
                case 'ue21':
                    legalAge = 21;
                    break;
                case 'ue18':
                    legalAge = 18;
                    break;
            }
            var currDate = moment().subtract(legalAge, 'years');

            if (birthDate.isSameOrBefore(currDate)) { // If user is major.
                $.jStorage.set('isDisclaimerSigned', true);
                $html.modal('hide');
            } else { // Then user is minor.
                $.jStorage.set('isDisclaimerSigned', false);
                window.location.assign(termLink);
            }
        });
    });
}) (jQuery);
