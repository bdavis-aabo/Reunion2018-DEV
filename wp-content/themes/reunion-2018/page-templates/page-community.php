<?php /* Template Name: Page - Community Default */ ?>

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

    <?php if(get_field('page_content_image') != ''): $_bodyImage = get_field('page_content_image'); ?>
      <img src="<?php echo $_bodyImage['url'] ?>" class="aligncenter img-fluid" alt="<?php the_title() ?>" />
    <?php endif; ?>
  </section>

  <?php if(is_page('about-reunion')): get_template_part('page/page-amenities'); endif; ?>

<?php get_footer() ?>
