<?php
  $_leftImage = get_field('homepage_left_image');
  $_rightImage = get_field('homepage_right_image');
?>

    <?php get_template_part('home/home-alert') ?>

    <section class="pagehero-section">
      <div class="home-images">
        <a data-link="/about-reunion" class="home-image home-image-left" onClick="ga('send', 'event', { eventCategory: 'homepage', eventAction: 'click', eventLabel: 'community_link'});">
          <img src="<?php bloginfo('template_directory') ?>/assets/images/reunion-symbol-blue.svg" alt="Reunion Colorado" class="hero-logo left-hero-logo" />
          <div class="home-image-btn">Make this my home</div>
          <span class="home-image-bg" style="background-image: url('<?php echo $_leftImage['url'] ?>')"></span>
        </a>
        <a data-link="/district-information" class="home-image home-image-right" onClick="ga('send', 'event', { eventCategory: 'homepage', eventAction: 'click', eventLabel: 'metro_link'});">
          <img src="<?php bloginfo('template_directory') ?>/assets/images/metro-logo.svg" alt="Reunion Metro District" class="hero-logo right-hero-logo" />
          <div class="home-image-btn">This is my home</div>
          <span class="home-image-bg" style="background-image: url('<?php echo $_rightImage['url'] ?>')"></span>
        </a>
      </div>

      <div class="scroll-indicator"></div>

      <div class="home-overlay"></div>
    </section>
