<?php

// CSS & JS Build Version auto-incremented by gulp-bump
define( 'LS_BUILD_VERSION', '1.0.3' );

// Set $content_width global variable
if( !isset($content_width) ) { $content_width = 1200; }

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if( function_exists('add_theme_support') ) {
    // Add post thumbnail support
    add_theme_support('post-thumbnails');

    // Add image sizes (also uses default sizes from Settings->Media)
    add_image_size('x-small', 400);
    add_image_size('small', 650);
    add_image_size('x-large', 1200);
    add_image_size('square', 600, 600, true);
    add_image_size('small-square', 300, 300, true);

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Enable HTML5 support
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

    // Localisation Support
    load_theme_textdomain('landslide', get_template_directory() . '/languages');
}

/*------------------------------------*\
    Header Scripts & Styles
\*------------------------------------*/

// Add scripts
function ls_enqueue_scripts() {
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        // Remove WP jQuery
        wp_deregister_script( 'jquery' );

        // Add theme scripts
        wp_register_script('jquery', get_template_directory_uri() . '/assets/js/app.js', array(), LS_BUILD_VERSION, false);
        wp_enqueue_script('jquery');
        
    }
}
add_action('init', 'ls_enqueue_scripts');

// Add conditional scripts
/* function ls_enqueue_conditional_scripts()
{
    if ( is_page('page-name') ) {
        wp_register_script('script-name', '', array('theme-scripts'), '1.0.0');
        wp_enqueue_script('script-name');
    }
} 
add_action('wp_print_scripts', 'ls_boilerplate_conditional_scripts'); */

// Add stylesheets
function ls_enqueue_styles() {
    // Add font CSS
    // wp_register_style('fonts', 'FONT_CSS_URL', array(), '1.0.0');
    // wp_enqueue_style('fonts');

    // Add theme CSS
    wp_register_style('theme-styles', get_template_directory_uri() . '/assets/css/app.css', array(), LS_BUILD_VERSION);
    wp_enqueue_style('theme-styles');
}
add_action('wp_enqueue_scripts', 'ls_enqueue_styles');

// Remove Gutenberg CSS from the frontend
function ls_remove_gutenberg_css() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' );
} 
add_action( 'wp_enqueue_scripts', 'ls_remove_gutenberg_css', 100 );

// Remove 'text/css' from stylesheet
function ls_style_type_remove($tag) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}
add_filter('style_loader_tag', 'ls_style_type_remove');

/*------------------------------------*\
    Frontend Functions
\*------------------------------------*/

// Add page slug to body class
function ls_add_slug_to_body_class($classes) {
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}
add_filter('body_class', 'ls_add_slug_to_body_class');

// Setup pagination for archives
function ls_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'next_text' => 'Next',
        'prev_text' => 'Previous'
    ));
}
add_action('init', 'ls_pagination');

// Custom excerpt callback
function ls_excerpt($length_callback = '', $more_callback = '') {
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom excerpt length - call using ls_excerpt('ls_excerpt_default');
function ls_excerpt_default($length) {
    return 20;
}

// Custom more link on post archives
function ls_more_link($more) {
    global $post;
    return ' <a class="text-button read-more" href="' . get_permalink($post->ID) . '">more...</a>';
}
add_filter('excerpt_more', 'ls_more_link');

// Remove invalid rel attribute values in the categorylist
function ls_remove_category_rel($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}
add_filter('the_category', 'ls_remove_category_rel');

// Remove the width and height attributes from inserted images
function ls_remove_size_attributes( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
add_filter('post_thumbnail_html', 'ls_remove_size_attributes', 10 );
add_filter('image_send_to_editor', 'ls_remove_size_attributes', 10 );

/*------------------------------------*\
    Remove Admin Extras
\*------------------------------------*/

// Remove social profile metadata
function ls_remove_user_social( $contactmethods ) {
    unset( $contactmethods['facebook'] );
    unset( $contactmethods['instagram'] );
    unset( $contactmethods['linkedin'] );
    unset( $contactmethods['myspace'] );
    unset( $contactmethods['pinterest'] );
    unset( $contactmethods['soundcloud'] );
    unset( $contactmethods['tumblr'] );
    unset( $contactmethods['twitter'] );
    unset( $contactmethods['youtube'] );
    unset( $contactmethods['wikipedia'] );

    return $contactmethods;
}
add_filter('user_contactmethods', 'ls_remove_user_social');

// Remove extraneous dashboard widgets
function ls_remove_dashboard_widgets() {
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}
add_action('admin_init', 'ls_remove_dashboard_widgets');

/*------------------------------------*\
    Comments
\*------------------------------------*/

// Enable threaded Comments
function ls_enable_threaded_comments() {
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}
add_action('get_header', 'ls_enable_threaded_comments');

// Remove inline Recent Comment styles from wp_head()
function ls_remove_recent_comments_style() {
    global $wp_widget_factory;
    
    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ));
    }
}
add_action('widgets_init', 'ls_remove_recent_comments_style');

// Add custom Gravatar in Settings > Discussion
function ls_custom_gravatar ($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}
add_filter('avatar_defaults', 'ls_custom_gravatar');

// Custom comments callback
function ls_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
    <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
    </div>
<?php if ($comment->comment_approved == '0') : ?>
    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
    <br />
<?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
        <?php
            printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
        ?>
    </div>

    <?php comment_text() ?>

    <div class="reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php }

/*------------------------------------*\
    Actions + Filters
\*------------------------------------*/

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical'); // Output rel=canonical for singular queries.
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Injects rel=shortlink into the head if a shortlink is defined for the current page.

// Add Filters
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebar

add_filter('the_excerpt', 'do_shortcode'); // Allow Shortcodes to be executed in excerpt (manual only)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in excerpt (manual only)

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt

/*------------------------------------*\
    Custom Functions
\*------------------------------------*/

function get_image_directory() 
{
    $image_directory = get_template_directory_uri()."/assets/img";

    return $image_directory;
}

/*------------------------------------*\
    Navigation Menus
\*------------------------------------*/

require get_template_directory() . '/inc/menus.php';

/*------------------------------------*\
    Display Functions
\*------------------------------------*/

require get_template_directory() . '/inc/display.php';

/*------------------------------------*\
    ACF Functions
\*------------------------------------*/

require get_template_directory() . '/inc/acf.php';

/*------------------------------------*\
    Text Editor
\*------------------------------------*/

require get_template_directory() . '/inc/text-editor.php';

/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

// require get_template_directory() . '/inc/shortcodes.php';

/*------------------------------------*\
    Sidebars
\*------------------------------------*/

// require get_template_directory() . '/inc/sidebars.php';

/*------------------------------------*\
    Widgets
\*------------------------------------*/

// require get_template_directory() . '/inc/widgets.php';
