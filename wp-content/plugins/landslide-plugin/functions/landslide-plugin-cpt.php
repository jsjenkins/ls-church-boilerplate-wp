<?php 

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
        'show_in_quick_edit'=> false,
        'meta_box_cb'       => false,
        'show_admin_column' => false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'staff/department', 'with_front' => false ),
    );

    register_taxonomy( 'department', array( 'staff' ), $args );

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
        'menu_icon' => 'dashicons-businessperson',
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ),
        'taxonomies' => array(
            'department',
        ),
        'can_export' => true,
        'rewrite' => array( 'slug' => 'staff', 'with_front' => false)
    ));
}

add_action('init', 'create_staff_post_type');

// Sermon CPT
function create_sermon_post_type()
{
    $labels = array(
        'name'              => _x( 'Series', 'taxonomy general name' ),
        'singular_name'     => _x( 'Series', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Series' ),
        'all_items'         => __( 'All Series' ),
        'parent_item'       => __( 'Parent Series' ),
        'parent_item_colon' => __( 'Parent Series:' ),
        'edit_item'         => __( 'Edit Series' ),
        'update_item'       => __( 'Update Series' ),
        'add_new_item'      => __( 'Add New Series' ),
        'new_item_name'     => __( 'New Series Name' ),
        'menu_name'         => __( 'Series' ),
        'not_found'         => __( 'No Series found.' )
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_quick_edit'=> false,
        'meta_box_cb'       => false,
        'show_admin_column' => false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'sermons/series', 'with_front' => false ),
    );

    register_taxonomy( 'series', array( 'sermon' ), $args );

    $labels = array(
        'name'              => _x( 'Speakers', 'taxonomy general name' ),
        'singular_name'     => _x( 'Speaker', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Speakers' ),
        'all_items'         => __( 'All Speakers' ),
        'parent_item'       => __( 'Parent Speaker' ),
        'parent_item_colon' => __( 'Parent Speaker:' ),
        'edit_item'         => __( 'Edit Speaker' ),
        'update_item'       => __( 'Update Speaker' ),
        'add_new_item'      => __( 'Add New Speaker' ),
        'new_item_name'     => __( 'New Speaker Name' ),
        'menu_name'         => __( 'Speakers' ),
        'not_found'         => __( 'No Speakers found.' )
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_quick_edit'=> false,
        'meta_box_cb'       => false,
        'show_admin_column' => false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'sermons/speaker', 'with_front' => false ),
    );

    register_taxonomy( 'speaker', array( 'sermon' ), $args );

    register_post_type('sermon',
        array(
        'labels' => array(
            'name' => __('Sermons', 'html5blank'),
            'singular_name' => __('Sermon', 'html5blank'),
            'add_new' => __('Add Sermon', 'html5blank'),
            'add_new_item' => __('Add New Sermon', 'html5blank'),
            'edit_item' => __('Edit Sermon', 'html5blank'),
            'new_item' => __('New Sermon', 'html5blank'),
            'view_item' => __('View Sermon', 'html5blank'),
            'view_items' => __('View Sermons', 'html5blank'),
            'search_items' => __('Search Sermons', 'html5blank'),
            'not_found' => __('No Sermons found', 'html5blank'),
            'not_found_in_trash' => __('No Sermons found in Trash', 'html5blank'),
            'featured_image' => __('Sermon Art', 'html5blank'),
            'set_featured_image' => __('Set Sermon Art', 'html5blank'), 
            'remove_featured_image' => __('Remove Sermon Art', 'html5blank'),
            'use_featured_image' => __('Use Sermon Art', 'html5blank'),
        ),
        'public' => true,
        'hierarchical' => false,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-video',
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ),
        'taxonomies' => array(
            'series',
            'speaker',
        ),
        'can_export' => true,
        'rewrite' => array( 'slug' => 'sermons', 'with_front' => false)
    ));
}

add_action('init', 'create_sermon_post_type');

function remove_wp_seo_meta_box() {
}

add_action('add_meta_boxes', 'remove_wp_seo_meta_box', 100);