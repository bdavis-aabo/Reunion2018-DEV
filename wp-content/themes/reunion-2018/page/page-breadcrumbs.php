  <?php if(is_child()): $_parent = get_post($post->post_parent); endif; ?>

  <section class="page-breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="crumbs">
            <li class="parent">
              <a href="<?php echo get_permalink($_parent) ?>"><?php echo $_parent->post_title ?> </a>
              <i class="fas fa-chevron-right"></i>
            </li>
            <li class="current child"><?php the_title() ?></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
