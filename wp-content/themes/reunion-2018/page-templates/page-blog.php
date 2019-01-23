<?php /* Template Name: Page - Blog */ ?>

<?php
  $_catID = get_cat_ID('Reunion News');
  $temp = $wp_query;
  $wp_query = null;
  $wp_query = new WP_Query();
  $_args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'category__not_in' => array($_catID),
    'order' => 'desc',
    'orderby' => 'date',
    'paged' => $paged
  );
  $_news = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'category_name' => 'Reunion News',
    'order' => 'desc',
    'orderby' => 'date',
    'paged' => $paged
  );
?>


<?php get_header() ?>

<?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

<section class="homepage-introduction page-introduction community-news">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-10 offset-sm-1 col-md-12 offset-md-0">
        <div class="page-content">
          <h1>Real Community <?php if($post->post_name == 'community-blog'): echo 'Blog'; elseif($post->post_name == 'community-news'): echo 'News'; endif; ?></h1>
          <?php
            if($post->post_name == 'community-blog'): $wp_query->query($_args); elseif($post->post_name == 'community-news'): $wp_query->query($_news); endif;
            if($wp_query->have_posts()): while($wp_query->have_posts()): $wp_query->the_post(); ?>
            <article class="news-article" id="post-<?php echo $post->ID ?>">
              <div class="row">
                <div class="col-4">
                  <div class="article-image">
                    <?php if(get_the_post_thumbnail($post->ID) != ''):
                      echo get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-fluid aligncenter'));
                    else: ?>
                      <img src="<?php echo get_article_image() ?>" alt="<?php the_title() ?>" class="img-fluid aligncenter" />
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-8">
                  <div class="article-contents">
                    <h2 class="article-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                    <p class="article-date">Posted on <?php the_time('d') ?> <?php the_time('M Y') ?></p>
                    <?php the_excerpt() ?>
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="btn gold-btn">
                      Read More <i class="fas fa-chevron-right"></i>
                    </a>
                  </div>

                </div>
              </div>
            </article>
            <?php endwhile; ?>
            <div class="article-navigation">
              <div class="previous-btn">
                <?php next_posts_link('<i class="fas fa-chevron-left"></i> Older Articles') ?>
              </div>
              <div class="next-btn">
                <?php previous_posts_link('Newer Articles <i class="fas fa-chevron-right"></i>') ?>
              </div>
            </div>

            <?php endif; $wp_query = null; $wp_query = $temp;?>




        </div>
      </div>
    </div>
  </div>
</section>


<?php get_footer() ?>
