<?php /*

// Staff CPT
function create_staff_post_type()
{
    $labels = array(
        'name'              => _x( 'Departments', 'taxonomy general name' ),
        'singular_name'     => _x( 'Department', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Departments' ),
        'all_items'         => __( 'All Departments' ),
        'parent_item'       => __( 'Parent Department' ),
        'parent_item_colon' => __( 'Parent Department:' ),
        'edit_item'         => __( 'Edit Department' ),
        'update_item'       => __( 'Update Department' ),
        'add_new_item'      => __( 'Add New Department' ),
        'new_item_name'     => __( 'New Department Name' ),
        'menu_name'         => __( 'Departments' ),
        'not_found'         => __( 'No Departments found.' )
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'about/staff/department', 'with_front' => false ),
    );

    register_taxonomy( 'department', array( 'messages' ), $args );

    register_post_type('staff',
        array(
        'labels' => array(
            'name' => __('Staff', 'html5blank'),
            'singular_name' => __('Staff Member', 'html5blank'),
            'add_new' => __('Add Staff Member', 'html5blank'),
            'add_new_item' => __('Add New Staff Member', 'html5blank'),
            'edit_item' => __('Edit Staff Member', 'html5blank'),
            'new_item' => __('New Staff Member', 'html5blank'),
            'view_item' => __('View Staff Member', 'html5blank'),
            'view_items' => __('View Staff Members', 'html5blank'),
            'search_items' => __('Search Staff Members', 'html5blank'),
            'not_found' => __('No Staff Members found', 'html5blank'),
            'not_found_in_trash' => __('No Staff Members found in Trash', 'html5blank'),
            'featured_image' => __('Staff Member Headshot', 'html5blank'),
            'set_featured_image' => __('Set Staff Member Headshot', 'html5blank'), 
            'remove_featured_image' => __('Remove Staff Member Headshot', 'html5blank'),
            'use_featured_image' => __('Use Staff Member Headshot', 'html5blank'),
        ),
        'public' => true,
        'hierarchical' => false,
        'has_archive' => true,
        'menu_icon' => 'dashicons-businessman',
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ),
        'taxonomies' => array(
            'department',
        ),
        'can_export' => true,
        'rewrite' => array( 'slug' => 'about/staff', 'with_front' => false)
    ));
}

add_action('init', 'create_staff_post_type');

function remove_wp_seo_meta_box() {
}

add_action('add_meta_boxes', 'remove_wp_seo_meta_box', 100); */