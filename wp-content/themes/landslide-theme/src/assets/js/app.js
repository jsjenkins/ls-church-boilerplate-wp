import $ from 'jquery';
import 'what-input';

window.$ = window.jQuery = $;

import './lib/foundation-explicit-pieces';

require('./lib/jquery.fitVids.js');
require('./lib/jquery.matchHeight.js');
// require('./lib/jquery.slick.js');

$(document).ready(function() {

	$(document).foundation();

	$('body').fitVids({
		customSelector: 'iframe[src*="facebook"], iframe[src^="https://livestream.com"]'
	});

	$('nav.main-nav .menu-item-has-children>a, .off-canvas-navigation .menu-item-has-children>a').attr('aria-expanded', "false");

	$('nav.main-nav .menu-item-has-children>a, .off-canvas-navigation .menu-item-has-children>a').click(function(event) {
		event.stopPropagation();
		event.preventDefault();
		if ($(this).parent().hasClass('nav-open')) {
			$('.nav-open .sub-menu').slideUp('fast',
				function() {
				$('.nav-open>a').attr('aria-expanded', "false");
			    $('.nav-open').removeClass('nav-open');
			});
		} else {
			$('.nav-open .sub-menu').hide();
			$('.nav-open').removeClass('nav-open');
			$(this).parent().addClass('nav-open');
			$(this).parent().find('.sub-menu').slideDown('fast');
			$(this).attr('aria-expanded', "true");
		}
	});

	$('#event-filter').submit( function(){
    	event.stopPropagation();
		event.preventDefault();
        window.location.href = $(this).find('select').val();
    });

});