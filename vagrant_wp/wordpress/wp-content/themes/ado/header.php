<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
  <meta charset="utf-8">

  <?php // force Internet Explorer to use the latest rendering engine available ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php wp_title(''); ?></title>

  <?php // mobile meta (hooray!) ?>
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1"/>

  <?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
  <!--[if IE]>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
  <![endif]-->

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php // wordpress head functions ?>
  <?php wp_head(); ?>
  <?php // end of wordpress head ?>

  <?php // drop Google Analytics Here ?>
  <?php // end analytics ?>

</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<header id="js-header" class="o-header l-wrap l-wrap--small">
  <div class="l-inline">
    <div class="l-inline__cell"><a href="<?php echo home_url() ?>" class="o-logo">UTB/FMK/<span class="o-logo__studio">Ateliér Design obuvi</span></a></div>
    <div class="l-inline__cell">
      <nav class="o-nav">
        <ul class="o-nav__list">
          <li class="o-nav__item"><a href="<?php echo home_url() ?>#gallery" data-scrollto data-nav-link class="o-nav__link">Práce</a></li>
          <li class="o-nav__item"><a href="<?php echo home_url() ?>#about" data-scrollto data-nav-link class="o-nav__link">O nás</a></li>
          <li class="o-nav__item"><a href="<?php echo home_url() ?>#students" data-scrollto data-nav-link class="o-nav__link">Seznam studentů</a></li>
          <li class="o-nav__item"><a href="<?php echo home_url() ?>#contact" data-scrollto data-nav-link class="o-nav__link">Kontakty</a></li>
          <li class="o-nav__item"><a href="#" class="o-nav__link o-nav__link--active">CZ</a><span class="o-nav__divider">/</span><a href="#" class="o-nav__link">EN</a></li>
        </ul>
      </nav>
    </div>
  </div>
</header>