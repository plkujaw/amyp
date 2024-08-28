<?php

/**
 * The template for displaying the front page (homepage)
 *
 *
 */
get_header();


$intro_title = get_field('home_intro_title');
$intro_text = get_field('home_intro_text');
$intro_cta = get_field('home_intro_cta');

$news_title = get_field('home_news_title');

$about_title = get_field('home_about_title');
$about_text = get_field('home_about_text');

$portfolio_title = get_field('home_portfolio_title');
$portfolio = get_field('home_portfolio_projects');

$bottom_banner_image = get_field('home_bottom_banner_image');
$bottom_banner_text = get_field('home_bottom_banner_text');

?>

<section class="hero home__hero section-columns">
  <div class="section-columns__inner">
    <div class="container">
      <div class="section-columns__column">
      </div>
      <div class="section-columns__column">
        <article class="hero__text home__hero-text">
          <h1 class="fs-hero slide-in js-slide-in"><?php the_field('home_hero_text') ?>
          </h1>
          <a href="#intro" class="home__hero-scroll fs-label slide-in js-slide-in">SCROLL DOWN</a>
        </article>
      </div>
    </div>
  </div>
</section>

<section class="home__intro section-columns" id="intro">
  <div class="container">
    <div class="home__intro-inner section-columns__inner">
      <div class="section-columns__column">
        <div class="home__intro-title section-columns__title section-columns__title--stroke">
          <h2 class="fs-h1"><?php echo $intro_title ?></h2>
        </div>
      </div>
      <div class="section-columns__column">
        <article class="home__intro-text section-columns__text fs-p">
          <p class="slide-in js-slide-in"><?php echo $intro_text ?></p>
        </article>
        <?php if ($intro_cta) { ?>
          <div class="home__intro-cta section-columns__cta slide-in js-slide-in">
            <a class="btn" href="<?php echo esc_url($intro_cta['url']) ?>"><?php echo $intro_cta['title']; ?></a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>

<?php if (have_rows('home_main_ticker_tape')) : ?>
  <section class="home__main-ticker">
    <div class="home__main-ticker-bg">
      <?php echo wp_get_attachment_image(get_field('home_main_ticker_bg_image'), 'hero') ?>
    </div>
    <div class="home__main-ticker__wrapper">
      <div class="ticker">
        <div class="ticker__inner">
          <?php while (have_rows('home_main_ticker_tape')) : the_row(); ?>
            <div class="main-ticker__item">
              <span class="ticker-item__number fs-h1"><?php echo "0" . get_row_index(); ?></span>
              <span class="ticker-item__text fs-hero"><?php the_sub_field('item') ?></span>
            </div>
          <?php endwhile; ?>
        </div>
        <div class="ticker__inner" aria-hidden="true">
          <?php while (have_rows('home_main_ticker_tape')) : the_row(); ?>
            <div class="main-ticker__item">
              <span class="ticker-item__number fs-h1"><?php echo "0" . get_row_index(); ?></span>
              <span class="ticker-item__text fs-hero"><?php the_sub_field('item') ?></span>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<section class="home__news section-columns">
  <div class="container">
    <div class="home__news-inner section-columns__inner">
      <div class="section-columns__column">
        <div class="home__news-title section-columns__title section-columns__title--stroke">
          <h2 class="fs-h1 slide-in js-slide-in"><?php echo $news_title; ?></h2>
        </div>
      </div>
      <div class="section-columns__column">
        <div class="home__news-posts">
          <?php
          $args = array(
            'post_type' => 'post',
            'posts_per_page' => 6,
            'ignore_sticky_posts' => 1
          );
          $query = new WP_Query($args);
          if ($query->have_posts()) {
            while ($query->have_posts()) {
              $query->the_post();
              get_template_part('inc/template-parts/content/post');
            }
          }
          wp_reset_postdata();
          ?>
        </div>
        <div class="home__news-cta slide-in js-slide-in">
          <a class="btn" href="<?php echo esc_url(get_post_type_archive_link('post')); ?>">READ ALL</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home__about section-columns">
  <div class="home__about-bg">
    <?php
    echo wp_get_attachment_image(get_field('home_about_bg_image'), 'full') ?>
  </div>
  <div class="container">
    <div class="home__about-inner section-columns__inner">
      <div class="section-columns__column">
        <div class="home__about-title section-columns__title section-columns__title--stroke">
          <h2 class="fs-h1"><?php echo $about_title; ?></h2>
        </div>
      </div>
      <div class="section-columns__column">
        <div class="home__about-content">
          <div class="home__about-text">
            <article class="section-columns__text">
              <p class="slide-in js-slide-in"><?php echo $about_text; ?></p>
            </article>
          </div>
          <div class="home__about-tabs">
            <?php if (have_rows('home_about_list')) : ?>
              <ul>
                <?php while (have_rows('home_about_list')) : the_row(); ?>
                  <li tabindex="<?php echo get_row_index() ?>">
                    <span class="fs-h1 slide-in js-slide-in" data-index="<?php echo "0" . get_row_index(); ?>"><?php the_sub_field('title'); ?></span>
                    <div class="tab-content" style="background-image: url(<?php the_sub_field('image') ?>)">
                      <div class="tab-content__inner">
                        <div class="tab-content__inner-text">
                          <p><?php the_sub_field('text'); ?></p>
                        </div>
                      </div>
                    </div>
                  </li>
                <?php endwhile; ?>
              </ul>
            <?php endif; ?>
          </div>
          <div class="home__about-tabs--mobile">
            <?php if (have_rows('home_about_list')) : ?>
              <?php while (have_rows('home_about_list')) : the_row(); ?>
                <div class="tab-content__inner" data-index="<?php echo "0" . get_row_index(); ?>">
                  <div class=" tab-content__inner-text">
                    <p><?php the_sub_field('text'); ?></p>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if (have_rows('home_about_ticker_tape')) : ?>
    <div class="home__about-ticker ticker">
      <div class="ticker__inner">
        <?php while (have_rows('home_about_ticker_tape')) : the_row(); ?>
          <span class="fs-label"><?php the_sub_field('item') ?></span>
        <?php endwhile; ?>
      </div>
      <div class="ticker__inner" aria-hidden="true">
        <?php while (have_rows('home_about_ticker_tape')) : the_row(); ?>
          <span class="fs-label"><?php the_sub_field('item') ?></span>
        <?php endwhile; ?>
      </div>
    </div>
  <?php endif; ?>
</section>

<section class="home__portfolio section-columns">
  <div class="container">
    <div class="home__portfolio-inner section-columns__inner">
      <div class="section-columns__column">
        <div class="home__portfolio-title section-columns__title section-columns__title--stroke">
          <h2 class="fs-h1"><?php echo $portfolio_title; ?></h2>
        </div>
      </div>
      <div class="section-columns__column">
        <div class="home__portfolio-posts slide-in js-slide-in">
          <div class="swiper">
            <div class="swiper-wrapper">
              <?php
              foreach ($portfolio as $post) : setup_postdata($post);
                $index = array_search($post, $portfolio); ?>
                <article class="home__portfolio-post swiper-slide">
                  <div class="home-portfolio__post-inner">
                    <div class="home__portfolio-post-image">
                      <?php the_post_thumbnail('entry-small'); ?>
                    </div>
                    <div class="home__portfolio-post-title">
                      <h3 class="fs-h2"><?php the_title(); ?></h3>
                      <span class="post-index fs-numbers fs-numbers--small">
                        <span><?php echo sprintf('%02d', $index + 1); ?></span><span><?php echo '/' . sprintf('%02d', count($portfolio)); ?></span>
                      </span>
                    </div>
                    <div class="home__portfolio-post-excerpt">
                      <p><?php the_excerpt(); ?></p>
                    </div>
                  </div>
                </article>
              <?php endforeach;
              wp_reset_postdata();
              ?>
            </div>

          </div>
          <div class="swiper-nav">
            <div class="swiper-button swiper-button-prev portfolio-swiper-button-prev"></div>
            <div class="swiper-button swiper-button-next portfolio-swiper-button-next"></div>
          </div>
        </div>
        <div class="home__portfolio-cta slide-in js-slide-in">
          <a class="btn" href="<?php echo esc_url(get_post_type_archive_link('project')); ?>">FIND OUT MORE</a>
        </div>
      </div>
    </div>
  </div>

  <?php
  if (have_rows('home_portfolio_ticker_tape')) : ?>
    <div class="home__portfolio-ticker ticker">
      <div class="ticker__inner">
        <?php while (have_rows('home_portfolio_ticker_tape')) : the_row();
          echo wp_get_attachment_image(get_sub_field('item'), 'entry-small', false, array('loading' => 'eager'));
        ?>
        <?php endwhile; ?>
      </div>
      <div class="ticker__inner" aria-hidden="true">
        <?php while (have_rows('home_portfolio_ticker_tape')) : the_row();
          echo wp_get_attachment_image(get_sub_field('item'), 'entry-small', false, array('loading' => 'eager'));
        ?>
        <?php endwhile; ?>
      </div>
    </div>
  <?php endif;
  ?>

</section>

<section class="home__bottom-banner">
  <?php if ($bottom_banner_text) { ?>
    <div class="home__bottom-banner__text slide-in js-slide-in">
      <?php echo $bottom_banner_text ?>
    </div>
  <?php } ?>
  <div class="home__bottom-banner__image">
    <?php echo wp_get_attachment_image($bottom_banner_image, 'hero'); ?>
  </div>

</section>

<?php get_footer();
