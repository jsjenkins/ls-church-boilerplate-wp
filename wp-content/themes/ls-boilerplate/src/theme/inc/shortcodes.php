<?php
// Shortcode functions

function button_shortcode($atts, $content = null) {
    extract( shortcode_atts( array(
        'url' => '#',
        '_blank' => false,
        'cta' => false
    ), $atts ) );
    if($cta) {
        $alert_class = ' secondary';
    }
    if($_blank) {
        $new_window = ' target="_blank"';
    }
    return '<a href="'.$url.'" class="button '.$alert_class.'"'.$new_window.'>'.$content.'</a>';
}

add_shortcode('button', 'button_shortcode');

?>