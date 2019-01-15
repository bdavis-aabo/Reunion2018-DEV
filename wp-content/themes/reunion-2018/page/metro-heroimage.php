
<?php if(get_the_post_thumbnail_url($post->ID) != ''): ?>
  <section class="pagehero-section">
    <div class="page-heroimage metro-heroimage" style="background: url('<?php echo get_the_post_thumbnail_url($post->ID); ?>') no-repeat">
      <img src="<?php bloginfo('template_directory') ?>/assets/images/metro-logo.svg" alt="Reunion Metro District" class="page-herologo" />
    </div>
    <div class="scroll-indicator"></div>
  </section>
<?php endif; ?>
