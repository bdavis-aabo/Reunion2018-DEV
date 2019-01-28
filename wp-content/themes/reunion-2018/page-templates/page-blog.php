<?php /* Template Name: Page - Blog */ ?>




<?php get_header() ?>

<?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

<section class="homepage-introduction page-introduction community-news">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-sm-10 offset-sm-1 col-md-12 offset-md-0">
        <div class="page-content">
          <h1>Real Community <?php if($post->post_name == 'community-blog'): echo 'Blog'; elseif($post->post_name == 'community-news'): echo 'News'; endif; ?></h1>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-8 offset-1">
        <div class="blog-content-left page-content">
          <?php get_template_part('blog/blog-loop') ?>
        </div>
      </div>
      <div class="col-3">
        <div class="blog-content-right"><?php get_sidebar() ?></div>
      </div>
    </div>
  </div>
</section>


<?php get_footer() ?>
