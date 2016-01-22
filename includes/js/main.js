/** theme additional scripts */
/*
+ window ready function
 - 1. Widget Custom Menu Toggle 
 - 2. Animate Scroll To Top
 - 3. Collapsing Header Widgets 
 - 4. Fancy Header
 - 5. dfLike
 - 6. video auto fit
 - 7. share grand
 - 9. share single portfolio
 - 10. post nav
 - 11. comments clear
 - 12. gallery counter width
 - 13. pretty photo general
 - 14. mobile port and blog sort
 - 15. woocommerce
 - 16. One Page Landing Toggle Navbar
 - 17. Responsive Mobile
 - 18. Animate TOP Search
 - 19. top uber menu active
 - 20. owl carousel for gallery in single porfolio
 - 21. uber menu responsive toggle
 - 22. Uber menu responsive mobile bug fix 
 - 23. Table Responsive
 - 24. Datepicker contact form 7
 - 25. Mega Menu
+ window resize function
 - 1. window resize gallery width
 - 2. window resize button show
 - 3. Uber menu push top
 + window load function
 - ios safari mobile menu 
 
 */

jQuery(document).ready(function($) {
// =========================================================================================
/* 1.Widget Custom Menu Toggle  */
// =========================================================================================

    $('.widget_nav_menu .sub-menu').hide(); //Hide children by default
    $('.widget_nav_menu ul.menu > li.menu-item').has('ul.sub-menu').prepend('<i class="fa fa-angle-down"></i>');

    $('.menu').children().click(function() {
        $(this).children('.widget_nav_menu .sub-menu').slideToggle(500, 'swing');
    }).children('.widget_nav_menu .sub-menu').click(function(event) {
        //event.stopPropagation();
        event.preventDefault();
    });


// =========================================================================================
/* 2. Animate Scroll To Top */
// =========================================================================================

      $(window).scroll(function() {
                    if ($(this).scrollTop() > 200) {
                        $('.scroll-top').fadeIn(200);
                    } else {
                        $('.scroll-top').fadeOut(200);
                    }
                });
                
                // Animate the scroll to top
                $('.scroll-top').click(function(event) {
                    event.preventDefault();
                    
                    $('html, body').animate({scrollTop: 0}, 800);
        });


// =========================================================================================
/*  3. Collapsing Header Widgets */
// =========================================================================================

    var startHeight = $('.header-widgets').height();
    $('.df-widgetbar-button').click(function() {
        // find nearby elements
        var headerWidgets = $(this).parent().find('.header-widgets');
        var inner = headerWidgets.children('.header-widgets-inner');

        // collect current heights
        var innerH = inner.height();
        var headerWidgetsH = headerWidgets.height();

        // calculate new height
        var newHeight = parseInt(headerWidgetsH) + parseInt(innerH);

        // determines whether to toggle height
        newHeight = headerWidgetsH > startHeight ? startHeight : newHeight;
        headerWidgets.animate({height: newHeight}, 100);
    });

// =========================================================================================
/* 4. Fancy Header */
// =========================================================================================

    if (!dfGlobals.isMobile) {
        $('.df-fancy-header-parallax').each(function() {
            var $_this = $(this),
                    speed_prl = $_this.data("fancy-prlx-speed");
            $(this).parallax("50%", speed_prl);
            $('.df-fancy-header-parallax').addClass("fancy-header-parallax-done");
        });
    }


    $('.df-fancy-header-video').each(function() {
        var BV = new $.BigVideo({container: $('.df-fancy-header-video')});
        windowWidth = jQuery(window).width();
        if (!Modernizr.touch) {
            var $_this = $(this),
                    video_url = $_this.data("fancy-video-url");
            BV.init();
            BV.show(video_url, {
                doLoop: true,
                ambient: true,
                mediaAspect: '16/9',
            });
        }
    });

// =========================================================================================
/* 5.dfLike */
// =========================================================================================

    $('.df-like').click(function() {

        var $likeLink = $(this);
        var $id = $(this).attr('id');

        if ($likeLink.hasClass('liked'))
            return false;

        var $dataToPass = {
            action: 'df_like',
            likes_id: $id
        }

        var like = $.post(dfLike.ajaxurl, $dataToPass, function(data) {
            $likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            $likeLink.find('span').css('opacity', 1);
        });

        return false;
    });

// =========================================================================================
// 6. video auto fit
// =========================================================================================

    $(".df-post-video, .df-port-embed-std").fitVids();

// =========================================================================================
// 7. share grand
// =========================================================================================
    $('.df-hover-share-container').mouseenter(function() {
        $(this).addClass('df-share-content-active');
    });
    $('.df-hover-share-container').mouseleave(function() {
        $(this).removeClass('df-share-content-active');
    });

// =========================================================================================
// 9. share single portfolio
// =========================================================================================

    $('.df-layout-grand.single-portfolio .single-share-portfolio .share-span').mouseenter(function() {
        $('.df-layout-grand.single-portfolio .single-share-portfolio ul').removeClass('no-active');
    });
    $('.df-layout-grand.single-portfolio .single-share-portfolio .share-span').mouseleave(function() {
        $('.df-layout-grand.single-portfolio .single-share-portfolio ul').addClass('no-active');
    });
    $('.df-layout-grand.single-portfolio .single-share-portfolio ul').mouseenter(function() {
        $(this).removeClass('no-active');
    });
    $('.df-layout-grand.single-portfolio .single-share-portfolio ul').mouseleave(function() {
        $(this).addClass('no-active');
    });
 
// =========================================================================================
// 10. post nav
// =========================================================================================

    $('#post-single-nav-left, #post-single-nav-right').mouseenter(function() {
        $(this).removeClass('no-active');
    });
    $('#post-single-nav-left, #post-single-nav-right').mouseleave(function() {
        $(this).addClass('no-active');
    });
 
 

// =========================================================================================
// 11. comments clear
// =========================================================================================

    $('a.clear-comment').on('click', function(e) {
        e.preventDefault();
        $('#comments .form-fields input, #comments .comment-form-comment textarea').val("").unbind();
    });

 

// =========================================================================================
// 12. gallery counter width
// =========================================================================================

galleryWidthBig = $(".df-metro-gallery-grid").width();
galleryWidthBig = galleryWidthBig / 2 - 1;
$(".df-layout-grand .df-metro-gallery-grid .gallery-item:first-child").css('height', galleryWidthBig + "px");
var mycontainerGallery = jQuery('.df-metro-gallery-grid .gallery');
mycontainerGallery.isotope({
    itemSelector: '.df-metro-gallery-grid .gallery-item',
    masonry: {
        columnWidth:  '.df-metro-gallery-grid .gallery-item:last-child'
    }
});
mycontainerGallery.imagesLoaded( function() {
  mycontainerGallery.isotope('layout');
});
// =========================================================================================
// 13. pretty photo general
// =========================================================================================

    $(" a[rel^='prettyPhoto']").prettyPhoto({
        autoplay_slideshow: false,
    });
// =========================================================================================
// 14. mobile port and blog sort
// =========================================================================================

    windowWidth = jQuery(window).width();

    if (windowWidth < 780) {
        $('#options-portfolio-sort, #options-blog-sort').click(function() {
            if ($(this).hasClass('active-hover')) {
                $(this).removeClass('active-hover');
            }else{
                $(this).addClass('active-hover');
            }
        }); 
    }

// =========================================================================================
/* 15. WooCommerce */
// =========================================================================================


$.fn.qvProduct = function() {

          $(this).click(function(e){
           /* add loader  */
           $(this).parent('figcaption').after('<div class="loading-popup"><i></i><i></i><i></i><i></i></div>');
           var product_id = $(this).attr('data-id');
           var data = { action: 'jck_quickview', product: product_id};
            $.post(ajaxurl, data, function(response) {
             $.magnificPopup.open({
                mainClass: 'my-mfp-zoom-in',
                items: {
                  src: '<div class="product-quickview"><div class="df_row-fluid">'+response+'</div></div>',
                  type: 'inline'
                }
              });
             $('.loading-popup').remove();
             setTimeout(function() {
                 
                   var qv_sync = $(".product-quickview #img-quickview");
                     
                      qv_sync.owlCarousel({
                        singleItem : true,
                        slideSpeed : 1000,
                        navigation: false,
                        pagination:false,
                        responsiveRefreshRate : 200,
                      });    

            }, 600);
            });
            e.preventDefault();
        });     

    return $(this);

};

 function syncPosition(el){
    var current = this.currentItem;
    $("#img-sync2")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#img-sync2").data("owlCarousel") !== undefined){
      center(current)
    }
  }

 function center(number){
  
    var sync2 = $("#img-sync2");

    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync2visible){
      if(num === sync2visible[i]){
        var found = true;
      }
    }
 
    if(found===false){
      if(num>sync2visible[sync2visible.length-1]){
        sync2.trigger("owl.goTo", num - sync2visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync2.trigger("owl.goTo", num);
      }
    } else if(num === sync2visible[sync2visible.length-1]){
      sync2.trigger("owl.goTo", sync2visible[1])
    } else if(num === sync2visible[0]){
      sync2.trigger("owl.goTo", num-1)
    }
    
  }



var DAHZ = DAHZ || {};

DAHZ.woocommerce = {


    initWC: function(){

        var init = this;

       init.singleProduct(); 
       init.zoomProduct();
       init.quickviewButton();

         /** Used Only For Touch Devices **/  
        if (Modernizr.touch) {
            [].slice.call(document.querySelectorAll("ul.products li.product figure ")).forEach(function(el,
                i) {
                el.querySelector("figcaption > a ").addEventListener("touchstart", function(e) {
                    e.stopPropagation()
                }, false);
                el.addEventListener("touchstart", function(e) {
                    classie.toggle(this, "cs-hover")
                }, false)
            })
        };

    },

    singleProduct: function(){

      var sync1 = $("#img-sync1");
      var sync2 = $("#img-sync2");
     
      sync1.owlCarousel({
        singleItem : true,
        slideSpeed : 1000,
        navigation: false,
        pagination:false,
        afterAction : syncPosition,
        responsiveRefreshRate : 200,
      });

      sync2.owlCarousel({
        items : 3,
        itemsDesktop      : [1199,3],
        itemsDesktopSmall     : [979,3],
        itemsTablet       : [768,4],
        itemsMobile       : [479,2],
        slideSpeed : 500,
        pagination:false,
        responsiveRefreshRate : 100,
        afterInit : function(el){
          el.find(".owl-item").eq(0).addClass("synced");
        }
      });
      
      //click Thumbnail
      sync2.on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo",number);
      });


    },

    // zoom product
    zoomProduct: function(){

         if ($(".easyzoom").length ) {
            if ( $(window).width() > 1024 ) {
                var $easyzoom = $(".easyzoom").easyZoom({
                            loadingNotice: '',
                            errorNotice: '',
                            preventClicks: false,
                        });
                        
                var easyzoom_trigger = $easyzoom.data('easyZoom');
                
                $(".variations").on('change', 'select', function() {
                   easyzoom_trigger.teardown();
                   easyzoom_trigger._init();
                });

            }
        } 

    },

    quickviewButton: function(){

        $('.quickview-button').qvProduct();

    }


}; // End WC.initSite Object 

