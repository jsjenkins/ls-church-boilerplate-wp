<?php

// ACF map API
function acf_maps_api() {
    
    acf_update_setting('google_api_key', '');
}

add_action('acf/init', 'acf_maps_api');

// Save fields to ../acf-json
function custom_acf_json_save_point( $path ) {
    
    $path = get_stylesheet_directory() . '/../acf-json';
    
    return $path;
    
}

add_filter('acf/settings/save_json', 'custom_acf_json_save_point');

// Load fields from ../acf-json
function custom_acf_json_load_point( $paths ) {
    
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/../acf-json';
    
    return $paths;
    
}

add_filter('acf/settings/load_json', 'custom_acf_json_load_point');

// Add styles for flexible content
function acf_modify_styles() {
    
    ?>
    <style type="text/css">
        .acf-field .acf-editor-wrap iframe {
            width: 100%;
            display: block;
        }
        .acf-field .layout[data-layout=two_column] .acf-editor-wrap iframe{
            height: 300px;
        }
        .acf-flexible-content .layout {
            border: 3px solid #E1E1E1;
        }
        .acf-flexible-content .layout .acf-fc-layout-handle {
            background-color: #E1E1E1;
        }
    </style>
    <?php    
    
}

add_action('acf/input/admin_head', 'acf_modify_styles');

// Remove ACF WYSIWYG styles
function remove_acf_wysiwyg_styles() { ?>
    <script type="text/javascript">
        (function($) {
            acf.add_action('wysiwyg_tinymce_init', function( ed, id, mceInit, $field ){
                $(".acf-field .acf-editor-wrap iframe").removeAttr("style");
            });
        })(jQuery); 
    </script>
<?php }
add_action('acf/input/admin_footer', 'remove_acf_wysiwyg_styles');

// ACF Options Page
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

?>