(function($) {


    /* Grand 
     ==================================================================================================*/
    wp.customize('df_options[grand_site_max_width]', function(value) {
        value.bind(function(newval) {
            $('.df-layout-grand .df_container-fluid').css('max-width', newval + 'px');
            $('.df-layout-grand.df-boxed-layout-active #wrapper').css('max-width', newval + 'px');
            $('.df-layout-grand.df-frame-boxed-layout-active #wrapper').css('max-width', newval + 'px');
        });
    });

    wp.customize('df_options[grand_site_width]', function(value) {
        value.bind(function(newval) {
            $('.df-layout-grand .df_container-fluid').css('width', newval + '%');
            $('.df-layout-grand.df-boxed-layout-active #wrapper').css('width', newval + '%');
            $('.df-layout-grand.df-frame-boxed-layout-active #wrapper').css('width', newval + '%');
        });
    });

    wp.customize('df_options[grand_bg_color]', function(value) {
        value.bind(function(newval) {
            $('body').css('background', convertHex(newval));
        });
    });

    wp.customize('df_options[grand_bg_content_color]', function(value) {
        value.bind(function(newval) {
            $('#wrapper').css('background', convertHex(newval));
        });
    });
      
    // =============================================================================
// Page Loader
// =============================================================================
    
    var loaderTrigger1 = $('#customize-control-df_options-page_loader input');

    var loaderOption1 = $('#customize-control-df_options-pageloader_color');
    var loaderOption2 = $('#customize-control-df_options-pageloader_type');
    var loaderOption3 = $('#customize-control-df_options-pageloader_effects');
    var loaderOption4 = $('#customize-control-df_options-pageloader_bgcolor');


    if (!loaderTrigger1.is(':checked')) {
        loaderOption1.css('display', 'none');
        loaderOption2.css('display', 'none');
        loaderOption3.css('display', 'none');
        loaderOption4.css('display', 'none');
    }

    loaderTrigger1.change(function() {
        if (loaderTrigger1.is(':checked')) {
            loaderOption1.css('display', 'block');
            loaderOption2.css('display', 'block');
            loaderOption3.css('display', 'block');
            loaderOption4.css('display', 'block');
        } else if (!loaderTrigger1.is(':checked')) {
            loaderOption1.css('display', 'none');
            loaderOption2.css('display', 'none');
            loaderOption3.css('display', 'none');
            loaderOption4.css('display', 'none');
        }
    });


})(jQuery);

function convertHex(hex) {
    hex = hex.replace('#', '');
    r = parseInt(hex.substring(0, 2), 16);
    g = parseInt(hex.substring(2, 4), 16);
    b = parseInt(hex.substring(4, 6), 16);

    result = 'rgb(' + r + ',' + g + ',' + b + ')';
    return result;
}