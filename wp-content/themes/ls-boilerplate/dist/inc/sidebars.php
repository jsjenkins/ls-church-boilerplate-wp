<?php
// Sidebar functions

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Main Sidebar
    register_sidebar(array(
        'name' => __('Main Sidebar', 'html5blank'),
        'description' => __('Main sidebar for the site.', 'html5blank'),
        'id' => 'main-sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

?>