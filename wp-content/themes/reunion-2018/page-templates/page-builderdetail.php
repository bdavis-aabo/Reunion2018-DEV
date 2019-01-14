<?php /* Template Name: Page - Builder Detail */ ?>

<?php get_header() ?>

  <?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

  <?php get_template_part('page/page-heroimage') ?>

  <?php if(is_child()): get_template_part('page/page-breadcrumbs'); endif; ?>

  <?php if(have_posts()): while(have_posts()): the_post() ?>
  <section class="homepage-introduction builder-introduction">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-sm-10 offset-sm-1 offset-md-0 col-md-12">
          <div class="page-content">
              <?php the_content() ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endwhile; endif; ?>

  <?php get_template_part('builder/builder-collections') ?>

<?php get_footer() ?>
