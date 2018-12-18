<?php /* Template Name: Page - Quick Move-Ins */ ?>

<?php get_header() ?>

  <?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

  <?php get_template_part('page/page-heroimage') ?>

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

  <?php if(is_page('quick-move-in-homes')): get_template_part('builder/builder-qmis'); endif; ?>

<?php get_footer() ?>
