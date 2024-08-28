<?php

/**
 * Disable comments column
 * https://wordpress.stackexchange.com/questions/232802/remove-comment-column-in-all-post-types
 */

function disable_comments()
{
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}

add_action('admin_init', 'disable_comments');


/**
 * Remove pingbacks from comment count
 */

function comment_count($count)
{
    global $id;
    $comments = get_approved_comments($id);
    $comment_count = 0;

    foreach ($comments as $comment) {
        if ($comment->comment_type == '') {
            $comment_count++;
        }
    }

    return $comment_count;
}

add_filter('get_comments_number', 'comment_count', 0);

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

/**
 *
 * Adds or removes things we do not want
 */

// Remove jQuery
function remove_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', false);
    }
}
// add_action('init', 'remove_jquery');

function _scripts()
{
    if (!is_admin()) {
        // NOTE: Removes usage for native Jquery
        wp_deregister_script('jquery');
    }
}

// add_action('wp_enqueue_scripts', '_scripts', PHP_INT_MAX);


/**
 * Disable WordPress Admin Bar for all users but admins.
 */
show_admin_bar(false);

/*
* REMOVE WP EMOJI
* https://www.denisbouquet.com/remove-wordpress-emoji-code/
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

// REMOVE DEFAULT GUTENBERG BLOCK LIBRARY CSS FROM LOADING ON FRONTEND
function remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style'); // REMOVE WOOCOMMERCE BLOCK CSS
    wp_dequeue_style('global-styles'); // REMOVE THEME.JSON
}
add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 100);

// Remove unnecessary SVGs elements from wp_body_open function
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

/**
 * Remove WP embedded js
 * https://wordpress.stackexchange.com/questions/211701/what-does-wp-embed-min-js-do-in-wordpress-4-4
 */
function my_deregister_scripts()
{
    wp_deregister_script('wp-embed');
}

add_action('wp_footer', 'my_deregister_scripts');


// Remove Default Taxonomies (Categories, Tags)
function remove_default_taxonomies()
{
    global $pagenow;

    register_taxonomy('post_tag', array());
    // register_taxonomy('category', array());

    // $tax = array('post_tag', 'category');
    $tax = array('post_tag');

    if ($pagenow == 'edit-tags.php' && in_array($_GET['taxonomy'], $tax)) {
        wp_die('Invalid taxonomy');
    }
}
add_action('init', 'remove_default_taxonomies');
