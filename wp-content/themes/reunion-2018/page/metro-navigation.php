<nav class="navigation gold-bg">
  <div class="main-menu-container">
    <?php
      wp_nav_menu( array(
        'theme_location'  =>  'metro',
        'depth'           => 2,
        'container'       => 'div',
        'menu_class'  =>  'main-menu nav flex-column',
        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
        'walker'          => new WP_Bootstrap_Navwalker()
      ));
    ?>

    <div class="main-menu-information">
      <img src="<?php bloginfo('template_directory') ?>/assets/images/metro-logo.svg" alt="Reunion Metro District" class="hero-logo right-hero-logo" />
      <h2>Reunion Recreation Center</h2>
      <p class="phone">303.288.5431</p>
      <ul class="social-btns">
        <li class="icon"><a href="https://www.facebook.com/ReunionCO" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
        <li class="icon"><a href="http://www.pinterest.com/ReunionCO/" target="_blank"><i class="fab fa-pinterest-square"></i></a></li>
        <li class="icon"><a href="http://instagram.com/reunionco" target="_blank"><i class="fab fa-instagram"></i></a></li>
        <li class="icon"><a href="https://www.youtube.com/user/ReunionCO" target="_blank"><i class="fab fa-youtube-square"></i></a></li>
      </ul>
  </div>
  </div>
</nav>