DAHZ.woocommerce.initWC();

// =========================================================================================
/* 16. One Page Landing Toggle Navbar */
// =========================================================================================
var fixedLeft = $('.df-navibar-fixed-left'),
    fixedRight = $('.df-navibar-fixed-right');

if( $('.az-spmenu-push').length && !dfGlobals.isMobile  ) {

    $('.df-navibar').attr('id', 'az-spmenu-active');
    $('.df-navibar').prepend('<div id="az-spmenu-toggle" class="toggle-menu toggle"><div class="line first"></div><div class="line second"></div><div class="line third"></div></div>');

    var spmenuTrigger = document.getElementById('az-spmenu-active'),
    bottom =  $('.df-navibar-bottom-active .df-navibar'),
    top = $('.df-navibar-top-active .df-navibar'),
    spmenuPush = document.getElementById( 'az-spmenu-toggle' ),
    body_spmenu = document.body;
    
   var $width_fs,
       $offset_fs;

   if( spmenuTrigger ){
        $width_fs = $("body").width();
        $offset_fs = ((parseInt($('body').width()) - parseInt($('#wrapper').width())) / 2);

        fixedLeft.addClass('az-spmenu-left');
        fixedRight.addClass('az-spmenu-right');
        
        if( $('.df-boxed-layout-active').length ) {
        bottom.addClass('az-spmenu-bottom').css({ 'height': bottom.outerHeight(), 'bottom': -bottom.height(), 'position': 'fixed', width:$width_fs, 'margin-left': -$offset_fs  });
        top.addClass('az-spmenu-top').css({ 'height': top.outerHeight(), 'top': -top.height(), 'position': 'fixed', width:$width_fs, 'margin-left': -$offset_fs });
        } else {
        bottom.addClass('az-spmenu-bottom').css({ 'height': bottom.outerHeight(), 'bottom': -bottom.height(), 'position': 'fixed', width:$width_fs });
        top.addClass('az-spmenu-top').css({ 'height': top.outerHeight(), 'top': -top.height(), 'position': 'fixed', width:$width_fs });
        }
     }
  
    spmenuPush.onclick = function() {
            classie.toggle( this, 'toggle');
            classie.toggle( this, 'active' );
            if (  $('.df-navibar').hasClass('df-navibar-fixed-left') ) {
                classie.toggle( body_spmenu, 'az-spmenu-push-toright' );
            } else if (  $('.df-navibar').hasClass('df-navibar-fixed-right') ) {
                classie.toggle( body_spmenu, 'az-spmenu-push-toleft' );
            }
            classie.toggle( spmenuTrigger, 'az-spmenu-open' );
    } 
    

}


