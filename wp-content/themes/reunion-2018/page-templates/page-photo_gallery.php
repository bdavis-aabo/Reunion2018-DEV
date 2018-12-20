<?php /* Template Name: Page - Photo Gallery */ ?>

<?php get_header() ?>

  <?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

  <div class="blank-space"></div>

  <section class="homepage-introduction page-introduction">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12 col-sm-10 offset-sm-1">
          <div class="page-content">
            <?php while(have_posts()): the_post() ?>
              <?php the_content() ?>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php get_footer() ?>
