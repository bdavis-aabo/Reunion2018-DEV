<?php get_header() ?>

  <?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

  <?php //get_template_part('page/page-heroimage') ?>

  <?php //if(is_child()): get_template_part('page/page-breadcrumbs'); endif; ?>

  <?php if(have_posts()): while(have_posts()): the_post() ?>
  <section class="homepage-introduction builder-introduction">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-sm-10 offset-sm-1 offset-md-0 col-md-12">
          <div class="page-content">
              <h1 class="page-title"><?php the_title() ?></h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
    $_homeImage = get_field('qmi_image');
  ?>
  <section class="builder-collections qmi-collections">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="collection">
            <div class="row">
              <div class="col-12 col-md-5">
                <img src="<?php echo $_homeImage['url'] ?>" alt="<?php the_title() ?>" class="img-fluid aligncenter" />
              </div>
              <div class="col-12 col-md-7">
                <div class="inventory-container">
                  <?php the_content() ?>
                  <span class="address-price"><?php echo get_field('qmi_address') ?> | <strong><?php echo '$' . get_field('qmi_price') ?></strong></span>
                  <p><?php echo get_field('qmi_available') ?></p>

                  <p class="details">
                    <?php echo get_field('qmi_square_footage') . ' sq ft | ' . get_field('qmi_bedrooms') . ' beds | ' . get_field('qmi_bathrooms') . ' bath<br/>' .
                      get_field('qmi_garage') ?>
                  </p>
                  <a href="<?php echo get_field('qmi_link') ?>" class="builder-btn" target="_blank">View This Home</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endwhile; endif; ?>

  <?php get_template_part('builder/builder-collections') ?>

<?php get_footer() ?>
