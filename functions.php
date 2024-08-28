<?php

/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme
 * @since Theme 1.0
 */



if (!function_exists('theme_support')) :

  function theme_support()
  {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus(
      array(
        'primary-menu' => __('Primary Menu'),
        // 'secondary-menu' => __('Secondary Menu')
      )
    );

    // Register Image sizes
    add_image_size('entry-small', 400); // 400 pixels wide (and unlimited height)
    add_image_size('entry', 800); // 800 pixels wide (and unlimited height)
    add_image_size('entry-large', 1250); // 1250 pixels wide (and unlimited height)
    add_image_size('hero', 2000); // 2000 pixels wide (and unlimited height)

    // Add ACF Options Page
    if (function_exists('acf_add_options_page')) {
      acf_add_options_page(array(
        'page_title'   => 'Website Settings',
        'menu_title'  => 'Website Settings',
        'position' => 61,
      ));
    }
  }
endif;
add_action('after_setup_theme', 'theme_support');

if (!function_exists('theme_preload_webfonts')) :
  function theme_preload_webfonts()
  {
?>
    <link rel="preload" href="<?php echo esc_url(get_theme_file_uri('assets/fonts/WT_Skrappa_Roman.woff')); ?>" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="<?php echo esc_url(get_theme_file_uri('assets/fonts/PiechSans-Regular.woff')); ?>" as="font" type="font/woff" crossorigin>
<?php
  }
endif;
add_action('wp_head', 'theme_preload_webfonts');

// disable gutenberg editor
add_filter('use_block_editor_for_post', '__return_false', 10);

// Implement Additional files
//==========

/**
 * Enqueue styles/scripts
 */
require_once get_template_directory() . '/inc/functions-includes/enqueue.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/inc/functions-includes/extras.php';

/**
 * Load Cleanup file
 */
require_once get_template_directory() . '/inc/functions-includes/wordpress-cleanup.php';

/**
 * Custom User Capabilities
 */
require_once get_template_directory() . '/inc/functions-includes/custom-user-capabilities.php';

/**
 * Google Tag Manager
 */
// require_once get_template_directory() . '/inc/functions-includes/gtm.php';

/**
 * 
 * Login Page Styling
 */
require_once get_template_directory() . '/inc/functions-includes/login-page-styling.php';

/**
 * Load Custom Posts file
 */
require_once get_template_directory() . '/inc/functions-includes/custom-posts.php';

/**
 * Load Custom Taxonomies file
 */
// require_once get_template_directory() . '/inc/functions-includes/custom-taxonomies.php';

/**
 * Load Gutenberg Blocks Registration file
 */
// require get_template_directory() . '/inc/functions-includes/register-blocks.php';

// disable blocks
add_filter('allowed_block_types', 'theme_blocks');

function theme_blocks($allowed_blocks)
{

  return array(
    // 'acf/block',
  );
}
