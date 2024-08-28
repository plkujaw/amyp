<?php

/**
 * Custom posts for use with this theme
 *
 *
 */

add_action('init', 'project_register_post_type');
function project_register_post_type()
{
  $args = [
    'label'  => esc_html__('Projects', 'text-domain'),
    'labels' => [
      'menu_name'          => esc_html__('Projects', 'amyp'),
      'name_admin_bar'     => esc_html__('Project', 'amyp'),
      'add_new'            => esc_html__('Add Project', 'amyp'),
      'add_new_item'       => esc_html__('Add new Project', 'amyp'),
      'new_item'           => esc_html__('New Project', 'amyp'),
      'edit_item'          => esc_html__('Edit Project', 'amyp'),
      'view_item'          => esc_html__('View Project', 'amyp'),
      'update_item'        => esc_html__('View Project', 'amyp'),
      'all_items'          => esc_html__('All Projects', 'amyp'),
      'search_items'       => esc_html__('Search Projects', 'amyp'),
      'parent_item_colon'  => esc_html__('Parent Project', 'amyp'),
      'not_found'          => esc_html__('No Projects found', 'amyp'),
      'not_found_in_trash' => esc_html__('No Projects found in Trash', 'amyp'),
      'name'               => esc_html__('Projects', 'amyp'),
      'singular_name'      => esc_html__('Project', 'amyp'),
    ],
    'public'              => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'show_in_rest'        => true,
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'has_archive'         => true,
    'query_var'           => false,
    'can_export'          => true,
    'rewrite_no_front'    => false,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-portfolio',
    'supports' => [
      'title',
      'thumbnail',
      'excerpt',
    ],

    'rewrite' => [
      'slug' => 'portfolio',
    ]

  ];

  register_post_type('project', $args);
}
