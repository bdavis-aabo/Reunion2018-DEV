<footer class="footer gold-bg">
  <div class="container-fluid">
    <div class="row row-eq-height no-gutters">
      <div class="col-12 col-lg-4">
        <article class="map-container" style="background: transparent url('<?php bloginfo('template_directory') ?>/assets/images/directions-map.jpg') no-repeat center top; background-size: cover; " class="img-fluid" alt="Reunion CO - Directions" />
          <a href="https://www.google.com/maps/dir//Reunion,+Commerce+City,+CO/@39.8910575,-104.8163706,15334m/data=!3m1!1e3!4m8!4m7!1m0!1m5!1m1!1s0x876c6efc50a5b981:0xc45d3d5b59244a59!2m2!1d-104.7812654!2d39.8909969?hl=en-US" target="_blank" class="map-link" title="Directions to Reunion"></a>
        </article>
      </div>
      <div class="col-12 col-lg-5">
        <div class="footer-contactform" id="stay-connected">
          <h1 class="footer-headline">Single-Family Homes from the $300s</h1>
          <h2 class="footer-builders">Oakwood Homes | Richmond American Homes | Shea Homes</h2>
          <em>Enjoy more real experiences at Reunion.</em>
          <p>If you'd like to hear the latest and greatest happenings at Reunion, we'd love to share them with you. Please fill out this form and we'll send you email updates from time to time. Do note that we respect your information and will not misuse it in any inappropriate manner.</p>
          <?php echo do_shortcode('[contact-form-7 id="11" title="Contact form 1"]') ?>
        </div>
      </div>
      <div class="col-12 col-lg-3">
        <div class="footer-instagram">
          <?php echo do_shortcode('[juicer name="reunionco" per="1" pages="1"]') ?>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-directions blue-bg">
    <p>
      Parks, Trails, Lakes, Pools, Rec Center | Reunion is located west of Tower Rd. on 104th<br/>
      <span class="phone-numbers">Reunion Rec Center 303-288-5431 &bull; Reunion Information Center 303-486-8842</span>
    </p>
  </div>

  <div class="footer-copyright">
    <p>&copy; <?php echo date('Y'); ?> Oakwood Homes&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/privacy-policy">Privacy Policy</a> <img src="<?php bloginfo('template_directory') ?>/assets/images/eho-icon.jpg" alt="Equal Housing Opportunity" class="alignright" /></p>
  </div>
</footer>

<?php if(is_front_page() || is_page('home')): get_template_part('home/home-promotion'); endif; ?>

<?php if(is_page('about-reunion') || is_page('district-information')): ?><div class="page-overlay"></div><?php endif; ?>


<?php include_once('assets/_inc/footer-includes.php') ?>


<?php wp_footer();  ?>

</body>
</html>
