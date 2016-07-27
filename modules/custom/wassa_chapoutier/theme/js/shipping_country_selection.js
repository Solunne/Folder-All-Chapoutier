/**
 * Created by adelannoy on 17/06/16.
 */
// (function ($) {
//     $(document).ready(function () {
//         var $shippingCountryModal = $('#shipping-country-block-content');
//         var shippingCountry = $('select[name="shipping_country_selection"]').attr('data-shipping-country');
//         // Get the display price flag.
//         var mustDisplayPrice = getCookie('mustDisplayPrice');
//         var stopAskShippingCountry = getCookie('stopAskShippingCountry');
//         var $displayPriceBtn = $('#display-price-btn');

//         // If the session var 'shipping_country' is not setted, open the modal.
//         if (shippingCountry == '' && !stopAskShippingCountry) {
//             $shippingCountryModal.modal('show');
//         }

//         // If the display flag is set to true, display all things related to the price.
//         if (mustDisplayPrice || shippingCountry == 'FR') {
//             $('body').removeClass('hidden-price');
//         }
//         // If the display flag is set to false, hide all things related to the price.
//         else {
//             // Display or hide the display price button.
//             if ($('select[name="shipping_country_selection"]').attr('data-shipping-country') == '') {
//                 $('.display-price-container').css('display', 'none');
//             } else {
//                 $('.display-price-container').css('display', 'inline');
//             }
//             $('body').addClass('hidden-price');
//         }

//         $('select[name="shipping_country_selection"]').on('change', function(event) {
//             console.debug(this, event);
//             $('select[name="shipping_country_selection"]').val($(this).val());
//             $(this).parents('form').trigger('submit');
//         });

//         $displayPriceBtn.on('click', function(event) {
//             event.preventDefault();
//             $('body').removeClass('hidden-price');
//             setCookie('mustDisplayPrice', true, 182);
//             setCookie('stopAskShippingCountry', true, 182);
//         });

//         // if needed, add event on backdrop click.
//         if ($shippingCountryModal.attr('data-backdrop-click') == 'true') {
//             $shippingCountryModal.on('hide.bs.modal', function(e) {
//                 setCookie('stopAskShippingCountry', true, 182);
//                 var wineUrl = $shippingCountryModal.find('#shipping-country-wine').attr('href');
//                 window.location.href = wineUrl;
//             });
//         } else if ($shippingCountryModal.attr('data-backdrop-click') == 'false' 
//             &&  $shippingCountryModal.find('select').val() == $shippingCountryModal.find('select').attr('data-user-country')) {
//             $shippingCountryModal.on('hide.bs.modal', function(e) {
//                 setCookie('stopAskShippingCountry', true, 182);
//                 $shippingCountryModal.find('form').trigger('submit');
//             });
//         }
//     });
// }) (jQuery);

// function setCookie(cname, cvalue, exdays) {
//     var d = new Date();
//     d.setTime(d.getTime() + (exdays*24*60*60*1000));
//     var expires = "expires="+d.toUTCString();
//     document.cookie = cname + "=" + cvalue + "; " + expires;
// }

// function getCookie(cname) {
//     var name = cname + "=";
//     var ca = document.cookie.split(';');
//     for(var i = 0; i < ca.length; i++) {
//         var c = ca[i];
//         while (c.charAt(0) == ' ') {
//             c = c.substring(1);
//         }
//         if (c.indexOf(name) == 0) {
//             return c.substring(name.length, c.length);
//         }
//     }
//     return "";
// }

// function checkCookie() {
//     var user = getCookie("username");
//     if (user != "") {
//         alert("Welcome again " + user);
//     } else {
//         user = prompt("Please enter your name:", "");
//         if (user != "" && user != null) {
//             setCookie("username", user, 365);
//         }
//     }
// }