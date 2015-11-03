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

<header id="js-header" class="o-header l-wrap">
  <div class="l-inline--later">
    <div class="l-inline__cell"><a href="<?php echo home_url() ?>" class="o-logo"><?php _e("TBU", "ado") ?>/<?php _e("FMC", "ado") ?>/<span class="o-logo__studio"><?php _e("Shoe Design Studio", "ado") ?></span></a></div>
    <div class="l-inline__cell">
      <nav class="o-nav">
        <button data-nav class="o-nav__toggle ion-navicon">Menu</button>
        <ul class="o-nav__list">
          <?php
            if (is_front_page()) {
              $link_prefix = null;
              $link_suffix = null;
              $link_data = "data-scrollto";
            } else {
              $link_prefix = home_url();
              $link_suffix = "section-";
              $link_data = null;
            }

            $links = array(
              "gallery" => __("Projects", "ado"),
              "about" => __("About", "ado"),
              "students" => __("Students", "ado"),
              "contact" => __("Contact", "ado")
            );
            foreach ($links as $link => $title) :
          ?>
          <li class="o-nav__item">
            <a href="<?php echo $link_prefix ?>#<?php echo $link_suffix . $link ?>" <?php echo $link_data ?> data-nav-link class="o-nav__link"><?php echo $title ?></a>
          </li>

          <?php endforeach; ?>

          <li class="o-nav__item">
            <?php echo qtranxf_generateLanguageSelectCode(array("type"=>"custom", "format" => "%c")); ?>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</header>
