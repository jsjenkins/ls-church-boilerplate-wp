<?php

/*
Plugin Name: CLIENT NAME Plugin
Plugin URI: https://CLIENT.DOMAIN
Description: Plugin that adds necessary content options for the CLIENT NAME theme
Version: 1.0.0
Author: Landslide Creative
Author URI: https://landslidecreative.com
*/

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('landslide_plugin') ) :

class landslide_plugin {
	
	// vars
	var $settings;
	
	
	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	void
	*  @return	void
	*/
	
	function __construct() {
		
		// settings
		// - these will be passed into the field class.
		$this->settings = array(
			'version'	=> '1.0.0',
			'url'		=> plugin_dir_url( __FILE__ ),
			'path'		=> plugin_dir_path( __FILE__ )
		);
		
		
		include_once('functions/landslide-plugin-cpt.php');
		include_once('functions/landslide-plugin-menu.php');
		include_once('functions/landslide-plugin-queries.php');
	}
	
}

// initialize
new landslide_plugin();

// class_exists check
endif;
	
?>