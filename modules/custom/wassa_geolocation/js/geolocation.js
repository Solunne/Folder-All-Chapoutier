/**
 * Geolocate the user and redirect him to a domain corresponding to his country.
 * @author Anthony Delannoy <anthony.delannoy@wassa.fr>
 */
(function ($) {
    $(document).ready(function() {
        // Google API Key.
        var googleApiKey = 'AIzaSyAoz_X02rm49R839Hme5A1ZHANszuj_1q8';
        // Get the country code (ccTLDs ISO 3166-1).
        var countryCode = $.jStorage.get('countryCode');

        // Check if the country code variable is already setted.
        if (countryCode == null || countryCode == '') {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                // Get the current position of the user.
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Geocode URL request from latitude and longitude coordinates.
                    var url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + pos.lat + ',' + pos.lng + '&result_type=country&key=' + googleApiKey;

                    // Request the web service to geocode the position of the user.
                    $.getJSON(url, function(data) {
                        console.debug(pos, data);
                        if (data.status == 'OK') {
                            var countryCode = data.results[0].address_components[0].short_name;
                            // Store the country code.
                            $.jStorage.set('countryCode', countryCode);
                            // Call redirection function.
                            domainRedirect(countryCode);
                        } else {
                            console.debug('ErrorStatus: ' + data.status);
                        }
                    });

                }, function() {
                    handleLocationError(true);
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false);
            }
        } else {
            domainRedirect(countryCode);
        }

        /**
         * Display error message in the browser console.
         *
         * @param {boolean} browserHasGeolocation - Boolean that indicates geolocation browser support.
         */
        function handleLocationError(browserHasGeolocation) {
            console.debug(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
        }

        /**
         * Redirect user to the good domain depending his country.
         *
         * @param {string} countryCode - ccTLD ISO 3166-1 2-alpha.
         */
        function domainRedirect(countryCode) {
            var url = '/ws/wassa/geolocation/json/' + countryCode;
            // Request the web service to determinate the good domain depending to country code.
            $.get(url, function(data) {
                // Check if the web service return the good country code.
                if (typeof data.country_code != 'undefined' && data.country_code == countryCode) {
                    // Create a pattern and test if the redirect URL is a part of the current URL.
                    var patt = new RegExp(data.redirect_url, 'i');
                    var needToRedirect = !patt.test(window.location.href);

                    if (needToRedirect) {
                        // Redirect the user to the good domain.
                        window.location.href = window.location.protocol + '//' + data.redirect_url;
                    }
                }
            });
        }

    });
}) (jQuery);