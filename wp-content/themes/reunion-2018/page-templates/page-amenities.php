<?php /* Template Name: Page - Amenities */ ?>

<?php get_header() ?>

  <?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

  <?php get_template_part('page/page-heroimage') ?>

  <?php if(is_child()): get_template_part('page/page-breadcrumbs'); endif; ?>

  <section class="homepage-introduction page-introduction">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-sm-10 offset-sm-1 offset-md-0 col-md-12">
          <div class="page-content">
            <?php while(have_posts()): the_post() ?>
              <?php the_content() ?>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php if(is_page('amenities')): get_template_part('amenities/amenities-slider'); endif; ?>

<?php get_footer() ?>
