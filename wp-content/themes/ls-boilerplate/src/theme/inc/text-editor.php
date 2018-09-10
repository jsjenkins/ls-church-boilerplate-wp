<?php 
// Text Editor Cusomtizations

// Remove default format select
function remove_default_format_select( $buttons ) {

    $remove = array( 'formatselect' );

    return array_diff( $buttons, $remove );
 }
add_filter( 'mce_buttons', 'remove_default_format_select' );

// Add custom format select
function custom_format_button( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons', 'custom_format_button' );


// Define custom formats
function add_custom_formats( $init_array ) {  
    $style_formats = array(
            array(
                'title' => 'Paragraph',
                'block' => 'p'
                ),
            array(
                'title' => 'Heading 2',
                'block' => 'h2'
                ),
            array(
                'title' => 'Heading 3',
                'block' => 'h3'
                ),
            array(
                'title' => 'Heading 4',
                'block' => 'h4'
                ),
            array(
                'title' => 'Heading 5',
                'block' => 'h5'
                ),
            array(
                'title' => 'Heading 6',
                'block' => 'h6'
                )
        );
    $init_array['style_formats'] = json_encode( $style_formats );  

    return $init_array;  

} 
add_filter( 'tiny_mce_before_init', 'add_custom_formats' );

function add_admin_font() {
    wp_enqueue_style( 'admin-font', '' );
}

// add_action( 'admin_enqueue_scripts', 'add_admin_font' );

function add_editor_styles() {
    add_editor_style( 'assets/admin-css/text-editor.css' );
}
add_action( 'admin_init', 'add_editor_styles' );