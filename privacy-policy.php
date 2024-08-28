<?php

/**
 * 
 * 
 */
get_header();
?>
<div class="container">
  <div class="section-columns">
    <div class="section-columns__inner content">
      <div class="section-columns__column">
        <div class="content__meta">
          <p class="content-subtitle fs-label">LEGAL</p>
          <p class="content-date fs-numbers fs-numbers--small"><?php the_time('Y') ?></p>
        </div>
      </div>
      <div class="section-columns__column">
        <div class="content__main">
          <h1 class="content-title fs-h1"><?php the_title(); ?></h1>
          <article class="wysiwyg fs-body-large"><?php the_content(); ?></article>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

get_footer();
?>