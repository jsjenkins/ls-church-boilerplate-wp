<?php 
// ACF functions

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Social Media Links',
        'menu_title'    => 'Social Media',
        'parent_slug'   => 'theme-settings',
    ));
}

function acf_maps_api() {
    
    acf_update_setting('google_api_key', '');
}

add_action('acf/init', 'acf_maps_api');

?>