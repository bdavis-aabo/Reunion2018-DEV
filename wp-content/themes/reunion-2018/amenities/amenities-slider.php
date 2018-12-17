<?php
  $_amenitiesPage = new WP_Query();
  $_args = array(
    'post_type' => 'page',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    's' =>  'amenities'
  );
  $_amenitiesPage->query($_args);


?>

<?php if($_amenitiesPage->have_posts()): while($_amenitiesPage->have_posts()): $_amenitiesPage->the_post() ?>
<section class="amenities-slider-section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <!-- <div class="row no-gutters"> -->
          <?php if(get_field('amenities') != ''): $_amenities = get_field('amenities'); $_s = 0; ?>
            <div id="amenities-slider" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <?php //while(have_rows('amenities')): the_row(); $_amenitiesImage = get_sub_field('amenity_image'); ?>
                <div class="carousel-item <?php if($_s == 0): echo 'active'; endif; ?>">
                  <!-- <div class="col-12 col-sm-6"> -->
                    <div class="item-content">
                      content
                    </div>
                  <!-- </div>
                  <div class="col-12 col-sm-6"> -->
                    <div class="item-image">
                      image
                    </div>
                  <!-- </div> -->
                </div>
                <?php //$_s++; endwhile; ?>
              </div>


          </div>
          <?php endif; ?>
        <!-- </div> -->
      </div>
    </div>
  </div>
</section>
<?php endwhile; endif; ?>



<?php /*
<div class="col-12 col-sm-6 col-lg-4">
  <div class="flip-container">
    <div class="flipper">
      <div class="front">
        <img src="<?php echo $_amenitiesImage['url'] ?>" alt="<?php echo get_sub_field('amenity_number') . ' ' . get_sub_field('amenity_context') ?>" class="img-fluid" />
      </div>
      <div class="back blue-bg">
        <div class="back-contents">
          <h1 class="gold-txt"><?php echo get_sub_field('amenity_number') ?></h1>
          <h2 class="gothic"><?php echo get_sub_field('amenity_context') ?></h2>
          <?php echo get_sub_field('amenity_details') ?>
        </div>
      </div>
    </div>
  </div>
</div>
