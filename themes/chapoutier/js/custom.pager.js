(function ($) {
        $(document).ready(function() {

            var numItems = jQuery('.row').length;
//console.log("nombre de page: " + jQuery(".page-product").length );

            jQuery('#pagination').twbsPagination({
                // the number of pages. REQUIRED
                totalPages: jQuery(".page-product").length,

// the current page that show on start
                startPage: 1,

// maximum visible pages
                visiblePages: 5,

                initiateStartPageClick: true,

// template for pagination links
                href: false,

// variable name in href template for page number
                hrefVariable: '{{number}}',

// Text labels
                first: 'First',
                prev: '<',
                next: '>',
                last: 'Last',

// carousel-style pagination
                loop: false,

// callback function
                onPageClick: null,

// pagination Classes
                paginationClass: 'pagination',
                nextClass: 'next',
                prevClass: 'prev',
                lastClass: 'last hidden',
                firstClass: 'first hidden',
                pageClass: 'page',
                activeClass: 'active',
                disabledClass: 'disabled hidden',

                onPageClick: function (event, page) {
                    jQuery('#view-content');
                    //console.log(page);
                    jQuery(".page-product").addClass("hidden");
                    var pageSelected = jQuery(".page-product").eq(page - 1).removeClass("hidden");
                    window.scrollTo(0, 0);
                }


            });
        });
    }) (jQuery);
