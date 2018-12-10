<?php
  $_today = date('Ymd');
  $_promotions = new WP_Query();
  $_args = array(
    'post_type' => 'promos',
    'posts_per_page'  =>  1,
    'meta_query'  =>  array(
      array(
        'key'     =>  'promotion_start',
        'compare' =>  '<=',
        'value'   =>  $_today
      ),
      array(
        'key'     =>  'promotion_expiration',
        'compare' =>  '>=',
        'value'   =>  $_today
      )
    )
  );
  $_promotions->query($_args);
?>

<?php if($_promotions->have_posts()): ?>
  <div class="window-mask">
    <?php while($_promotions->have_posts()): $_promotions->the_post(); $_promoImage = get_field('promotion_image') ?>
    <div class="promotion-container">
      <a class="close"><i class="fas fa-times"></i></a>
      <a href="<?php echo get_field('promotion_link') ?>" title="<?php the_title() ?>" class="promotion-link">
        <img src="<?php echo $_promoImage['url'] ?>" alt="<?php the_title() ?>" class="img-fluid" />
      </a>
    </div>
    <?php endwhile; ?>
  </div>
<?php endif; wp_reset_query(); ?>