// essential grid fixed left and right
if(windowWidth >= 959 && (fixedLeft.length >= 1 || fixedRight.length >= 1)){
    $('.esg-container-fullscreen-forcer').each(function() {
        essentialGrid = jQuery(this);
        if (essentialGrid.position().left >= 0) {
            essentialGrid.css('padding-left', '0px');
            essentialGrid.css('padding-right', '0px');
        }
    });

    //revolutionslider push
    $( ".rev_slider_wrapper" ).each(function() {
        DfRevSlider = jQuery(this);
        if (DfRevSlider.position().left <= 0 || DfRevSlider.position().right >= 0) {
            DfRevSlider.addClass('rev-force-push');
            DfRevSlider.find('.tp-leftarrow').addClass('rev-button-push');
            DfRevSlider.find('.tp-rightarrow').addClass('rev-button-push');
        };

    });
}/*end if df mobile*/


// =========================================================================================
/* 17. Responsive Mobile */
// =========================================================================================

(function($) {
        $.slidebars({
            scrollLock: false
        });
}) (jQuery);


if (windowWidth < 959) {
    $('.mobile-primary-menu .sub-menu').hide();
    
    (function($) {
        $('<span  class="btnshow"></span>').insertBefore('.df-navi ul.sub-menu, .df-navi ul.children, .df-topbar-right .top-navigation ul.sub-menu, .df-topbar-right top-navigation ul.children');
        // $('.df-navi ul.sub-menu, .df-navi ul.children, .df-topbar-right .top-navigation ul.sub-menu, .df-topbar-right top-navigation ul.children').hide();
    })(jQuery);

    (function($) {
        $('<span  class="btnshow"></span>').insertBefore('.category-acc ul.children');
        //ACCORDION BUTTON ACTION (ON CLICK DO THE FOLLOWING)
        $('span.btnshow').click(function() {
            //REMOVE THE ON CLASS FROM ALL BUTTONS
            $(this).removeClass('onacc');
            //NO MATTER WHAT WE CLOSE ALL OPEN SLIDES
            $(this).next().slideUp('normal');
            //IF THE NEXT SLIDE WASN'T OPEN THEN OPEN IT
            if($(this).next().is(':hidden') == true) {
                //ADD THE ON CLASS TO THE BUTTON
                $(this).addClass('onacc');
                //OPEN THE SLIDE
                $(this).next().slideDown('normal');
            } 
        });
    /*** END REMOVE IF MOUSEOVER IS NOT REQUIRED ***/
    })(jQuery);
    jQuery('.df-mobile-menu li.menu-item-has-children > a').each(function() {
        var href_menu_child = $(this).attr('href');
        if (href_menu_child == '#') {
        
            $(this).click(function() {  
                
                $(this).next().removeClass('onacc');

                $(this).next().next().slideUp('normal');
               
                if($(this).next().next().is(':hidden') == true) {

                    console.log('tes');

                    $(this).next().addClass('onacc');

                    $(this).next().next().slideDown('normal');

                } 

            });
        };/*end if href_menu_child*/
    }); /*end each menu item has children*/
}

