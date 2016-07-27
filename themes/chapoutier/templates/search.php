<?php
/**
 * Created by PhpStorm.
 * User: adelannoy
 * Date: 14/06/16
 * Time: 16:25
 */
?>
<div id="site-search" class="col-xs-12 col-sm-4 col-sm-offset-8">
    <div class="row row-form">
        <form id="site-search-form">
            <div class="form-group">
                <input type="text" class="form-control" id="search-input" placeholder="Rechercher" />
            </div>
        </form>
    </div>
    <div class="row row-results"></div>
</div>

<script type="application/javascript">
    (function ($) {
        $(document).ready(function() {
            var jsLocale = $('html').attr('lang');
            var products = [];
            var diaries = [];
            var labelShopTab = '<?php print t('Shop'); ?>';
            var labelDiaryTab = '<?php print t('Diary'); ?>';

            // AJAX call
            $.ajax({
                url: '/' + jsLocale + '/products/json',
                dataType: 'JSON',
                error: function(err) {
                    console.debug(err);
                },
                success: function(data) {
                    products = data.products;
                }
            });
            $.ajax({
                url: '/' + jsLocale + '/diaries/json',
                dataType: 'JSON',
                error: function(err) {
                    console.debug(err);
                },
                success: function(data) {
                    diaries = data.diaries;
                }
            });

            $.widget('custom.catcomplete', $.ui.autocomplete, {
                options: {
                    minLength: 2,
                    source: function(req, resp) {
                        // Prepare the req to initiate the search.
                        var arrReq = req.term.split(' ');

                        // Intitiate the search with the arrReq for products.
                        var pResults = $.grep(products, function(n, i) {
                            var coeff = 0;
                            // Create a nProduct string to facilitate the search.
                            var nProduct = getProductString(n.product);

                            // Check the presence of the needle in the nProduct string.
                            for (var key in arrReq) {
                                if (arrReq[key] != '') {
                                    var patt = new RegExp(removeAccents(arrReq[key]), 'i');
                                    // Increase the coeff if the needle is found in the nProduct string.
                                    if (patt.test(nProduct)) {
                                        coeff++;
                                    }
                                }
                            }
                            // Add the coefficient property to the object.
                            n.product.coeff = coeff;
                            return (coeff > 0) ? true : false;
                        });

                        // Intitiate the search with the arrReq for diaries.
                        var dResults = $.grep(diaries, function(n, i) {
                            var coeff = 0;
                            // Check the presence of the needle in the diary title string.
                            for (var key in arrReq) {
                                if (arrReq[key] != '') {
                                    var patt = new RegExp(arrReq[key], 'i');
                                    // Increase the coeff if the needle is found in the diary title string.
                                    if (patt.test(removeAccents(n.diary.title))) {
                                        coeff++;
                                    }
                                }
                            }
                            // Add the coefficient property to the object.
                            n.diary.coeff = coeff;
                            return (coeff > 0) ? true : false;
                        });

                    resp([pResults, dResults]);
                    },
                },
                _create: function() {
                    this._super();
                    this.widget().menu( "option", "items", "> :not(.ui-autocomplete)" );
                },
                _renderItemData: function (ul, item) {
                    var type = (ul.attr('id') == 'product-results') ? 'product' : 'diary';
                    var li = '';
                    ul.removeAttr('style');
                    if (ul.attr('id') == 'product-results') {
                        type = 'product';
                        var productUrl = Drupal.settings.basePath + Drupal.settings.pathPrefix + 'node/' +item[type].nid;
                        var tiret_1 = (item[type].field_wine_vintage != '') ? ' - ' : '';
                        var tiret_2 = (item[type].field_wine_type != '') ? ' - ' : '';
                        li = '<li><a href="' + productUrl + '">' +
                            '<div class="col-xs-3 product-image"><img src="' + item[type].field_images + '" /></div>' +
                            '<div class="col-xs-6 product-desc">' +
                            '<span class="line1">' + item[type].title + tiret_1 + item[type].field_wine_vintage + '</span>' +
                            '<span class="line2">' + item[type].field_aoc_igp + '</span>' +
                            '<span class="line3">' + item[type].field_size + tiret_2 + item[type].field_wine_type + '</span>' +
                            '<span class="line4">' + item[type].field_vineyard + '</span>' +
                            '</div>' +
                            '<div class="col-xs-3 product-price">' +
                            '' + item[type].commerce_price + '' +
                            '</div>' +
                            '</a></li>';
                    } else {
                        type = 'diary';
                        var diaryUrl = Drupal.settings.basePath + Drupal.settings.pathPrefix + 'node/' +item[type].nid;
                        li = '<li><a href="' + diaryUrl + '">' +
                            '<div class="col-xs-12">' +
                            '<span class="line1"><strong>' + item[type].field_publication_date + '</strong> - <u class="text-uppercase">' + item[type].field_category + '</u></span>' +
                            '<span class="line2">' + item[type].title + '</span>' +
                            '</div>' +
                            '</a></li>';
                    }

                    return $(li).appendTo(ul);
                },
                _renderMenu: function (ul, items) {
                    var that = this;

                    // Add the tab system.
                    ul.html('<div class="nav nav-tabs" role="tablist">' +
                        '<span role="presentation" class="col-xs-6 active"><a href="#product-results" aria-controls="product-results" role="tab" data-toggle="tab">' + labelShopTab + '</a></span>' +
                        '<span role="presentation" class="col-xs-6"><a href="#diary-results" aria-controls="diary-results" role="tab" data-toggle="tab">' + labelDiaryTab + '</a></span>' +
                        '</div>' +
                        '<div class="tab-content">' +
                        '<div role="tabpanel" class="tab-pane active" id="product-results"></div>' +
                        '<div role="tabpanel" class="tab-pane" id="diary-results"></div>' +
                        '</div>');

                    // Products
                    $.each(items[0], function (index, item) {
                        that._renderItemData(ul.find('#product-results'), item);
                    });
                    // Diaries
                    $.each(items[1], function (index, item) {
                        that._renderItemData(ul.find('#diary-results'), item);
                    });
                    // Add result in the result div.
                    $('#site-search .row-results').append(ul);

//                    $('#site-search a[data-toggle="tab"]').click(function (e) {
//                        console.debug('click event', e, $(e.target));
//                        e.preventDefault()
//                        $(this).tab('show')
//                    })
                    // Add event to add class on active tab.
                    $('#site-search a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                        $('#site-search a[data-toggle="tab"]').parent().removeClass('active');
                        $(e.target).parent().addClass('active');
                    });
                },
                close : function (event, ui) {
//                    var oldFocusedTab = $('#site-search .nav.nav-tabs span.active').find('a').attr('href');
//                    var val = $("#search-input").val();
//                    // Keep autocomplete open by searching the same input again.
//                    $('#search-input').catcomplete("search", val);
//                    $("#search-input").focus();
//                    $('#site-search a[data-toggle="tab"][href="' + oldFocusedTab + '"]').tab('show');
                    return false;
                }
            });

            // Init the catcomplete widget.
            $('#search-input').catcomplete();

            // $('#site-search-form').on('submit', function(event) {
            //     event.preventDefault();
            //     var inputVal = $(this).find('#search-input').val();
            //     if (inputVal.lenght >= 2) {
            //         $('#search-input').catcomplete('search', inputVal);
            //     }
            // });

            // Open & close the search by clicking to the button.
            $('header .search a').on('click', function(e) {
                // Clear the search on close.
                if ($(this).hasClass('opened')) {
                    $('#search-input').val('');
                    $('#site-search .row-results').html('');
                }
                $(this).toggleClass('opened');
                $('#site-search').toggleClass('opened');

            });


            /**
             * Get a string to facilitate the search on the product object.
             *
             * @param {object} product - Product object.
             * @returns {string} - Return the string for the product object.
             */
            function getProductString(product) {
                var nProduct = product.title;
                nProduct += ' ' + product.field_size;
                nProduct += ' ' + product.field_aoc_igp;
                nProduct += ' ' + product.field_vineyard;
                nProduct += ' ' + product.field_wine_type;
                nProduct += ' ' + product.field_wine_vintage;
                nProduct += ' ' + product.commerce_price;

                return removeAccents(nProduct);
            }

            /*
                Search : Remove and return the given string.
                https://gist.github.com/alisterlf/3490957
            */
            function removeAccents(strAccents) {
                var strAccents = strAccents.split('');
                var strAccentsOut = new Array();
                var strAccentsLen = strAccents.length;
                var accents = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž';
                var accentsOut = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz";
                for (var y = 0; y < strAccentsLen; y++) {
                    if (accents.indexOf(strAccents[y]) != -1) {
                        strAccentsOut[y] = accentsOut.substr(accents.indexOf(strAccents[y]), 1);
                    } else
                        strAccentsOut[y] = strAccents[y];
                }
                strAccentsOut = strAccentsOut.join('');
                return strAccentsOut;
            }
        });
    }) (jQuery);
</script>