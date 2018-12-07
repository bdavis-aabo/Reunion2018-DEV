<?php
  $_today = date('Ymd');

  $_args = array(
    'post_type' => 'alerts',
    'posts_per_page'  =>  1,
    'meta_query'  =>  array(
      array(
        'key'     =>  'alert_start',
        'compare' =>  '<=',
        'value'   =>  $_today
      ),
      array(
        'key'     =>  'alert_expiration',
        'compare' =>  '>=',
        'value'   =>  $_today
      )
    )
  );
  $_alerts = new WP_Query();
  $_alerts->query($_args);
?>

    <?php if($_alerts->have_posts()): ?>
    <section class="news-box red-bg">
      <?php while($_alerts->have_posts()): $_alerts->the_post() ?>
      <i class="fas fa-2x fa-exclamation-circle gold-txt"></i>
      <p><span class="alert-caps"><?php the_title() ?></span> - <?php echo get_field('alert_content') ?></p>
      <a class="alert-close"><i class="fas fa-2x fa-times"></i></a>
      <?php endwhile; ?>
    </section>
    <?php endif; ?>
