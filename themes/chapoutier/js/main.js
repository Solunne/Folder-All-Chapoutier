(function ($) {
    $(document).ready(function() {

        // Toggle slide menu smartphone
        jQuery("#menu-toggle").click(function(e) {
            e.preventDefault();
            jQuery("#wrapper").toggleClass("toggled");
        });
        jQuery("button.close-menu").click(function(e) {
            e.preventDefault();
            jQuery("#wrapper").toggleClass("toggled");
        });

        // Delete link menu smartphone
        jQuery("#sidebar-wrapper li.dropdown > a").click(function( event ) {
            event.preventDefault();
        });

        //tooltip language
        jQuery("#language-current").popover({
            html : true,
            content: function() {
                return $("#language-available").html();
            }
        });

        //Change text pager
        jQuery( "ul.pager li.pager-previous a").html( "‹" );
        jQuery( "ul.pager li.pager-next a").html( "›" );

        // Commerce Recommender = Add class "active" tabs + product
        jQuery("#product_recommender div").first().addClass("active");

        jQuery("#tab_product_recommender li").first().addClass("active");

        // Recherche Vin + Bazar (hover product)
        jQuery('.product').mouseenter(function() {
           //jQuery(this).find('figcaption').addClass("show");
        });

        jQuery('.product').mouseleave(function() {
           //jQuery(this).find('figcaption').removeClass("show");
        });

        jQuery('#Prix').collapse({
            toggle: false
        });

        // Recherche Vin + Bazar sort by (delete exposed filter col-10)
        jQuery('.view-sort-order h2.title').remove();
        jQuery('.view-sort-order button').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_product_category_tid').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-commerce_price_amount').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_aoc_igp_tid').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_size_value').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_wine_vintage_value').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_location_tid').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_wine_type_value').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_vineyard_tid').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_label_value').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-language').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_parcel_selection_value').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_primeur_value').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_family_accordance_tid').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_millesime_tid').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_size_tid').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_wine_type_tid').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_bio_tid').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_single_vineyard_selection_tid').remove();
        jQuery('.col-md-12.view-sort-order .views-widget-filter-field_en_primeur_tid').remove();

        // Add class checked sort by radio button
        jQuery('input.form-radio:checked').parent().addClass("checked");

        // Add class checked sort by radio button
        jQuery('input.form-radio:checked').parent().addClass("checked");

        // Remove Label Add to Cart
        jQuery('.form-item-quantity .control-label').remove();

        // Remove spinner quantity
        jQuery('a.ui-spinner-button').remove();

        // Modal Glossary
        $('#glossary').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var title = button.data('title');
            var content = button.data('content');
            var modal = $(this);
            modal.find('.modal-title').html(title);
            modal.find('.modal-body p.data-content').html(content)
        });

        //tooltip labels
        jQuery(".labels").popover({
            html : true,
            content: function() {
                return $(this).find('+ div').html();
            }
        });

        //Popover Boostrap
        jQuery('body').on('click', function (e) {
            jQuery('[data-toggle="popover"]').each(function () {
                //the 'is' for buttons that trigger popups
                //the 'has' for icons within a button that triggers a popup
                if (!jQuery(this).is(e.target) && $(this).has(e.target).length === 0 && jQuery('.popover').has(e.target).length === 0) {
                    jQuery(this).hide();
                }
            });
        });

        // Scrollspy anchor Home Chapoutier
        jQuery('body').scrollspy({ target: '#house', offset: 110 });

        //Add class active top level sub-menu
        $('.dropdown-menu li a.active').parents().addClass('active');
        $('.navbar-nav > li.active').children('ul.dropdown-menu').addClass('active').addClass('strong-active');
        
		$('.navbar-nav > li').hover(function(){
			$('ul.dropdown-menu').removeClass('active');
			$('ul.dropdown-menu').removeClass('strong-active');
			$(this).children('ul.dropdown-menu').addClass('active');
		});
		
		$('.navbar-nav > li').mouseleave(function(){
			$(this).children('ul.dropdown-menu').removeClass('active');
			$('.navbar-nav > li.active').children('ul.dropdown-menu').addClass('active').addClass('strong-active');
		});

        //Anchor effect
        (function($, window) {
            var adjustAnchor = function() {

                var $anchor = $(':target'),
                    fixedElementHeight = 110;

                if ($anchor.length > 0) {

                    jQuery('html, body')
                        .stop()
                        .animate({
                            scrollTop: $anchor.offset().top - fixedElementHeight
                        }, 110);

                }

            };

            jQuery(window).on('hashchange load', function() {
                adjustAnchor();
            });

        })(jQuery, window);

        jQuery('#house').on('activate.bs.scrollspy', function () {
            jQuery("li.anchor a").removeClass("disabled");
            jQuery("li.anchor.active a").addClass("disabled");
        });

        //Page connexion
        jQuery('body.page-user-login #user_login_form h1').remove();

        //Range page
        jQuery('.node-type-range .range-content .item-slide-range#slide0').addClass('active');
        jQuery('.node-type-range .anchor-range:first-child a').addClass('active');
        jQuery('.node-type-range .anchor-range:first-child').addClass('active');

        jQuery('.node-type-range .anchor-range a').click(function () {
            var target = jQuery(this).attr('data-slide');
            jQuery('.node-type-range .anchor-range').removeClass('active');
            jQuery('.node-type-range .range-content .item-slide-range').removeClass('active');
            jQuery('.range-content '+target).addClass('active');
            jQuery('.node-type-range .anchor-range a').removeClass('active');
            jQuery(this).addClass('active');
            jQuery(this).parent().addClass('active');
        });

        jQuery('.list-range-small').change(function() {
            var val = jQuery(".list-range-small option:selected").text();
            var target = jQuery(".list-range-small option:selected").attr('data-slide');
            console.log(val, target);
            jQuery('.node-type-range .range-content .item-slide-range').removeClass('active');
            jQuery('.range-content '+target).addClass('active');

        });

        var rangePres = jQuery('.node-type-range .range-presentation').height();
        var rangeContent = jQuery('.node-type-range .range-content').height();
        var totalHeightRange = rangePres + rangeContent;

        if(jQuery(window).width() > 1023) {
            jQuery('.node-type-range .glossary').css('max-height', totalHeightRange);
        }

        var x = window.location.hash;
        if (x != '') {
            jQuery('#range a, .item-slide-range').removeClass('active');
            jQuery('a[data-slide="' + x + '"], ' + x).addClass('active');
        }

        /* display mega menu */
        $('.display-megamenu').hover(function(){
            $('.mega_menu').css('visibility','visible');
            $('.mega_menu').css('opacity','1');
        });
        $('.display-megamenu').mouseleave(function(){
            $('.mega_menu').css('visibility','hidden');
            $('.mega_menu').css('opacity','0');
        });
        $('.mega_menu').hover(function(){
            $(this).css('visibility','visible');
            $(this).css('opacity','1');
            $('ul.dropdown-menu').removeClass('active');
			$('ul.dropdown-menu').removeClass('strong-active');
        });
        $('.mega_menu').mouseleave(function(){
            $(this).css('visibility','hidden');
            $(this).css('opacity','0');
            $('.navbar-nav > li.active').children('ul.dropdown-menu').addClass('active').addClass('strong-active');
        });

        // elements with custom scrollbar
        if ($('.list-range-big').length > 0) {
            $('.list-range-big').mCustomScrollbar();
        }

        //readmore
        jQuery('.readmore').readmore({
            speed: 500,
            collapsedHeight: 60,
            moreLink: '<a href="#" class="text-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>',
            lessLink: '<a href="#" class="text-right"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>'
        });

        //reset filter mosaique
        jQuery(document).ready(function(){
            jQuery('a.reset').on( 'click', function() {
                var datafield = jQuery(this).attr('data-field');
                var datafieldvalue = jQuery(this).attr('data-field-value');
                var fieldname = jQuery('#'+datafield).attr('name');
                var arrValues = jQuery('#'+datafield).val();
                // Remove the value in the original field.
                console.log(typeof arrValues, jQuery('#'+datafield).val());
                console.log(typeof datafieldvalue, datafieldvalue);
                if (jQuery.isArray(arrValues)) {
                    arrValues.splice(arrValues.indexOf(datafieldvalue), 1);
                }
                jQuery('#'+datafield).val(arrValues);
                // Remove the hidden BEF field.
                jQuery('input[type="hidden"][name="' + fieldname + '"][value="' + datafieldvalue + '"]').remove();

                console.log(jQuery('#views-exposed-form-search-wines-search-wine').serializeArray());
                jQuery('#views-exposed-form-search-wines-search-wine').submit();
            });
        });

        //Event notation page vin
        jQuery('body.node-type-wine-display #accordion').on('show.bs.collapse', function (event) {
            var id = jQuery(event.target).attr('id');
            jQuery('body.node-type-wine-display #accordion h4 a[href="#' + id + '"]').find("span.glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus")
        });

        jQuery('body.node-type-wine-display #accordion').on('hide.bs.collapse', function (event) {
            var id = jQuery(event.target).attr('id');
            jQuery('body.node-type-wine-display #accordion h4 a[href="#' + id + '"]').find("span.glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus")
        });

        //add class line-trought dans le cas d'une solde
        jQuery( ".commerce-product-field-field-commerce-saleprice").parent().find( ".field-commerce-price").addClass("sales");
        jQuery( ".commerce-product-field-empty").parent().find( ".field-commerce-price").removeClass("sales");
        
        //video chapoutier
        if($('.video-js').length > 0){
			$('.vjs-big-play-button').click(function(){
				console.log('toto');
				if($('.video-js').hasClass('vjs-paused')){
					/* if($(window).width() > 1023) { */
						$('.media.video').css('position','absolute').css('width','91.667vw').css('z-index','1');
					//}
				}
			});
			$('.vjs-control-bar .vjs-control').click(function(){
				if($(this).hasClass('vjs-paused')){
					if($(window).width() > 1023) {
						$('.media.video').css('position','absolute').css('width','91.667vw').css('z-index','1');
					}
				}
				else{
					if($(window).width() > 1023) {
						$('.media.video').css('position','relative').css('width','50%').css('z-index','inherit');
					}
				}
			});
			$('.vjs-tech').click(function(){
				if($('.video-js').hasClass('vjs-paused')){
					if($(window).width() > 1023) {
						$('.media.video').css('position','relative').css('width','50%').css('z-index','inherit');
					}
				}
				else{
					if($(window).width() > 1023) {
						$('.media.video').css('position','absolute').css('width','91.667vw').css('z-index','1');
					}
				}
			});
		}

        // Language selection
        $('.language-selection').on('change', function(event) {
            var nextLink = $(this).val();
            window.location.href = nextLink;
        });

        // Add Placeholder in page reset password
        var placeholder1 = jQuery('body.page-user-reset #user-profile-form .form-item-pass-pass1 .control-label').text();
        jQuery('body.page-user-reset #user-profile-form .form-item-pass-pass1 input#edit-pass-pass1').attr("placeholder", placeholder1.substr(0, (placeholder1.length)-2));

        var placeholder2 = jQuery('body.page-user-reset #user-profile-form .form-item-pass-pass2 .control-label').text();
        jQuery('body.page-user-reset #user-profile-form .form-item-pass-pass2 input#edit-pass-pass2').attr("placeholder", placeholder2.substr(0, (placeholder2.length)-2));

        // Add Placeholder in page gift card
        var placeholdergift1 = jQuery('body.node-type-giftcard-display .form-item-line-item-fields-commerce-gc-mail-und-0-email .control-label').text();
        jQuery('body.node-type-giftcard-display input#edit-line-item-fields-commerce-gc-mail-und-0-email').attr("placeholder", placeholdergift1.substr(0, (placeholdergift1.length)-2));

        var placeholdergift2 = jQuery('body.node-type-giftcard-display .form-item-line-item-fields-commerce-gc-message-und-0-value .control-label').text();
        jQuery('body.node-type-giftcard-display textarea#edit-line-item-fields-commerce-gc-message-und-0-value').attr("placeholder", placeholdergift2.substr(0, (placeholdergift2.length)-2));

        // Change test Chèque UK
        //jQuery( "body.language-en .form-item-commerce-payment-payment-method label[for=edit-commerce-payment-payment-method-commerce-chequerules-cheque]").text("Cheque");
    });
    
}) (jQuery);