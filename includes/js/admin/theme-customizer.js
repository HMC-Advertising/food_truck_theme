/* Theme Customizer JavaScript */
/*-----------------------------------------------------------------------------------*/

jQuery(window).load(function($) {

    function is_part_of_object(needle, object) {
        for (var i in object) {
            if (object[i] === needle) {
                return (true);
            }
        }
        return (false);
    }

    function loadVariants(selectField) {

        var _dataID = selectField.data('customize-setting-link').replace(/family/, "weight");
        var _font = jQuery('option:selected', selectField).val();
        var _customFont = jQuery('select[data-customize-setting-link="df_options[body_font_family]"] option:selected').val();
        var _variants = _wpCustomizeSettings.settings['list_font_weights']['value'][_font];
        var _customVariants = _wpCustomizeSettings.settings['list_font_weights']['value'][_customFont];
        var _DefaultVariant = _wpCustomizeSettings.settings['list_font_weights']['value']['Libre Baskerville'];

        if (jQuery('input[data-customize-setting-link="df_options[custom_fonts]"]').is(':checked')) {
            jQuery('input[name="_customize-radio-' + _dataID + '"]').each(function() {
                if (!is_part_of_object(jQuery(this).val(), _variants)) {
                    jQuery(this).parent().hide();
                } else {
                    jQuery(this).parent().show();
                }
            });
        } else {
            jQuery('input[name="_customize-radio-' + _dataID + '"]').each(function() {
                if (!is_part_of_object(jQuery(this).val(), _DefaultVariant)) {
                    jQuery(this).parent().hide();
                } else {
                    jQuery(this).parent().show();
                }
            });
        }
    }

    var checkedTrigger = jQuery('#customize-control-df_options-custom_fonts input');

    jQuery('select[data-customize-setting-link]').each(function() {
        loadVariants(jQuery(this));
    }).on('change', function() {
        loadVariants(jQuery(this));
    });

    if (!checkedTrigger.is(':checked')) {
        loadVariants(jQuery('select[data-customize-setting-link]'));
    }

    checkedTrigger.change(function() {
        if (checkedTrigger.is(':checked')) {
            loadVariants(jQuery('select[data-customize-setting-link]'));
        } else if (!checkedTrigger.is(':checked')) {
            loadVariants(jQuery('select[data-customize-setting-link]'));
        }
    });

});

// =============================================================================
// General
// =============================================================================

