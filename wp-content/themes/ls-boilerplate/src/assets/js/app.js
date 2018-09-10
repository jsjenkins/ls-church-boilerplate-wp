import $ from 'jquery';

import whatInput from 'what-input';

window.$ = window.jQuery = $;

require('jquery-migrate');
jQuery.migrateMute = true;

import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

require('./lib/jquery.fitVids.js');

$(document).ready(function() {

	$(document).foundation();

	$('body').fitVids({
		customSelector: 'iframe[src*="facebook"], iframe[src^="https://livestream.com"]'
	});

});