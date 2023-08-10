<?php // Global Section CPT
function create_ls_global_section_post_type()
{
    register_post_type('ls-global-section',
        array(
        'labels' => array(
            'name' => __('Global Sections', 'html5blank'),
            'singular_name' => __('Global Section', 'html5blank'),
            'add_new' => __('Add Global Section', 'html5blank'),
            'add_new_item' => __('Add New Global Section', 'html5blank'),
            'edit_item' => __('Edit Global Section', 'html5blank'),
            'new_item' => __('New Global Section', 'html5blank'),
            'view_item' => __('View Global Section', 'html5blank'),
            'view_items' => __('View Global Sections', 'html5blank'),
            'search_items' => __('Search Global Sections', 'html5blank'),
            'not_found' => __('No Global Sections found', 'html5blank'),
            'not_found_in_trash' => __('No Global Sections found in Trash', 'html5blank'),
        ),
        'public' => true,
        'hierarchical' => false,
        'publicly_queryable' => false,
        'menu_icon' => 'dashicons-businessman',
        'show_in_menu' => false,
        'supports' => array(
            'title'
        ),
        'taxonomies' => array(),
        'can_export' => false
    ));
}

add_action('init', 'create_ls_global_section_post_type');

// Move Global Section under Theme Settings
add_action('admin_menu', 'fix_admin_menu_submenu', 99);
function fix_admin_menu_submenu() {
    add_submenu_page('theme-settings', 'Global Sections', 'Global Sections', 'edit_pages' , 'edit.php?post_type=ls-global-section');
}