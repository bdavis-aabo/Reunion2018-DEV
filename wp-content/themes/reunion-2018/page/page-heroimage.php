  <section class="pagehero-section">
    <div class="page-heroimage" style="background: url('<?php echo get_the_post_thumbnail_url($post->ID); ?>') no-repeat center top; background-size: cover;"></div>

    <?php if(is_page_template('page-templates/page-community.php') || basename(get_page_template()) == 'page.php'): ?>
      <div class="metro-btn gold-btn"><a href="/district-information">This is my home<br /><i class="fa fa-chevron-down"></i></a></div>
    <?php elseif(is_page_template('page-templates/page-metro.php')): ?>
      <div class="metro-btn blue-btn"><a href="/about-reunion">Make this is my home<br /><i class="fa fa-chevron-down"></i></a></div>
    <?php endif; ?>
  </section>

  <div class="scroll-indicator"></div>
