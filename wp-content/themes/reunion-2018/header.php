<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">


    <?php //get stylesheets from functions.php ?>

    <?php wp_head() ?>
  </head>
  <body>

    <div class="mobile-containers">
      <div class="container-box mobile">mobile</div>
      <div class="container-box mobland">mobile landscape</div>
      <div class="container-box tablet">tablet (col-md)</div>
      <div class="container-box tab-land">tablet landscape (col-lg)</div>
      <div class="container-box small-desk">small desktop</div>
      <div class="container-box desktop">desktop</div>
    </div>


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

      <ul class="secondary-links">
        <li><a href="/home-builders/quick-move-in-homes" class="blue-btn left-btn btn">Quick Move-in Homes</a></li>
        <li><a href="/stay-connected" class="gold-btn right-btn btn">Stay Connected</a></li>
      </ul>
    </header>
