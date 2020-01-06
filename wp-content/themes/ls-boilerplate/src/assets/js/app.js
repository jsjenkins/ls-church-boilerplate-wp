import $ from 'jquery';
import 'what-input';

window.$ = window.jQuery = $;

require('foundation-sites');

// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

require('./lib/jquery.fitVids.js');

$(document).foundation();

$(document).ready(function() {

	$('body').fitVids({
		customSelector: 'iframe[src*="facebook"], iframe[src^="https://livestream.com"]'
	});

});