<?php
get_header();
?>

<div class="portfolio">
  <?php get_template_part('inc/template-parts/parts/page-title'); ?>
  <div class="container">
    <div class="portfolio__inner">
      <?php
      $query = new WP_Query(array(
        'post_type' => 'project',
        'posts_per_page' => -1,
      ));
      if ($query->have_posts()) :
      ?>
        <?php while ($query->have_posts()) : $query->the_post();
          $index = array_search($post, $query->posts); ?>
          <?php echo get_template_part('inc/template-parts/content/project', null, array(
            'index' => $index
          )); ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php get_footer() ?>