<?php

/**
 * The template for displaying the footer
 *
 *
 */

?>
</main>

<footer class="footer">
  <div class="container">
    <div class="footer__logotype">
      <a href="<?php echo esc_url(site_url()); ?>"><?php get_template_part('inc/template-parts/img/amyp-logotype.svg') ?></a>
    </div>
  </div>
  <div class="footer__newsletter">
    <div class="container">
      <h3 class="show-mobile">SUBSCRIBE TO OUR NEWSLETTER</h3>
    </div>
    <?php get_template_part('inc/template-parts/parts/newsletter') ?>
  </div>
  <div class="container">
    <div class="footer__main">
      <div class="footer__menu">
        <h4>HOME</h4>
        <?php wp_nav_menu(array(
          'theme_location' => 'primary-menu',
          'menu_class' => 'main-menu',
          'container' => 'nav',
        )); ?>
      </div>
      <div class="details-address">
        <?php get_template_part('inc/template-parts/parts/address') ?>
      </div>
      <div class="details-social">
        <?php get_template_part('inc/template-parts/parts/social') ?>
      </div>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>
</div>
<!-- #site -->
</body>

</html>