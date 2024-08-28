<?php add_action('acf/init', 'my_acf_init');
function my_acf_init()
{

  // check function exists
  if (function_exists('acf_register_block_type')) {

    // register a block
    acf_register_block_type(array(
      'name'        => 'block-name',
      'title'        => __('Block Title'),
      'description'    => __('Block Description'),
      'render_callback'  => 'block_render_callback',
      'category'      => 'content',
      'icon'        => 'dashicons-block-default',
      'keywords'      => array(''),
      'mode' => 'edit',
      'supports' => array(
        'align' => 'false',
      ),
      'post_types' => array('page')
    ));
  }
}

function block_render_callback($block)
{

  // convert name ("acf/hero") into path friendly slug ("hero")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from within the "template-parts/blocks" folder
  if (file_exists(get_theme_file_path("/inc/template-parts/blocks/block_{$slug}.php"))) {
    include(get_theme_file_path("/inc/template-parts/blocks/block_{$slug}.php"));
  }
}

// disable default WordPress blocks and enable only custom blocks

add_filter('allowed_block_types', 'theme_blocks');

function theme_blocks($allowed_blocks)
{

  return array(
    'acf/block',
  );
}

// add css for backend block styling.
add_action('after_setup_theme', 'gutenberg_block_styling');
function gutenberg_block_styling(){
	/**
	 * Gutenberg Related Support
	 */
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/dist/css/main.min.css' );
}