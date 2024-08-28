<?php

// Styles/scripts enqueue

if (!function_exists('theme_styles')) :

  function theme_styles()
  {
    wp_enqueue_style(
      'theme-styles',
      get_stylesheet_directory_uri() . '/assets/dist/css/main.min.css',
      array(),
      filemtime(get_stylesheet_directory() . '/assets/dist/css/main.min.css'),
    );
    wp_enqueue_style('theme-styles');
  }

endif;

if (!function_exists('theme_scripts')) :

  function theme_scripts()
  {
    if (file_exists(get_stylesheet_directory() . '/assets/dist/js/vendor.min.js')) {
      wp_enqueue_script(
        'vendor-scripts',
        get_stylesheet_directory_uri() . '/assets/dist/js/vendor.min.js',
        false,
        false,
        true
      );
    }

    wp_enqueue_script(
      'theme-script',
      get_stylesheet_directory_uri() . '/assets/dist/js/main.min.js',
      false,
      filemtime(get_stylesheet_directory() . '/assets/dist/js/main.min.js'),
      true
    );
  }

endif;

add_action('wp_enqueue_scripts', 'theme_styles');
add_action('wp_enqueue_scripts', 'theme_scripts');
