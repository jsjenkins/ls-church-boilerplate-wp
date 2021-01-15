<?php

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 1200;
}

if (function_exists('add_theme_support'))
{

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');

    // Image sizes - original ratio (Theme also uses default thumbnails from Settings->Media)
    add_image_size('x-small', 400); // Small Thumbnail
    add_image_size('small', 650); // Small Thumbnail
    add_image_size('x-large', 1200); // Extra Large Thumbnail
    
    // Image sizes - square
    add_image_size('square', 600, 600, true);
    add_image_size('small-square', 300, 300, true);

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Enable HTML5 support
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
    Functions
\*------------------------------------*/

// Add header scripts
function ls_boilerplate_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        // Remove WP jQuery
        wp_deregister_script( 'jquery' );

        // Add theme scripts
        wp_register_script('jquery', get_template_directory_uri() . '/assets/js/app.js', array(), '1.0.0', false);
        wp_enqueue_script('jquery');
        
    }
}

/* Add conditional scripts
function ls_boilerplate_conditional_scripts()
{
    if ( is_page('page-name') ) {
        wp_register_script('script-name', '', array('theme-scripts'), '1.0.0');
        wp_enqueue_script('script-name');
    }
} */

// Add stylesheets
function ls_boilerplate_styles()
{
    // Custom CSS
    wp_register_style('theme-styles', get_template_directory_uri() . '/assets/css/app.css', array(), '1.0.0');
    // Register CSS
    wp_enqueue_style('theme-styles');
}

// Remove 'text/css' from our enqueued stylesheet
function ls_boilerplate_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class
function add_slug_to_body_class($classes)
{
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

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    
    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ));
    }
}

// Setup pagination for posts lists
function ls_boilerplate_pagination()
{
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

// Custom excerpts callback
function ls_boilerplate_excerpt($length_callback = '', $more_callback = '')
{
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

// Custom Excerpt - call using ls_boilerplate_excerpt('ls_boilerplate_excerpt_index');
function ls_excerpt_index($length)
{
    return 20;
}

// Custom View Article link to Post
function ls_boilerplate_article_more($more)
{
    global $post;
    return ' <a class="view-article" href="' . get_permalink($post->ID) . '">more...</a>';
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
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

// Remove social profile metadata
function ls_boilerplate_remove_user_social( $contactmethods ) 
{
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

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'ls_boilerplate_header_scripts'); // Add Custom Scripts to wp_head
// add_action('wp_print_scripts', 'ls_boilerplate_conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_enqueue_scripts', 'ls_boilerplate_styles'); // Add Theme Stylesheet
add_action('init', 'ls_boilerplate_pagination'); // Add our HTML5 Pagination
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'ls_boilerplate_article_more'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('style_loader_tag', 'ls_boilerplate_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('user_contactmethods', 'ls_boilerplate_remove_user_social');

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

/*------------------------------------*\
    Custom Functions
\*------------------------------------*/

function get_image_directory() 
{
    $image_directory = get_template_directory_uri()."/assets/img";

    return $image_directory;
}

/*------------------------------------*\
    Menus
\*------------------------------------*/

require get_template_directory() . '/inc/menus.php';

/*------------------------------------*\
    Sidebars
\*------------------------------------*/

require get_template_directory() . '/inc/sidebars.php';

/*------------------------------------*\
    Widgets
\*------------------------------------*/

require get_template_directory() . '/inc/widgets.php';

/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

require get_template_directory() . '/inc/shortcodes.php';

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

?>
