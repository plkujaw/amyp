<?php

/**
 * ------> index.php
 */

get_header();

$current_category = get_query_var('category_name');
$sticky_posts = get_option('sticky_posts');
$paged  = get_query_var('paged');
$posts_per_page = get_option('posts_per_page');
?>

<?php echo
get_template_part('inc/template-parts/parts/page-title');
?>

<section class="content <?php echo $sticky_posts ? 'has-sticky-posts' : '' ?>">
  <div class="container">
    <div class="content__inner">
      <?php
      if ($sticky_posts) {
        global $sticky_post;
        if ($paged < 2) {
          $sticky_posts_query = new WP_Query(array(
            'category_name'  => $current_category,
            'ignore_sticky_posts' => 1,
            'post__in' => $sticky_posts,
            'posts_per_page' => 1,
          ));
          if ($sticky_posts_query->have_posts()) {
            while ($sticky_posts_query->have_posts()) {
              $sticky_posts_query->the_post();
              $sticky_post = get_the_ID();
              get_template_part('inc/template-parts/content/post');
            }
          }
          wp_reset_query();
          $posts_per_page -= 1;
        }
        $args = array(
          'category_name'       => $current_category,
          'ignore_sticky_posts' => 1,
          'paged'               => $paged,
          'posts_per_page'      => $posts_per_page,
        );
        if ($sticky_post) {
          $args['post__not_in'] = array($sticky_post);
        }
        $general_query = new WP_Query($args);

        if ($general_query->have_posts()) {
          while ($general_query->have_posts()) {
            $general_query->the_post();
            get_template_part('inc/template-parts/content/post');
          }
        }
      } else { ?>
        <?php if (have_posts()) { ?>
          <?php while (have_posts()) {
            the_post(); ?>
            <?php echo get_template_part('inc/template-parts/content/post'); ?>
          <?php };
          wp_reset_postdata();
          ?>
      <?php }
      } ?>
    </div>
  </div>

  <?php if (!empty(get_posts_nav_link())) { ?>
    <div class="content__pagination">
      <div class="container">
        <div class="pagination-inner">
          <?php
          $prev_posts = get_previous_posts_link(__('PREV<div class="swiper-button swiper-button-prev"></div>', 'wordpress'));
          $next_posts = get_next_posts_link(__('NEXT<div class="swiper-button swiper-button-next"></div>', 'wordpress'));
          if (is_null($prev_posts)) {
            $prev_posts = '<span class="page-inactive">PREV<div class="swiper-button swiper-button-prev"></div></span>';
          }
          if (is_null($next_posts)) {
            $next_posts = '<span class="page-inactive">NEXT<div class="swiper-button swiper-button-next"></div></span>';
          }
          echo "<div class='pagination__pages'>" . current_paged() . "</div><div class='pagination__nav'>" . "<span class='prev-posts'>" . $prev_posts . "</span><span class='page-separator'>/</span>" . "<span class='next-posts'>" . $next_posts . "</span></div>";
          ?>
        </div>
      </div>
    </div>
  <?php } ?>
  </div>
</section>
<?php get_footer();