// =========================================================================================
// 18. Animate TOP Search
// =========================================================================================

// animate down
jQuery(".top-search").click(function(e) {
    // Prevent default behaviour
    e.preventDefault();
    //jQuery(".universe-search").css('display','block');
    jQuery(".universe-search").slideDown(400).css('display','block');
});

// animate top
jQuery('#content, #df-normal-header').click(function(e){
    var displaySearch = $(".universe-search ").css("display");
    if (displaySearch == 'block') {
        e.preventDefault();
        jQuery(".universe-search").slideUp(400);
    };
});

$(document).keyup(function(e) {
    if (e.keyCode == 27) {  
        e.preventDefault();
        jQuery(".universe-search").slideUp(400);
    }   // esc
});

jQuery(".universe-search-close").click(function(e) {
    // Prevent default behaviour
    e.preventDefault();
    jQuery(".universe-search").slideUp(400);
});

// ajax search begin
// Search
$('#searchfrm').keypress(function() {
    var value = $(this).val();
    var lenght = value.length;
    if(lenght > 1) {

        $.post(ajaxurl, { action: 'ajax_search', s: value }, function(output) {
            $('.universe-search-results').html(output);
        });
    }
});

$('#searchfrm').keypress(function() {
    containerJsp = jQuery('#jp-container-search'),
    containerJspOut = jQuery('.universe-search');
    containerJsp.css('height', 300);
    containerJspOut.animate({'height': 400});

    // the element we want to apply the jScrollPane
    $('#jp-container-search').jScrollPane({
        autoReinitialise: true,
    });
});

