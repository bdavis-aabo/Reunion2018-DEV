<?php
  $_terms = get_terms('builder', 'orderby=slug&hide_empty=1&post__not_in=41');

  $_homeBuilders = new WP_Query(array(
    'orderby'         =>  'menu_order',
    'order'           =>  'ASC',
    'post_type'       =>  'home_builders',
    'posts_per_page'  =>  -1,
  ));

?>

  <section class="qmihomes-section">
    <div class="builders">
      <div class="quickmove-table">
        <div class="container">
          <?php while($_homeBuilders->have_posts()): $_homeBuilders->the_post() ?>
          <div class="row align-items-center" id="<?php echo $post->post_name ?>">
            <div class="col-12 col-md-3">
              <div class="builder-logo">
                <?php $_logo = get_field('homebuilder_logo'); ?>
                <img src="<?php echo $_logo['url'] ?>" alt="<?php the_title() ?>" class="aligncenter img-fluid" />
              </div>
            </div>
            <div class="col-12 col-md-9">
              <div class="builder-description">
                <h2 class="builder-name"><?php the_title() ?></h2>
                <span class="address"><?php echo str_replace('<br/>', ' | ', get_field('homebuilder_address')) ?></span>
                <span class="phone">
                  <a href="tel:<?php echo str_replace('-','',get_field('homebuilder_phone')) ?>" onclick="ga('send','event','Click to Call', 'On Click', '<?php echo get_field('homebuilder_phone') ?>');" class="builder-phone"><?php echo get_field('homebuilder_phone') ?></a>
                </span>
                <br />
                <span class="hours">
                  <strong>Sales Office Hours: </strong><br /><?php echo get_field('homebuilder_hours') ?>
                </span>
              </div>
            </div>
          </div>

          <div class="builder-homes clearfix">
            <div class="row">
            <?php
              $_args = array(
                'post_type'   =>  'quickmoves',
                'builder'     =>  $post->post_name,
                'orderby'     =>  'menu_order',
                'order'       =>  'ASC',
                'posts_per_page'  =>  8,
                'hide_empty'  =>  1
              );
              $_quickmoves = new WP_Query($_args);
              if($_quickmoves->have_posts()): while($_quickmoves->have_posts()): $_quickmoves->the_post();
                $_homeImage = get_field('qmi_image');
            ?>
              <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                <div class="qmi-home">
                  <img src="<?php echo $_homeImage['url'] ?>" class="aligncenter img-fluid" />
                  <h2 class="home-name"><?php echo get_field('qmi_floorplan') ?></h2>
                  <span class="address-price"><?php echo get_field('qmi_address') ?> | <strong><?php echo '$' . get_field('qmi_price') ?></strong></span>
                  <p><?php echo get_field('qmi_available') ?></p>

                  <p class="details">
                    <?php echo get_field('qmi_square_footage') . ' sq ft | ' . get_field('qmi_bedrooms') . ' beds | ' . get_field('qmi_bathrooms') . ' bath<br/>' .
											get_field('qmi_garage') ?>
                  </p>
									<a href="<?php echo get_field('qmi_link') ?>" class="builder-btn" target="_blank">View This Home</a>
                </div>
              </div>
            <?php endwhile; else: ?>
              <div class="col-12">
                <div class="builder-nohome">
                  <h2>There are no quick move-in inventory homes currently available from this collection.<br/>Please call the sales office @ <?php echo get_field('homebuilder_phone') ?> for more information.</h2>
                </div>
              </div>
            <?php endif; wp_reset_query(); ?>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </section>
