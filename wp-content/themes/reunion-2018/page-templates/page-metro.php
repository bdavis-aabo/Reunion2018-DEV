<?php /* Template Name: Page - Metro Default */ ?>

<?php get_header() ?>

  <?php if(!is_front_page()): get_template_part('page/metro-navigation'); endif; ?>

  <?php get_template_part('page/metro-heroimage') ?>

  <?php if(is_child()): get_template_part('page/page-breadcrumbs'); endif; ?>

  <section class="homepage-introduction page-introduction metro-introduction">
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

  <?php if(is_page('staff-directory')): ?>
  <section class="staff-member-section">
    <div class="container-fluid">
      <?php if(have_rows('staff_members')): get_template_part('metro/metro-staff'); endif; ?>
    </div>
  </section>
  <?php endif; ?>

  <?php
  if(is_page('district-information')):
    get_template_part('metro/metro-boxes');
  else:
    get_template_part('metro/metro-documents');
  endif;
  ?>

<?php get_footer() ?>