jQuery(document).ready(function($) {

// =============================================================================
// Typography
// =============================================================================

    var typoTrigger1 = $('#customize-control-df_options-custom_fonts input');
    var typoTrigger2 = $('#customize-control-df_options-custom_font_subsets input');

    var typoOption1 = $('#customize-control-df_options-logo_font_family');
    var typoOption2 = $('#customize-control-df_options-navbar_font_family');
    var typoOption3 = $('#customize-control-df_options-headings_font_family');
    var typoOption4 = $('#customize-control-df_options-body_font_family');
    var typoOption5 = $('#customize-control-df_options-custom_font_subset_cyrillic');
    var typoOption6 = $('#customize-control-df_options-custom_font_subset_greek');
    var typoOption7 = $('#customize-control-df_options-custom_font_subset_vietnamese');

    if (!typoTrigger1.is(':checked')) {
        typoOption1.css('display', 'none');
        typoOption2.css('display', 'none');
        typoOption3.css('display', 'none');
        typoOption4.css('display', 'none');
    }

    if (!typoTrigger2.is(':checked')) {
        typoOption5.css('display', 'none');
        typoOption6.css('display', 'none');
        typoOption7.css('display', 'none');
    }

    typoTrigger1.change(function() {
        if (typoTrigger1.is(':checked')) {
            typoOption1.css('display', 'block');
            typoOption2.css('display', 'block');
            typoOption3.css('display', 'block');
            typoOption4.css('display', 'block');
        } else if (!typoTrigger1.is(':checked')) {
            typoOption1.css('display', 'none');
            typoOption2.css('display', 'none');
            typoOption3.css('display', 'none');
            typoOption4.css('display', 'none');
        }
    });

    typoTrigger2.change(function() {
        if (typoTrigger2.is(':checked')) {
            typoOption5.css('display', 'block');
            typoOption6.css('display', 'block');
            typoOption7.css('display', 'block');
        } else if (!typoTrigger2.is(':checked')) {
            typoOption5.css('display', 'none');
            typoOption6.css('display', 'none');
            typoOption7.css('display', 'none');
        }
    });

// =============================================================================
// Button
// =============================================================================
    var buttonStyleTrigger1 = $('#customize-control-df_options-button_style input[value="flat"]');
    var buttonStyleTrigger2 = $('#customize-control-df_options-button_style input[value="3d"]');
    var buttonStyleTrigger3 = $('#customize-control-df_options-button_style input[value="outline"]');
    var buttonStyle = $('#customize-control-df_options-button_style input');

    var buttonBgColorTrigger = $('#customize-control-df_options-button_background_color');
    var buttonBgColorHoverTrigger = $('#customize-control-df_options-button_background_color_hover');
    var buttonBtmColorTrigger = $('#customize-control-df_options-button_bottom_color');
    var buttonBtmColorHoverTrigger = $('#customize-control-df_options-button_bottom_color_hover');

    if (buttonStyleTrigger1.is(':checked')) {
        buttonBgColorTrigger.css('display', 'block');
        buttonBgColorHoverTrigger.css('display', 'block');
        buttonBtmColorTrigger.css('display', 'none');
        buttonBtmColorHoverTrigger.css('display', 'none');
    }

    if (buttonStyleTrigger2.is(':checked')) {
        buttonBgColorTrigger.css('display', 'block');
        buttonBgColorHoverTrigger.css('display', 'block');
        buttonBtmColorTrigger.css('display', 'block');
        buttonBtmColorHoverTrigger.css('display', 'block');
    }

    if (buttonStyleTrigger3.is(':checked')) {
        buttonBgColorTrigger.css('display', 'none');
        buttonBgColorHoverTrigger.css('display', 'none');
        buttonBtmColorTrigger.css('display', 'none');
        buttonBtmColorHoverTrigger.css('display', 'none');
    }

    buttonStyle.change(function() {
        if ($(this).val() === 'flat') {
            buttonBgColorTrigger.css('display', 'block');
            buttonBgColorHoverTrigger.css('display', 'block');
            buttonBtmColorTrigger.css('display', 'none');
            buttonBtmColorHoverTrigger.css('display', 'none');
        } else if ($(this).val() === '3d') {
            buttonBgColorTrigger.css('display', 'block');
            buttonBgColorHoverTrigger.css('display', 'block');
            buttonBtmColorTrigger.css('display', 'block');
            buttonBtmColorHoverTrigger.css('display', 'block');
        } else if ($(this).val() === 'outline') {
            buttonBgColorTrigger.css('display', 'none');
            buttonBgColorHoverTrigger.css('display', 'none');
            buttonBtmColorTrigger.css('display', 'none');
            buttonBtmColorHoverTrigger.css('display', 'none');
        }
    });


// =============================================================================
// Header
// =============================================================================
    var navbarTopTrigger1 = $('#customize-control-df_options-header_navbar_position input[value="center"]');
    var navbarTopTrigger2 = $('#customize-control-df_options-header_navbar_position input[value="left"]');
    var navbarTopTrigger3 = $('#customize-control-df_options-header_navbar_position input[value="right"]');
    var navbarTopOption1 = $('#customize-control-df_options-header_navbar_height');
    // var navbarTopOption2  = $('#customize-control-x_logo_adjust_navbar_top');
    // var navbarTopOption3  = $('#customize-control-x_navbar_adjust_links_top');

    var navbarSideTrigger1 = $('#customize-control-df_options-header_navbar_position input[value="fixed-left"]');
    var navbarSideTrigger2 = $('#customize-control-df_options-header_navbar_position input[value="fixed-right"]');
    var navbarSideOption1 = $('#customize-control-df_options-header_navbar_width');
    // var navbarSideOption2  = $('#customize-control-x_logo_adjust_navbar_side');
    // var navbarSideOption3  = $('#customize-control-x_navbar_adjust_links_side');
    // var navbarSideDesc1    = $('#customize-control-x_header_description_navbar_width_height');
    // var navbarSideDesc2    = $('#customize-control-x_header_description_navbar_adjust');
    var navbarClassic1 = $('#customize-control-df_options-header_navbar_position input[value="classic-left"]');
    var navbarClassic2 = $('#customize-control-df_options-header_navbar_position input[value="classic-right"]');
    var navbarClassicOption = $('#customize-control-df_options-header_navbar_classic_width');

    var widgetbarTrigger = $('#customize-control-df_options-header_widget_bar input[value="0"]');
    var widgetbarOption1 = $('#customize-control-df_options-widgetbar_bgbutton');
    var widgetbarOption2 = $('#customize-control-df_options-widgetbar_bgbutton_hover');

    var topbarTrigger = $('#customize-control-df_options-header_topbar input');
    var topbarOption1 = $('#customize-control-df_options-header_topbar_content');

    var groupNavbarPosition = $('#customize-control-df_options-header_navbar_position input');
    var groupHeaderWidgetAreas = $('#customize-control-df_options-header_widget_bar input');

    if (navbarTopTrigger1.is(':checked') || navbarTopTrigger2.is(':checked') || navbarTopTrigger3.is(':checked')) {
        navbarTopOption1.css('display', 'block');
        //  navbarTopOption2.css('display', 'block');
        //   navbarTopOption3.css('display', 'block');
        navbarSideOption1.css('display', 'none');
        //   navbarSideOption2.css('display', 'none');
        //   navbarSideOption3.css('display', 'none');
        //   navbarSideDesc1.css('display', 'none');
        //   navbarSideDesc2.css('display', 'none');
        navbarClassicOption.css('display', 'none');
    }

    if (navbarSideTrigger1.is(':checked') || navbarSideTrigger2.is(':checked')) {
        navbarTopOption1.css('display', 'block');
        //   navbarTopOption2.css('display', 'block');
        //   navbarTopOption3.css('display', 'block');
        navbarSideOption1.css('display', 'block');
        //   navbarSideOption2.css('display', 'block');
        //   navbarSideOption3.css('display', 'block');
        //   navbarSideDesc1.css('display', 'block');
        //   navbarSideDesc2.css('display', 'block');
        navbarClassicOption.css('display', 'none');
    }

    if (navbarClassic1.is(':checked') || navbarClassic2.is(':checked')) {
        navbarClassicOption.css('display', 'block');
        navbarSideOption1.css('display', 'none');
    }

    if (widgetbarTrigger.is(':checked')) {
        widgetbarOption1.css('display', 'none');
        widgetbarOption2.css('display', 'none');
    }

    // if (!topbarTrigger.is(':checked')) {
    //   topbarOption1.css('display', 'none');
    // }

    groupNavbarPosition.change(function() {
        if ($(this).val() === 'center' || $(this).val() === 'left' || $(this).val() === 'right') {
            navbarTopOption1.css('display', 'block');
            //     navbarTopOption2.css('display', 'block');
            //     navbarTopOption3.css('display', 'block');
            navbarSideOption1.css('display', 'none');
            //     navbarSideOption2.css('display', 'none');
            //     navbarSideOption3.css('display', 'none');
            //     navbarSideDesc1.css('display', 'none');
            //     navbarSideDesc2.css('display', 'none');
            navbarClassicOption.css('display', 'none');
        } else if ($(this).val() === 'fixed-left' || $(this).val() === 'fixed-right') {
            navbarTopOption1.css('display', 'block');
            //     navbarTopOption2.css('display', 'block');
            //     navbarTopOption3.css('display', 'block');
            navbarSideOption1.css('display', 'block');
            //     navbarSideOption2.css('display', 'block');
            //     navbarSideOption3.css('display', 'block');
            //     navbarSideDesc1.css('display', 'block');
            //     navbarSideDesc2.css('display', 'block');
            navbarClassicOption.css('display', 'none');
        } else if ($(this).val() === 'classic-left' || $(this).val() === 'classic-right') {
            navbarClassicOption.css('display', 'block');
            navbarSideOption1.css('display', 'none');
        }
    });

    groupHeaderWidgetAreas.change(function() {
        if ($(this).val() === "0") {
            widgetbarOption1.css('display', 'none');
            widgetbarOption2.css('display', 'none');
        } else {
            widgetbarOption1.css('display', 'block');
            widgetbarOption2.css('display', 'block');
        }
    });

    topbarTrigger.change(function() {
        if (topbarTrigger.is(':checked')) {
            topbarOption1.css('display', 'block');
        } else {
            topbarOption1.css('display', 'none');
        }
    });


    /*================================================================
     * Add additional customizer admin support for the Theme Customizer.
     *================================================================*/

    var previewDiv = $('#customize-preview');

    $('.wp-full-overlay-header').append('<div id="df-customizer-tools"></div>');

    var dfTools = $('#df-customizer-tools');

    dfTools.append('<button id="trigger-overlay" class="button">Custom CSS</button>');
    previewDiv.prepend('<div id="overlay-customcss"><form><textarea id="csstextarea"></textarea></form></div>');

    var cssWindow = $('#customize-preview #overlay-customcss');
    var cssText = $('#customize-preview #overlay-customcss form textarea');
    var ogText = $("li#customize-control-df_options-custom_styles").children().children('textarea');

    // click
    $('#trigger-overlay').click(function(e) {

        e.preventDefault();

        // turn off
        if ($(this).hasClass('btn-active')) {

            $(this).removeClass('btn-active');

            cssWindow.fadeToggle('fast');

            ogText.val(cssText.val()).keyup();

            // turn on
        } else {

            $(this).addClass('btn-active');

            // fade in
            cssWindow.fadeToggle('fast');

            // empty
            cssText.val('');

            // focus
            cssText.focus();

            // fill
            cssText.val(ogText.val());

        }

    });

    HTMLTextAreaElement.prototype.getCaretPosition = function() { //return the caret position of the textarea
        return this.selectionStart;
    };
    HTMLTextAreaElement.prototype.setCaretPosition = function(position) { //change the caret position of the textarea
        this.selectionStart = position;
        this.selectionEnd = position;
        this.focus();
    };
    HTMLTextAreaElement.prototype.hasSelection = function() { //if the textarea has selection then return true
        if (this.selectionStart == this.selectionEnd) {
            return false;
        } else {
            return true;
        }
    };
    HTMLTextAreaElement.prototype.getSelectedText = function() { //return the selection text
        return this.value.substring(this.selectionStart, this.selectionEnd);
    };
    HTMLTextAreaElement.prototype.setSelection = function(start, end) { //change the selection area of the textarea
        this.selectionStart = start;
        this.selectionEnd = end;
        this.focus();
    };

    var textarea = document.getElementById('csstextarea');

    textarea.onkeydown = function(event) {

        //support tab on textarea
        if (event.keyCode == 9) { //tab was pressed
            var newCaretPosition;
            newCaretPosition = textarea.getCaretPosition() + "    ".length;
            textarea.value = textarea.value.substring(0, textarea.getCaretPosition()) + "    " + textarea.value.substring(textarea.getCaretPosition(), textarea.value.length);
            textarea.setCaretPosition(newCaretPosition);
            return false;
        }
        if (event.keyCode == 8) { //backspace
            if (textarea.value.substring(textarea.getCaretPosition() - 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
                var newCaretPosition;
                newCaretPosition = textarea.getCaretPosition() - 3;
                textarea.value = textarea.value.substring(0, textarea.getCaretPosition() - 3) + textarea.value.substring(textarea.getCaretPosition(), textarea.value.length);
                textarea.setCaretPosition(newCaretPosition);
            }
        }
        if (event.keyCode == 37) { //left arrow
            var newCaretPosition;
            if (textarea.value.substring(textarea.getCaretPosition() - 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
                newCaretPosition = textarea.getCaretPosition() - 3;
                textarea.setCaretPosition(newCaretPosition);
            }
        }
        if (event.keyCode == 39) { //right arrow
            var newCaretPosition;
            if (textarea.value.substring(textarea.getCaretPosition() + 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
                newCaretPosition = textarea.getCaretPosition() + 3;
                textarea.setCaretPosition(newCaretPosition);
            }
        }
    }

});