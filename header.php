<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and start of the <body> section
 *
 */

$body_class = 'preload ';

if (wp_is_mobile()) {
  $body_class .= 'mobile';
} else {
  $body_class .= '';
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <?php wp_head(); ?>
</head>

<body <?php body_class($body_class); ?>>
  <?php get_template_part('inc/template-parts/parts/menu') ?>
  <?php wp_body_open(); ?>
  <div id="site">
    <header class="header">
      <div class="container">
        <div class="header__row">
          <div class="header__logotype">
            <a href="<?php echo esc_url(site_url()); ?>"><?php get_template_part('inc/template-parts/img/amyp-logotype.svg') ?></a>
          </div>
          <div class="header__menu">
            <button class="header__menu-button js-mobile-menu-trigger" type="button" aria-expanded="false">
              <span class="header__circle header__circle--1"></span>
              <span class="header__circle header__circle--2"></span>
            </button>
          </div>
        </div>
      </div>
    </header>
    <main>