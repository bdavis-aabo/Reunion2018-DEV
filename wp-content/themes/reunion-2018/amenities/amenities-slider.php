<?php
  $_amenitiesPage = new WP_Query();
  $_args = array(
    'post_type' => 'page',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    's' =>  'amenities'
  );
  $_amenitiesPage->query($_args);
  $_numRows = count(get_field('amenities'));
  $_i = 0;
?>

<?php if($_amenitiesPage->have_posts()): while($_amenitiesPage->have_posts()): $_amenitiesPage->the_post() ?>
<section class="amenities-slider-section">
  <?php if(get_field('amenities') != ''): $_s = 0; ?>
  <div id="amenities-slider" class="carousel slide" data-ride="carousel">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1">
            <div class="carousel-inner">

            <?php while(have_rows('amenities')): the_row(); $_amenitiesImage = get_sub_field('amenity_image'); ?>
            <div class="carousel-item <?php if($_s == 0): echo 'active'; endif; ?>">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="amenity-details" >
                    <h1 class="gold-txt"><?php echo get_sub_field('amenity_number') ?></h1>
                    <h2 class="gothic"><?php echo get_sub_field('amenity_context') ?></h2>
                    <?php echo get_sub_field('amenity_details') ?>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <img src="<?php echo $_amenitiesImage['url'] ?>" alt="<?php echo get_sub_field('amenity_number') . ' ' . get_sub_field('amenity_context') ?>" class="img-fluid" />
                </div>
              </div>
            </div>
            <?php $_s++; endwhile; ?>

            <ol class="carousel-indicators">
              <?php while($_i < $_numRows): ?>
              <li data-target="#amenities-slider" data-slide-to="<?php echo $_i ?>" <?php if($_i == 0): ?>class="active"<?php endif; ?>></li>
              <?php $_i++; endwhile; ?>
            </ol>

            <a class="carousel-control-prev" href="#amenities-slider" role="button" data-slide="prev">
              <i class="fas fa-2x fa-chevron-left"></i>
            </a>
            <a class="carousel-control-next" href="#amenities-slider" role="button" data-slide="next">
              <i class="fas fa-2x fa-chevron-right"></i>
            </a>
          </div>
        </div>
      </div>


    </div>
  </div>
<?php endif; ?>
</section>
<?php endwhile; endif; ?>
