<?php /* Template Name: Page - Homebuilders */ ?>

<?php
  $_builders = new WP_Query();
  $_args = array(
    'post_type' => 'home_builders',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'order' => 'asc',
    'orderby' => 'menu_order'
  );
  $_builders->query($_args);
?>


<?php get_header() ?>

  <?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

  <?php get_template_part('page/page-heroimage') ?>

  <section class="homepage-introduction page-introduction">
    <div class="container">
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

  <?php if(is_page('home-builders')): ?>
  <section class="builder-grid">
    <div class="container">
      <div class="row no-gutters">
      <?php while($_builders->have_posts()): $_builders->the_post();
        $_logo = get_field('homebuilder_logo');
        $_image = get_field('homebuilder_rendering');
      ?>
        <div class="col-12 col-md-4">
          <div class="builder">
            <img src="<?php echo $_image['url'] ?>" alt="<?php the_title() ?>" class="img-fluid builder-image" />
            <div class="builder-info">
              <img src="<?php echo $_logo['url'] ?>" alt="<?php the_title() ?>" class="img-fluid builder-logo" />
              <?php echo get_field('homebuilder_overview') ?>
              <div class="builder-buttons">
                <a href="<?php echo get_field('homebuilder_page') ?>" title="<?php the_title() ?>" class="builder-btn">Visit Homes</a>
                <a href="tel:<?php echo str_replace('-','',get_field('homebuilder_phone')) ?>" onclick="ga('send','event','Click to Call', 'On Click',  '<?php echo get_field('homebuilder_phone') ?>');" class="builder-phone">
                  <span class="phone-icon">
                    <i class="fas fa-phone fa-inverse"></i>
                  </span>
                  <?php echo get_field('homebuilder_phone') ?>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; wp_reset_query(); ?>
      </div>
    </div>
  </section>

  <?php endif; ?>

<?php get_footer() ?>
