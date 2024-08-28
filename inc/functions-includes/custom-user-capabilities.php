<?php
/**
 *  Hide dashboard options for every user other than site_admin
 */

$current_user = wp_get_current_user();

if ($current_user->user_login != 'site_admin') {
  add_action('admin_menu', 'remove_menus');
  add_action('admin_init', 'remove_theme_customisation');
  add_filter('acf/settings/show_admin', '__return_false'); // hides ACF menu
  add_action('admin_head', 'hide_live_preview');
  add_action('admin_head', 'hide_menu_location_settings');
}

function remove_menus()
{
  global $submenu;
  unset($submenu['themes.php'][5]); // disables theme change option
  define('DISALLOW_FILE_EDIT', true); // disables theme editor
  define('DISALLOW_FILE_MODS', false); // disables plugin install/update
}


function remove_theme_customisation()
{
  global $submenu;
  foreach ($submenu as $name => $items) {
    if ($name === 'themes.php') {
      foreach ($items as $i => $data) {
        if (in_array('customize', $data, true)) {
          unset($submenu[$name][$i]);
          return;
        }
      }
    }
  }
}

/**
 * Hide 'Manage with Live Preview'
 */

function hide_live_preview()
{
  echo '<style>
          .hide-if-no-customize {
            display: none;
          }
        </style>';
}

function hide_menu_location_settings()
{
  echo '<style>
          .nav-tab-wrapper .nav-tab:last-child {
            display: none;
          }
          .menu-theme-locations {
            display: none;
        </style>';
}