<?php

/**
 * Template name: Contact Page
 */
get_header();

$main_text = get_field('contact_main_text');
$background_image = get_field('contact_background_image');

$additional_text = get_field('contact_additional_text');

?>

<section class="contact">
  <div class="container">
    <div class="contact__inner">
      <div class="contact__info">
        <h1 class="fs-header-article slide-in js-slide-in"><?php the_title(); ?></h1>
        <p class="slide-in js-slide-in"><?php echo $additional_text ?></p>
        <div class="contact__details">
          <div class="details-email slide-in js-slide-in">
            <h4>email</h4>
            <p><a href="mailto:<?php echo get_field('email_address', 'option') ?>"><?php echo get_field('email_address', 'option') ?></a></p>
          </div>
          <div class="details-address slide-in js-slide-in">
            <?php get_template_part('inc/template-parts/parts/address') ?>
          </div>
        </div>

      </div>

      <article class="contact__main-text">
        <div class="contact__main-bg">
          <?php echo wp_get_attachment_image($background_image, 'hero') ?>
        </div>
        <p class="fs-h1 slide-in js-slide-in"><?php echo $main_text; ?></p>
      </article>
    </div>
  </div>

</section>

<?php
get_footer()
?>