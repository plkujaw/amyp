<?php
$index = sprintf('%02d', $args['index'] + 1);
$background_image = get_field('project_backround');
$overlay = get_field('project_overlay');

if ($overlay) {
  $overlay_heading = get_field('project_overlay_content')['heading'];
  $overlay_text = get_field('project_overlay_content')['text'];
  $overlay = 'overlay';
} else {
  $overlay = '';
}
?>

<div class="project-card slide-in js-slide-in">
  <div class="project-card__inner">
    <div class="project-card__image <?php echo $overlay ?>" style="background-image:url(<?php echo wp_get_attachment_image_url($background_image, 'entry') ?>)">
      <?php the_post_thumbnail('entry-small'); ?>
      <div class="project-card__overlay">
        <div class="background"></div>
        <article class="text">
          <?php if (!empty($overlay_heading)) echo "<h3 class='fs-h1'>$overlay_heading</h3>" ?>
          <?php if (!empty($overlay_text)) echo "<p>$overlay_text</p>" ?>
        </article>
      </div>

    </div>
    <div class="project-card__title">
      <h3 class="fs-h2"><?php the_title(); ?></h3>
      <span class="post-index fs-numbers fs-numbers--small">
        <?php echo $index; ?>
      </span>
    </div>
    <div class="project-card__excerpt">
      <p><?php the_excerpt(); ?></p>
    </div>
  </div>
</div>