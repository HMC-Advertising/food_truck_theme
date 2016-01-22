// The toggle

jQuery(document).ready(function($){

    jQuery('#show-info').click(function() {
		jQuery(this).addClass('active');
		jQuery('#hide-info').removeClass('active');
		// jQuery('#hide-info').css('display', 'block');
		// jQuery('#show-info').css('display', 'none');
		jQuery.cookie('infocookie','show-info', { path: '/' });
		jQuery('ul.products h4, ul.products .price').css('display','block').addClass('show-info').removeClass('hide-info');
		return false;
	});

	jQuery('#hide-info').click(function() {
		jQuery(this).addClass('active');
		jQuery('#show-info').removeClass('active');
		// jQuery('#hide-info').css('display', 'none');
		// jQuery('#show-info').css('display', 'block');
		jQuery.cookie('infocookie','hide-info', { path: '/' });
		jQuery('ul.products h4, ul.products .price').css('display','none').addClass('hide-info').removeClass('show-info');
		return false;
	});

	if (jQuery.cookie('infocookie')) {
        jQuery('ul.products, #showhide-toggle').addClass(jQuery.cookie('infocookie'));
    }

    if (jQuery.cookie('infocookie') == 'show-info') {
        jQuery('.showhide-toggle #show-info').addClass('active');
        jQuery('.showhide-toggle #hide-info').removeClass('active');
    }

    if (jQuery.cookie('infocookie') == 'hide-info') {
        jQuery('.showhide-toggle #hide-info').addClass('active');
        jQuery('.showhide-toggle #show-info').removeClass('active');
    }

	jQuery('#showhide-toggle a').click(function(event) {
	    event.preventDefault();
	});

});