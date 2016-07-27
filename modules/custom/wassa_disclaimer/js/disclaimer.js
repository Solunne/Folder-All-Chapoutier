/**
* Print a popup disclaimer depending to the locale.
* @author Anthony Delannoy <anthony.delannoy@wassa.fr>
*/
(function ($) {
   $(document).ready(function() {

       // Get the isDisclaimerSigned flag value.
       var isDisclaimerSigned = $.jStorage.get('isDisclaimerSigned');
       console.debug('isDisclaimerSigned', isDisclaimerSigned, typeof isDisclaimerSigned);

       if (isDisclaimerSigned == null || isDisclaimerSigned == '' || !isDisclaimerSigned) {
           // Get the locale from the <html> tag attribute.
           var locale = $('html').attr('lang');
           console.debug(locale);

           // AJAX Call to get disclaimer configuration depending to the site locale.
           $.ajax({
               url: '/' + locale + '/ws/wassa/disclaimer/json',
               type: 'GET',
               error: function(err) {
                   console.error(err);
               },
               success: function(data) {
                   console.debug(typeof data, data);
                   // Check there are data returned and that the user aren't on the redirect URL.
                   if (data && window.location.pathname != '/' + data.redirect_url &&
                       window.location.pathname != '/' + data.language_code + '/' + data.redirect_url) {

                       switch (data.display_mode) {
                           case 'birthselect':
                               // Generate the popup.
                               var $popup = disclaimer.generatePopup();
                               // Fill the popup with the data.
                               var $translatedPopup = disclaimer.translate($popup, data);
                               // Add the popup in the DOM and show the popup.
                               $('body').append($translatedPopup);
                               // Init and display the datepicker.
                               //$('#minor-birthdate').datepicker($.datepicker.regional[data.language_code]);
                               $("#minor-birthdate").birthdayPicker({sizeClass: 'form-control'});
                               $('#minor-birthdate').find('.birthdayPicker').addClass('form-inline text-center');
                               $('#disclaimer-birthselect').removeClass('hidden');
                               $translatedPopup.modal('show');
                               break;
                           case 'buttons':
                               // Generate the popup.
                               var $popup = disclaimer.generatePopup();
                               // Fill the popup with the data.
                               var $translatedPopup = disclaimer.translate($popup, data);
                               // Add the popup in the DOM and show the popup.
                               $('body').append($translatedPopup);
                               // Display the Yes/No buttons.
                               $('#disclaimer-buttons').removeClass('hidden');
                               $translatedPopup.modal('show');
                               break;
                           default:
                               // Do nothing, do not display the popup.
                               break;
                       }
                   }
                   return data;
               }
           });
       }

       // Look for errors.

       // Fetch Data & generate modal.



       var disclaimer = {
           generatePopup: function() {
               var html = '' +
                   '<div class="modal fade" id="modal-disclaimer" tabindex="-1" role="dialog">' +
                   '<div class="modal-dialog">' +
                   '<div class="modal-content">' +
                   '<div class="modal-header">' +
                   '<h4 class="modal-title">Disclaimer</h4>' +
                   '</div>' +
                   '<div class="modal-body">' +
                   '<p>One fine body&hellip;</p>' +
                   '</div>' +
                   '<div class="modal-footer">' +
                   '<div class="hidden" id="disclaimer-birthselect">' +
                   '<div id="minor-birthdate"></div>' +
                   '<a href="" class="btn btn-primary" id="submit-btn">Valider</a>' +
                   '</div><div class="hidden" id="disclaimer-buttons">' +
                   '<a href="" class="btn btn-primary" id="major-btn" data-dismiss="modal">Yes</a>' +
                   '<a href="" class="btn btn-default" id="minor-btn">No</a>' +
                   '</div>' +
                   '</div>' +
                   '</div>' +
                   '</div>' +
                   '</div>';

               return $(html);
           },
           translate: function($html, translations) {
               $html.find('.modal-title').html('Disclaimer');
               $html.find('.modal-body').html(translations.message);
               $html.find('#minor-btn').attr('href', '/' + translations.language_code + '/' + translations.redirect_url)
                   .html(translations.no_text);
               $html.find('#major-btn').html(translations.yes_text);
               $html.find('#submit-btn').html(translations.submit_text);

               // For a backdrop which doesn't close the modal on click.
               $html.modal({backdrop: 'static'});

               // If the visitor click on the "I am minor" button.
               $html.find('#minor-btn').on('click', function(event) {
                   event.preventDefault();
                   $.jStorage.set('isDisclaimerSigned', false);
                   window.location.assign('/' + translations.language_code + '/' + translations.redirect_url);
               });

               // If the visitor click on the "I am major" button.
               $html.find('#major-btn').on('click', function(event) {
                   event.preventDefault();
                   $.jStorage.set('isDisclaimerSigned', true);
               });

               $html.find('#submit-btn').on('click', function(event) {
                   event.preventDefault();
                   var birthDate = moment($html.find('#minor-birthdate input').val());
                   var currDate = moment().subtract(translations.legal_age, 'years');

                   if (birthDate.isSameOrBefore(currDate)) { // If user is major.
                       $.jStorage.set('isDisclaimerSigned', true);
                       $html.modal('hide');
                   } else { // Then user is minor.
                       $.jStorage.set('isDisclaimerSigned', false);
                       window.location.assign('/' + translations.language_code + '/' + translations.redirect_url);
                   }
               });
               return $html;
           }
       };

   });
}) (jQuery);
