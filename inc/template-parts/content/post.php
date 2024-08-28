  <?php
  // Categories
  $cats = get_the_category();
  $is_sticky = is_sticky() ? 'post-sticky' : '';
  $sticky_post_thumbnail = get_field('sticky_post_thumbnail');

  ?>

  <article <?php post_class($is_sticky . ' slide-in js-slide-in'); ?>>
    <div class="post-card">
      <?php if (has_post_thumbnail()) : ?>
        <div class="post-card__image entry-featured">
          <a href="<?php the_permalink(); ?>">
            <?php
            if (is_sticky() && (is_archive() || is_home()) && !empty($sticky_post_thumbnail)) {
              echo wp_get_attachment_image($sticky_post_thumbnail, 'entry');
            } else {
              the_post_thumbnail('entry');
            }
            ?>
          </a>
        </div>
      <?php endif; ?>
      <div class="post-card__text-wrap entry-wrap">
        <div class="post-card__date entry-meta">
          <span class="post-card__categories fs-label"><?php echo get_cat_link($cats) ?></span>
          <?php echo get_date(); ?>
        </div>
        <h2 class="post-card__title entry-title"><a href="<?php the_permalink(); ?>" class="main-link"><?php the_title(); ?></a></h2>
        <?php if (is_sticky())
          echo '<a href="' . esc_url(get_the_permalink()) . '" class="btn sticky-read">Find out more</a>'
        ?>
      </div>
    </div>
  </article>