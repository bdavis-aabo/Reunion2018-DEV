<?php /* Template Name: Page - Community Default */ ?>

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

      <?php if(is_page('reunion-coffee-house')): ?>
      <div class="row">
        <div class="col-12">
          <div class="cup-collage">
            <img src="<?php bloginfo('template_directory') ?>/assets/images/cup-collage.jpg" class="aligncenter img-fluid" alt="Community Uplift Partnership (CUP)" />
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <?php if(is_page('about-reunion')): get_template_part('page/page-amenities'); endif; ?>

<?php get_footer() ?>
