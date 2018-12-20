<?php
  $_builders = new WP_Query();
  $_args = array(
    'post_type' => 'home_builders',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'order' => 'asc',
    'orderby' => 'title',
    'name' => $post->post_name
  );
  $_builders->query($_args);

  //echo '<pre>'; var_dump($_args); echo '</pre>';
?>

<?php while($_builders->have_posts()): $_builders->the_post() ?>
<section class="builder-collections">
  <div class="container">
    <?php if(have_rows('homebuilder_collections')): while(have_rows('homebuilder_collections')): the_row(); ?>
    <div class="row">
      <div class="col-12">
        <div class="collection">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="collection-images">
              <?php if(get_sub_field('collection_gallery')): $_galleryImages = get_sub_field('collection_gallery'); $_s = 0; ?>
                <div id="<?php echo $post->post_name.'-slider'?>" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                  <?php foreach($_galleryImages as $_image): ?>
                    <div class="carousel-item <?php if($_s == 0): echo 'active'; endif; ?>">
                      <img src="<?php echo $_image['url'] ?>" alt="<?php the_title() ?>" class="img-fluid" />
                    </div>
                  <?php $_s++; endforeach; ?>

                    <ol class="carousel-indicators">
                    <?php $_i = 0; foreach($_galleryImages as $_image): ?>
                      <li data-target="#<?php echo $post->post_name.'-slider'?>" data-slide-to="<?php echo $_i ?>" <?php if($_i == 0): ?>class="active"<?php endif; ?>></li>
                    <?php $_i++; endforeach; ?>
                    </ol>
                  </div>
                </div>
              <?php endif; ?>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="collection-details align-middle">
                <?php echo get_sub_field('collection_details') ?>
                <div class="builder-buttons">
                  <a href="<?php echo get_sub_field('collection_link') ?>" title="<?php the_title() ?>" class="builder-btn">Home  Details</a>
                  <a href="tel:<?php echo str_replace('-','',get_sub_field('collection_phone')) ?>" onclick="ga('send','event','Click   to Call', 'On Click',  '<?php echo get_sub_field('collection_phone') ?>');" class="builder-phone">
                    <span class="phone-icon">
                      <i class="fas fa-phone fa-inverse"></i>
                    </span>
                    <?php echo 'sales office: ' . get_sub_field('collection_phone') ?>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; endif; ?>
  </div>
</section>

<section class="homepage-introduction builder-information">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-sm-10 offset-sm-1">
        <div class="page-content intro-content">
          <?php echo get_field('homebuilder_introduction') ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endwhile; wp_reset_query() ?>
