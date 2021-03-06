<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="shortcut icon" href="<?php bloginfo('template_directory') ?>/favicon.png" type="image/x-icon" />

    <?php //get stylesheets from functions.php ?>

    <?php include_once('assets/_inc/header-includes.php') ?>
    <?php include_once('assets/_inc/ga-include.php') ?>

    <?php wp_head() ?>
  </head>
  <body>



    <header class="header">
      <?php if(!is_front_page()): ?>
      <button class="nav-btn">
        <span class="nav-iconbar"></span>
        <span class="nav-iconbar"></span>
        <span class="nav-iconbar"></span>
        <span class="nav-iconbar"></span>
      </button>
      <?php endif; ?>

      <a href="<?php bloginfo('url') ?>" title="<?php bloginfo('name') ?>" class="reunion-logo"><img src="<?php bloginfo('template_directory') ?>/assets/images/reunion-logo.svg" /></a>

      <div class="secondary-links-container">
        <ul class="secondary-links">
          <li><a href="/home-builders/quick-move-in-homes" class="blue-btn left-btn btn">Quick Move-in Homes</a></li>
          <li><a href="/stay-connected" class="gold-btn right-btn btn">Stay Connected</a></li>
        </ul>
        <ul class="social-links">
          <li class="icon"><a href="https://www.facebook.com/ReunionCO" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
          <li class="icon"><a href="https://www.pinterest.com/ReunionCO/" target="_blank"><i class="fab fa-pinterest-square"></i></a></li>
          <li class="icon"><a href="https://instagram.com/reunionco" target="_blank"><i class="fab fa-instagram"></i></a></li>
          <li class="icon"><a href="https://www.youtube.com/user/ReunionCO" target="_blank"><i class="fab fa-youtube-square"></i></a></li>
        </ul>
      </div>
    </header>
