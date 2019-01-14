<?php /* Template Name: Page - Blog */ ?>

<?php get_header() ?>

<?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

<section class="homepage-introduction page-introduction community-news">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-10 offset-sm-1 col-md-12 offset-md-0">
        <div class="page-content">
          <h1>Real Community <?php if(is_page('community-blog')): echo 'Blog'; else: echo 'Updates'; endif; ?></h1>

          <?php $_articles = new WP_Query();
            $_catID = get_cat_ID('Reunion News');
            $_args = array(
              'post_type' => 'post',
              'post_status' => 'publish',
              'category__not_in' => array($_catID),
              'order' => 'desc',
              'orderby' => 'date'
            );
            $_news = array(
              'post_type' => 'post',
              'post_status' => 'publish',
              'category_name' => 'Reunion News',
              'order' => 'desc',
              'orderby' => 'date'
            );

            if(is_page('community-blog')): $_articles->query($_args); elseif(is_page('community-news')): $_articles->query($_news); endif;

          if($_articles->have_posts()): while($_articles->have_posts()): $_articles->the_post(); ?>
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
        <?php endwhile; endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>


<?php get_footer() ?>
