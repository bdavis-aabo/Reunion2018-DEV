<?php get_header() ?>

<?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

<section class="homepage-introduction page-introduction community-news">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-10 offset-sm-1">
        <div class="page-content">
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
          <article class="news-article single-article" id="post-<?php echo $post->ID ?>">
            <h2 class="article-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
            <p class="article-date">Posted on <?php the_time('d') ?> <?php the_time('M Y') ?></p>

            <?php the_content() ?>
          </article>
        <?php endwhile; endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer() ?>
