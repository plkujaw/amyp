<section class="menu">
  <div class="container">
    <div class="menu__wrapper">
      <?php wp_nav_menu(array(
        'theme_location' => 'primary-menu',
        'menu_class' => 'main-menu',
        'container' => 'nav',
      )); ?>
      <div class="menu__details">
        <div class="details-address">
          <?php get_template_part('inc/template-parts/parts/address') ?>
        </div>
        <div class="details-social">
          <?php get_template_part('inc/template-parts/parts/social') ?>
        </div>
      </div>
      <div class="menu__graphic">
        <lottie-player autoplay loop mode="svg" src="<?php echo esc_url(get_theme_file_uri('/assets/turbine.json')) ?>" style=" width: 80%;  margin-left: auto; margin-bottom: -25%;">
        </lottie-player>
      </div>
    </div>
  </div>
</section>