// =========================================================================================
// 19. top uber menu active 
// =========================================================================================

jQuery(".uber-topbar-active").click(function(e) {
    // Prevent default behaviour
    e.preventDefault();
    var topbar = jQuery(".df-topbar");
        topbar.slideToggle(400);
});

// =========================================================================================
// 20 .owl carousel for gallery in single porfolio
// =========================================================================================
    // owl slider
    $(".slider-gallery-owl").owlCarousel({
        navigation : true,
        pagination: false,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem : true,
        autoHeight : true,
        navigationText: [
            "<i class='df-arrow-grand-left'></i>",
            "<i class='df-arrow-grand-right'></i>"
        ],
    });

    $(".two-col-left #related-slider").owlCarousel({
        items: 2,
        itemsDesktop: [1199, 2],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
        addClassActive: true,
        autoPlay: false,
        afterMove : findHeightDragging,
        stopOnHover: true,
        navigation: true,
        pagination: false,
        navigationText: [
            "<i class='df-arrow-grand-left'></i>",
            "<i class='df-arrow-grand-right'></i>"
        ],
    });
    $(".two-col-right #related-slider").owlCarousel({
        items: 2,
        itemsDesktop: [1199, 2],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
        addClassActive: true,
        autoPlay: false,
        afterMove : findHeightDragging,
        stopOnHover: true,
        navigation: true,
        pagination: false,
        navigationText: [
            "<i class='df-arrow-grand-left'></i>",
            "<i class='df-arrow-grand-right'></i>"
        ],
    });
    $(".one-col #related-slider").owlCarousel({
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
        autoPlay: false,
        afterMove : findHeightDragging,
        addClassActive: true,
        stopOnHover: true,
        navigation: true,
        pagination: false,
        navigationText: [
            "<i class='df-arrow-grand-left'></i>",
            "<i class='df-arrow-grand-right'></i>"
        ],
    });
 
$(window).load(function() {
var max = -1;
    $('.related-post .owl-item.active').each(function( i ) {
        var h = $(this).height(); 
        max = h > max ? h : max;
    });
    $('.df-layout-grand .related-post .owl-wrapper-outer').css('height', max);
});
// If next or prev button is clicked get max height
$(".related-post .owl-prev, .related-post .owl-next").click(function(e){
    var max = -1;
    $('.related-post .owl-item.active').each(function( i ) {
        var h = $(this).height(); 
        max = h > max ? h : max;
    });
    $('.df-layout-grand .related-post .owl-wrapper-outer').css('height', max);
});

// If grab get max height
function findHeightDragging(){
    var max = -1;
    $('.related-post .owl-item.active').each(function( i ) {
        var h = $(this).height(); 
        max = h > max ? h : max;
    });
    $('.df-layout-grand .related-post .owl-wrapper-outer').css('height', max);
}

// =========================================================================================
// 21. uber menu responsive toggle
// =========================================================================================
var siteBranding = jQuery('.site-branding'),
    toggleRespUber = jQuery('.ubermenu-responsive-toggle');
if (windowWidth < 959) {
    heightRespUber = siteBranding.height() / 2 - 38;
    toggleRespUber.css('top', heightRespUber + 'px');
}
// =========================================================================================
/* 22. Uber menu responsive mobile bug fix  */
// =========================================================================================
// darn you uber!!!
if (jQuery('a').hasClass('ubermenu-responsive-toggle')) {
    jQuery( ".ubermenu-responsive-toggle" ).removeAttr('data-ubermenu-target');
    jQuery('.ubermenu-responsive').removeClass('ubermenu-responsive-collapse');
    jQuery('.ubermenu').hide("fast");
    jQuery('.ubermenu-responsive-toggle').click(function() {
        if (jQuery('.ubermenu').css("display") == 'block') {
            jQuery('.ubermenu').hide("fast");
        }else{
            jQuery('.ubermenu').show("fast");
        }
    });
}   
 

