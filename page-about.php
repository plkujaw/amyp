<?php

/**
 * Template name: About Page
 */
get_header();

$hero_title_1 = get_field('about_hero_text')['title_1'];
$hero_title_2 = get_field('about_hero_text')['title_2'];
$hero_paragraph = get_field('about_hero_text')['paragraph'];

$team_intro_title = get_field('about_team_intro')['title'];
$team_intro_text = get_field('about_team_intro')['text'];

$team_members = get_field('about_team_members');

$is_mobile = wp_is_mobile();

?>

<div class="about">
  <section class="about__hero">
    <div class="container">
      <article>
        <h1 class="fs-h1 about__hero-title">
          <span class="f-stroke slide-in js-slide-in"><?php echo $hero_title_1 ?></span>
          <span class="slide-in js-slide-in"><?php echo $hero_title_2 ?></span>
        </h1>
        <p class="fs-p about__hero-paragraph slide-in js-slide-in"><?php echo $hero_paragraph ?></p>
      </article>
    </div>
  </section>

  <?php if (have_rows('about_main_ticker_tape')) : ?>
    <section class="about__main-ticker">
      <div class="swiper-wrapper">
        <?php while (have_rows('about_main_ticker_tape')) : the_row(); ?>
          <div class="main-ticker__item swiper-slide" style="background-image: url(<?php echo wp_get_attachment_image_url(get_sub_field('item_background_image'), 'hero') ?>)">
            <div class="item__inner">
              <div class="main-text">
                <span class="ticker-item__number fs-hero"><?php echo "0" . get_row_index(); ?></span>
                <span class="ticker-item__text fs-header-article" data-swiper-parallax-x="-400"><?php the_sub_field('item_text') ?><br>
                </span>
              </div>
              <span class="additional-text fs-header-article" data-swiper-parallax-x="-800"><?php the_sub_field('item_additional_text') ?></span>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <div class=" swiper-button swiper-button-next ticker-swiper-button-next">
      </div>
    </section>
  <?php endif; ?>

  <?php if (have_rows('about_overview_items')) : ?>
    <section class="about__overview">
      <div class="container">
        <div class="about__overview-inner">
          <h3 class="fs-p slide-in js-slide-in"><?php the_field('about_overview_title') ?></h3>
          <div class="about__overview-items">
            <?php while (have_rows('about_overview_items')) : the_row(); ?>
              <div class="about__overview-item slide-in js-slide-in">
                <p class="fs-body-large"><?php the_sub_field('heading') ?></p>
                <p class="fs-h1 item-main"><?php the_sub_field('main') ?></p>
                <p><?php the_sub_field('description') ?></p>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>


  <section class="about__team">
    <div class="container">
      <article class="about__team-intro">
        <h3 class="fs-p slide-in js-slide-in"><?php echo $team_intro_title ?></h3>
        <p class="slide-in js-slide-in"><?php echo $team_intro_text ?></p>
      </article>
    </div>
    <div class="about__team-team-members  slide-in js-slide-in">
      <div class="swiper-wrapper">
        <?php foreach ($team_members as $index => $member) {
          $name = $member['name'];
          $picture = $member['picture'];
          $bio = $member['bio'];
          $link = $member['link'];
          $index = $index + 1;
        ?>
          <div class="team-member swiper-slide">
            <div class="team-member__bg">
              <h2 class="fs-massive"><?php echo $name ?></h2>
            </div>
            <div class="container">
              <div class="team-member__wrapper" data-swiper-parallax-x="-30%">
                <picture>
                  <?php echo wp_get_attachment_image($picture, 'entry-large', false, array(
                    'loading' => 'eager',
                  )) ?>
                </picture>
                <h4><?php echo $name ?><span class="index fs-numbers fs-numbers--small"><?php echo sprintf('%02d', $index) ?></span></h4>
                <p><?php echo $bio ?></p>
                <?php if (!empty($link)) { ?>
                  <a href="<?php echo $link['url'] ?>" class="fs-label" target="<?php echo $link['target'] ?>"><?php echo $link['title'] ?></a>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="swiper-nav <?php echo $is_mobile ? 'mobile' : '' ?>">
        <div class="swiper-button swiper-button-prev team-swiper-button-prev"></div>
        <div class="swiper-button swiper-button-next team-swiper-button-next"></div>
      </div>
    </div>
  </section>


  <?php if (have_rows('about_ticker_bottom')) : ?>
    <section class="about__ticker-bottom ticker">
      <div class="ticker__inner">
        <?php while (have_rows('about_ticker_bottom')) : the_row(); ?>
          <span class="fs-label"><?php the_sub_field('item') ?></span>
        <?php endwhile; ?>
      </div>
      <div class="ticker__inner" aria-hidden="true">
        <?php while (have_rows('about_ticker_bottom')) : the_row(); ?>
          <span class="fs-label"><?php the_sub_field('item') ?></span>
        <?php endwhile; ?>
      </div>
    </section>
  <?php endif; ?>
</div>

<?php

get_footer();
?>