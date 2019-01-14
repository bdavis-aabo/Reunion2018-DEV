<?php /* Template Name: Page - Metro Default */ ?>

<?php get_header() ?>

  <?php if(!is_front_page()): get_template_part('page/metro-navigation'); endif; ?>

  <?php get_template_part('page/page-heroimage') ?>

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
      <div class="row">
        <div class="col-12">
          <h2 class="member-heading">Board Members</h2>
        </div>
      </div>
      <?php if(have_rows('staff_members')): ?>
      <div class="row row-eq-height">
        <?php while(have_rows('staff_members')): the_row(); ?>
          <?php if(get_sub_field('staff_department') == 'board members'): ?>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="staff-member">
                <div class="staff-member-details">
                  <span class="member-name"><?php echo get_sub_field('staff_member_name') ?></span>
                  <span class="member-title"><?php echo get_sub_field('staff_member_title') ?></span>

                </div>
                <div class="staff-member-email"><?php echo get_sub_field('staff_member_email') ?></div>
              </div>
            </div>
          <?php endif; ?>
        <?php endwhile; ?>
      </div>
      <?php endif; ?>
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