// =========================================================================================
/* 23. Table Responsive  */
// =========================================================================================
// Run on window load in case images or other scripts affect element widths
$(window).on('load', function() {
    if( dfGlobals.isMobile ){
        // Check all tables. You may need to be more restrictive.
        $('table').each(function() {
            var element = $(this);
            // Create the wrapper element
            var scrollWrapper = $('<div />', {
                'class': 'scrollable',
                'html': '<div />' // The inner div is needed for styling
            }).insertBefore(element);
            // Store a reference to the wrapper element
            element.data('scrollWrapper', scrollWrapper);
            // Move the scrollable element inside the wrapper element
            element.appendTo(scrollWrapper.find('div'));
            // Check if the element is wider than its parent and thus needs to be scrollable
            if (element.outerWidth() > element.parent().outerWidth()) {
                element.data('scrollWrapper').addClass('has-scroll');
            }
            // When the viewport size is changed, check again if the element needs to be scrollable
            $(window).on('debouncedresize', function() {
                if (element.outerWidth() > element.parent().outerWidth()) {
                    element.data('scrollWrapper').addClass('has-scroll');
                } else {
                    element.data('scrollWrapper').removeClass('has-scroll');
                }
            });
        });
    }
});
// =========================================================================================
/* 24. Datepicker contact form 7 */
// =========================================================================================
if ($('.wpcf7-form .datepicker_contact').length) {
    $( ".wpcf7-form .datepicker_contact" ).datepicker();
};
// =========================================================================================
// 16. mega menu
// =========================================================================================
var windowWidth = jQuery(window).width(),
    mega_menu  = $('.df-mega-menu').length,
    fixed  = $('.df-navibar-fixed-left-active, .df-navibar-fixed-right-active').length;
// if header position left or right
if (mega_menu != '0') {
    $('body').addClass('has-mega-menu');    
}
if (windowWidth > 959) {
    // fixed width find
    if (fixed != '0') {
        jQuery('.mega-width-header-fixed').each(function() {
            var class_str = $(this).attr('class'),
                index1 = class_str.indexOf('menu-data-width-'),
                index2 = class_str.indexOf('-size'),
                width_header_fixed = class_str.substring(index1+16,index2);
                $(this).find('> .sub-nav').css('width', width_header_fixed);
        });
    }
    // take image into background
    jQuery('.df-mega-menu').each(function() {
        if ($(this).find('> a > .mega-icon > img').length != '0') {
            $(this).addClass('df-mega-menu-img');
            var background_megamenu = $(this).find('> a > .mega-icon > img').attr('src');
            background_megamenu = 'url("' +background_megamenu+'")' 
            $(this).find('> .sub-nav ').css('background-image', background_megamenu);
            $(this).find('ul ul').css('background', 'transparent');
        };
    });
    // subnav mega right
    if ($('.mega-position-right').length && fixed == '0') {
        jQuery('.df-navi').each(function() {
            
            var nav_width = $(this).parent().parent('.df-navibar-inner').width();            


            $(this).find('.mega-position-right.mega-column-2').hover( function(){
                var left_position = $(this).position().left,
                    menu_right = $(this);
                    menu_width = nav_width * 0.4 - menu_right.width();
                    left_position = left_position - menu_width;
                    menu_right.find('> .sub-nav').css('left', left_position + 'px');
            });

            $(this).find('.mega-position-right.mega-column-3').hover( function(){
                var left_position = $(this).position().left,
                    menu_right = $(this);
                    menu_width = nav_width * 0.6 - menu_right.width();
                    left_position = left_position - menu_width;
                    menu_right.find('> .sub-nav').css('left', left_position + 'px');
            });

            $(this).find('.mega-position-right.mega-column-4').hover( function(){
                var left_position = $(this).position().left,
                    menu_right = $(this);
                    menu_width = nav_width * 0.8 - menu_right.width();
                    left_position = left_position - menu_width;
                    menu_right.find('> .sub-nav').css('left', left_position + 'px');
            });
        });
    }/*mega menu position right*/
    // subnav mega center
    if ($('.mega-position-center').length && fixed == '0') {
        jQuery('.df-navi').each(function() {
            
            var nav_width = $(this).parent().parent('.df-navibar-inner').width();

            $(this).find('.mega-position-center.mega-column-2').hover( function(){
                var left_position = $(this).position().left,
                    menu_center = $(this);
                    menu_width = nav_width * 0.4 - menu_center.width();
                    left_position = left_position - menu_width * 0.5;
                    menu_center.find('> .sub-nav').css('left', left_position + 'px');
            });

            $(this).find('.mega-position-center.mega-column-3').hover( function(){
                var left_position = $(this).position().left,
                    menu_center = $(this);
                    menu_width = nav_width * 0.6 - menu_center.width();
                    left_position = left_position - menu_width * 0.5;
                    menu_center.find('> .sub-nav').css('left', left_position + 'px');
            });

            $(this).find('.mega-position-center.mega-column-4').hover( function(){
                var left_position = $(this).position().left,
                    menu_center = $(this);
                    menu_width = nav_width * 0.8 - menu_center.width();
                    left_position = left_position - menu_width * 0.5;
                    menu_center.find('> .sub-nav').css('left', left_position + 'px');
            });
        });
    }/*mega menu position center*/
}/*window width*/

});/*end document ready*/


