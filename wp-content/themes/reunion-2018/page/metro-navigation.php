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

    <a href="/about-reunion" class="switch-link" title="Make this is my home">Make this is my home</a>

    <div class="main-menu-information">
      <img src="<?php bloginfo('template_directory') ?>/assets/images/metro-logo.svg" alt="Reunion Metro District" class="hero-logo right-hero-logo" />
      <h2>Reunion Information Center</h2>
      <p class="phone">303.486.8842</p>
      <ul class="social-btns">
        <li class="icon"><a href=""><i class="fab fa-facebook-square"></i></a></li>
        <li class="icon"><a href=""><i class="fab fa-pinterest-square"></i></a></li>
        <li class="icon"><a href=""><i class="fab fa-instagram"></i></a></li>
        <li class="icon"><a href=""><i class="fab fa-youtube-square"></i></a></li>
        <li class="icon"><a href=""><i class="fab fa-google-plus-square"></i></a></li>
      </ul>

      <p class="small">@ReunionCO</p>
  </div>
  </div>
</nav>
