<?php get_header() ?>

  <?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

  <?php if(!is_page('model-directory') && !is_page('reunion-community-map')): get_template_part('page/page-heroimage'); endif; ?>

  <?php if(is_child() && !is_page('model-directory') && !is_page('reunion-community-map')): get_template_part('page/page-breadcrumbs'); endif; ?>

  <section class="homepage-introduction page-introduction <?php echo $post->post_name.'-bg' ?>">
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
    <?php if(is_page('model-directory') || is_page('reunion-community-map')): ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-10 offset-1">
          <div class="map-container">
            <?php echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-fluid aligncenter')); ?>

            <p>
              <a href="<?php bloginfo('template_directory') ?>/assets/images/ReunionBuilderMap.pdf" target="_blank" class="btn gold-btn">Download Directory Map</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </section>

  <?php if(is_page('about-reunion')): get_template_part('page/page-amenities'); endif; ?>

<?php get_footer() ?>
