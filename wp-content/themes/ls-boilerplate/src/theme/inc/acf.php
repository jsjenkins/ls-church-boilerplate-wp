<?php // Advanced Custom Fields settings

// ACF map API
/* function acf_maps_api() {
    
    acf_update_setting('google_api_key', '');
}

add_action('acf/init', 'acf_maps_api'); */

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
            border: 1px solid #ccd0d4;
            margin-top: 35px;
        }
        .acf-flexible-content .layout .acf-fc-layout-handle {
            background-color: #f7f7f7;
        }
        .acf-flexible-content .layout .acf-fc-layout-handle .acf-fc-layout-order {
            color: #ffffff;
            background-color: #555d66;
            font-weight: bold;
        }
        .acf-flexible-content .layout .acf-fc-layout-controls .acf-icon {
            background-color: #ffffff;
            border: 1px solid #ccd0d4;
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