jQuery( window ).resize(function($) {
 $ = jQuery;
 
// =========================================================================================
// 1. window resize gallery width
// =========================================================================================

    galleryWidthBig = $(".df-metro-gallery-grid").width();
    galleryWidthBig = galleryWidthBig / 2 - 1;
    $(".df-layout-grand .df-metro-gallery-grid .gallery-item:first-child").css('height', galleryWidthBig + "px");
// =========================================================================================
//  2. window resize button show 
// =========================================================================================

windowWidth = jQuery(window).width();

if (windowWidth < 959) {
    $('.mobile-primary-menu .sub-menu').hide();

    if ($( "span.btnshow" ).length <= 1) {
        (function($) {
        $('<span  class="btnshow"></span>').insertBefore('.df-navi ul.sub-menu, .df-navi ul.children, .df-topbar-right .top-navigation ul.sub-menu, .df-topbar-right top-navigation ul.children');
        // $('.df-navi ul.sub-menu, .df-navi ul.children, .df-topbar-right .top-navigation ul.sub-menu, .df-topbar-right top-navigation ul.children').hide();
        })(jQuery);
        (function($) {
            $('<span  class="btnshow"></span>').insertBefore('.category-acc ul.children');
            //ACCORDION BUTTON ACTION (ON CLICK DO THE FOLLOWING)
            $('span.btnshow').click(function() {
            //REMOVE THE ON CLASS FROM ALL BUTTONS
            $(this).removeClass('onacc');
            //NO MATTER WHAT WE CLOSE ALL OPEN SLIDES
            $(this).next().slideUp('normal');
            //IF THE NEXT SLIDE WASN'T OPEN THEN OPEN IT
            if($(this).next().is(':hidden') == true) {
            //ADD THE ON CLASS TO THE BUTTON
            $(this).addClass('onacc');
            //OPEN THE SLIDE
            $(this).next().slideDown('normal');
            } 
            });
        /*** END REMOVE IF MOUSEOVER IS NOT REQUIRED ***/
        })(jQuery);
        jQuery('.df-mobile-menu li.menu-item-has-children > a').each(function() {
            var href_menu_child = $(this).attr('href');

            if (href_menu_child == '#') {
            
                $(this).click(function() {  
                    
                    $(this).next().removeClass('onacc');

                    $(this).next().next().slideUp('normal');
                   
                    if($(this).next().next().is(':hidden') == true) {

                        $(this).next().addClass('onacc');

                        $(this).next().next().slideDown('normal');

                    } 

                });
            };/*end if href_menu_child*/
        }); /*end each menu item has children*/
    };
// =========================================================================================
//  3. Uber menu push top 
// =========================================================================================
    var siteBranding = jQuery('.site-branding'),
    toggleRespUber = jQuery('.ubermenu-responsive-toggle');
    if (windowWidth < 959) {
        heightRespUber = siteBranding.height() / 2 - 38;
        toggleRespUber.css('top', heightRespUber + 'px');
    }
}
else {
var mega_menu  = $('.df-mega-menu').length,
    fixed  = $('.df-navibar-fixed-left-active, .df-navibar-fixed-right-active').length;
    // fixed width find
    if (fixed != '0') {
        jQuery('.mega-width-header-fixed').each(function() {
            var class_str = $(this).attr('class'),
                index1 = class_str.indexOf('menu-data-width-'),
                index2 = class_str.indexOf('-size'),
                width_header_fixed = class_str.substring(index1+16,index2);
                $(this).find('> .sub-nav').css('width', width_header_fixed);
        });
    }
    // take image into background
    jQuery('.df-mega-menu').each(function() {
        if ($(this).find('> a > .mega-icon > img').length != '0') {
            $(this).addClass('df-mega-menu-img');
            var background_megamenu = $(this).find('> a > .mega-icon > img').attr('src');
            background_megamenu = 'url("' +background_megamenu+'")' 
            $(this).find('> .sub-nav ').css('background-image', background_megamenu);
            $(this).find('ul ul').css('background', 'transparent');
        };
    });
    // subnav mega right
    if ($('.mega-position-right').length && fixed == '0') {
        jQuery('.df-navi').each(function() {
            
            var nav_width = $('.df-navibar-inner').width();
            
            $(this).find('.mega-position-right.mega-column-2').hover( function(){
                var left_position = $(this).position().left,
                    menu_right = $(this);
                    menu_width = nav_width * 0.4 - menu_right.width();
                    left_position = left_position - menu_width;
                    menu_right.find('> .sub-nav').css('left', left_position + 'px');
            });

            $(this).find('.mega-position-right.mega-column-3').hover( function(){
                var left_position = $(this).position().left,
                    menu_right = $(this);
                    menu_width = nav_width * 0.6 - menu_right.width();
                    left_position = left_position - menu_width;
                    menu_right.find('> .sub-nav').css('left', left_position + 'px');
            });

            $(this).find('.mega-position-right.mega-column-4').hover( function(){
                var left_position = $(this).position().left,
                    menu_right = $(this);
                    menu_width = nav_width * 0.8 - menu_right.width();
                    left_position = left_position - menu_width;
                    menu_right.find('> .sub-nav').css('left', left_position + 'px');
            });
        });
    }/*mega menu position right*/
    // subnav mega center
    if ($('.mega-position-center').length && fixed == '0') {
        jQuery('.df-navi').each(function() {
            
            var nav_width = $(this).parent().parent('.df-navibar-inner').width();

            $(this).find('.mega-position-center.mega-column-2').hover( function(){
                var left_position = $(this).position().left,
                    menu_center = $(this);
                    menu_width = nav_width * 0.4 - menu_center.width();
                    left_position = left_position - menu_width * 0.5;
                    menu_center.find('> .sub-nav').css('left', left_position + 'px');
            });

            $(this).find('.mega-position-center.mega-column-3').hover( function(){
                var left_position = $(this).position().left,
                    menu_center = $(this);
                    menu_width = nav_width * 0.6 - menu_center.width();
                    left_position = left_position - menu_width * 0.5;
                    menu_center.find('> .sub-nav').css('left', left_position + 'px');
            });

            $(this).find('.mega-position-center.mega-column-4').hover( function(){
                var left_position = $(this).position().left,
                    menu_center = $(this);
                    menu_width = nav_width * 0.8 - menu_center.width();
                    left_position = left_position - menu_width * 0.5;
                    menu_center.find('> .sub-nav').css('left', left_position + 'px');
            });
        });
    }/*mega menu position center*/
    $('.mobile-primary-menu .sub-menu').show();

    var fixedLeft = $('.df-navibar-fixed-left'),
        fixedRight = $('.df-navibar-fixed-right');
    if(windowWidth >= 959 && (fixedLeft.length >= 1 || fixedRight.length >= 1)){
        // essential grid fixed left and right
        $('.esg-container-fullscreen-forcer').each(function() {
            essentialGrid = jQuery(this);
            if (essentialGrid.position().left >= 0) {
                essentialGrid.css('padding-left', '0px');
                essentialGrid.css('padding-right', '0px');
            }
        });

        //revolutionslider push
        $( ".rev_slider_wrapper" ).each(function() {
            DfRevSlider = jQuery(this);
            if (DfRevSlider.position().left <= 0 || DfRevSlider.position().right >= 0) {
                DfRevSlider.addClass('rev-force-push');
                DfRevSlider.find('.tp-leftarrow').addClass('rev-button-push');
                DfRevSlider.find('.tp-rightarrow').addClass('rev-button-push');
            };

        });
    }/*end if df mobile*/
}
});

// =========================================================================================
// 1. window load ios safari mobile menu
// =========================================================================================

jQuery( window ).load(function() {
windowWidth = jQuery(window).width();

if (dfGlobals.isiOS && jQuery('.owl-carousel, .owl-wrapper, .df-float-menu').length) {
    if (windowWidth < 480) {
        jQuery('.sb-toggle-right').on('touchend click', function(event) {
            jQuery('#sb-site').css('-webkit-transform', 'translate(-80%)');
        });
        jQuery('.sb-toggle-left').on('touchend click', function(event) {
            jQuery('#sb-site').css('-webkit-transform', 'translate(80%)');
        });
    } else {
        jQuery('.sb-toggle-right').on('touchend click', function(event) {
            jQuery('#sb-site').css('-webkit-transform', 'translate(-40%)');
        });
        jQuery('.sb-toggle-left').on('touchend click', function(event) {
            jQuery('#sb-site').css('-webkit-transform', 'translate(40%)');
        });
    }
};
});

