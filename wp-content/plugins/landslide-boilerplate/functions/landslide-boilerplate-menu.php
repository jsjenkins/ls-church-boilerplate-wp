<?php // Admin menu functions

// Reorder admin menu
function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    
    return array(
        'index.php', // Dashboard

        'separator1', // First separator
        'edit.php', // Posts
        'edit.php?post_type=page', // Pages
        'theme-settings', // Theme Settings
        
        'separator2', // Second separator
        'gf_edit_forms', // Forms
        'upload.php', // Media
        'users.php', // Users

        'separator-last', // Last separator
        
        'themes.php', // Appearance
        'wpseo_dashboard', // SEO
        'options-general.php', // Settings
        'plugins.php', // Plugins
        'tools.php', // Tools
        
        
    );
}
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');

// Remove pages from admin menu
function remove_pages_from_menu() {

    $current_user = wp_get_current_user();
    if( $current_user->user_login != 'landslide' ) {
        remove_menu_page( 'edit.php?post_type=acf-field-group');
        remove_menu_page( 'plugins.php');
    }
}
add_action( 'admin_menu', 'remove_pages_from_menu' );

// Add ACF options page
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Social Media',
        'menu_title'    => 'Social Media',
        'parent_slug'   => 'theme-settings',
    ));
}

// Move yoast priority lower
function yoast_to_bottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom');
