<?php
get_header();

$cats = get_the_category();
$content = get_field('post_content');
$banner_image = get_field('post_banner_image');
$banner_video_file = get_field('post_banner_video_upload');
$banner_video_embed = get_field('post_banner_video_embed');
?>

<div class="container">
  <section class="single-post__intro">
    <div class="intro-meta slide-in js-slide-in">
      <h4><?php echo get_cat_link($cats) ?></h4>
      <?php echo get_date() ?>
    </div>
    <div class="intro-title">
      <h1 class="fs-header-article slide-in js-slide-in"><?php the_title() ?></h1>
    </div>
  </section>
  <section class="post-share">
    <ul>
      <?php echo get_share_links() ?>
    </ul>
  </section>

  <?php if ($banner_image || $banner_video_embed || $banner_video_file) { ?>
    <section class="single-post__banner slide-in js-slide-in">
      <?php if ($banner_image) {
        echo wp_get_attachment_image($banner_image, 'hero');
      } else if ($banner_video_file) {
        $video_url = wp_get_attachment_url($banner_video_file);
        $video_type = wp_check_filetype($video_url)['type'];
        echo "<div class='video-container'><video src='$video_url' type='$video_type' controls /></div>";
      } else if ($banner_video_embed) {
        echo
        "<div class='video-container'>" . $banner_video_embed . "</div>";
      } ?>
    </section>
  <?php } ?>

  <section class="single-post__content">
    <article class="wysiwyg fs-body-large"><?php echo $content ?></article>
  </section>


  <?php
  $related_posts = new WP_Query(array(
    'posts_per_page' => 2,
    'category__in' => wp_get_post_categories(get_the_ID()),
    'post__not_in' => array(get_the_ID()),
    'orderby' => 'rand'
  )); ?>
  
  <?php
  if ($related_posts->have_posts()) { ?>
    <section class="single-post__related-posts">
      <h3 class="fs-label slide-in js-slide-in">Related</h3>
      <div class="related-posts__container">
      <?php
      while ($related_posts->have_posts()) {
        $related_posts->the_post();
        get_template_part('inc/template-parts/content/post');
      };
    }
      ?>
      </div>
    </section>
</div>
<?php get_footer(); ?>