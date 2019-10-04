<?php get_header() ?>

  <?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

  <?php if(!is_page('model-directory') && !is_page('reunion-community-map')): get_template_part('page/page-heroimage'); endif; ?>

  <?php if(is_child() && !is_page('model-directory') && !is_page('reunion-community-map')): get_template_part('page/page-breadcrumbs'); endif; ?>

  <?php if(get_field('page_background_image')): $_bg = get_field('page_background_image'); endif; ?>

  <section class="homepage-introduction page-introduction <?php echo $post->post_name.'-bg' ?>" <?php if($_bg != ''): ?>style="background: url('<?php echo $_bg['url'] ?>') no-repeat right 45%;"<?php endif; ?>>
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
