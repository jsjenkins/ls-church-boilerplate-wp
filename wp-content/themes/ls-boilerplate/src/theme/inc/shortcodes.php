<?php
// Shortcode functions

function button_shortcode($atts, $content = null) {
    extract( shortcode_atts( array(
        'url' => '#',
        'tab' => false,
        'cta' => false
    ), $atts ) );
    if($cta) {
        $alert_class = ' secondary';
    }
    if($tab) {
        $new_window = ' target="_blank"';
    }
    return '<a href="'.$url.'" style="margin-top: 10px;" class="button small'.$alert_class.'"'.$new_window.'>'.$content.'</a>';
}

add_shortcode('button', 'button_shortcode');

?>