<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
       Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    
    <meta name="description" content="">
    <meta name="author" content="">
    
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="icon" href="$GLOBALS['TEMPLATE_RELATIVE_URL']"."images/logo-title.png" type="image/png" />

    <?php versioned_stylesheet($GLOBALS["TEMPLATE_RELATIVE_URL"]."html5-boilerplate/css/normalize.css") ?>
    <?php versioned_stylesheet($GLOBALS["TEMPLATE_RELATIVE_URL"]."html5-boilerplate/css/main.css") ?>
    <?php versioned_stylesheet($GLOBALS["TEMPLATE_RELATIVE_URL"]."js/jquery.fancybox/jquery.fancybox.css") ?>

    <!-- Wordpress Templates require a style.css in theme root directory -->
    <?php versioned_stylesheet($GLOBALS["TEMPLATE_RELATIVE_URL"]."style.css") ?>
    
    <!-- Wordpress Head Items -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php
    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
  ?>

<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
    <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"]."html5-boilerplate/js/vendor/modernizr-2.6.1.min.js") ?>
</head>

<body>
<!--[if lt IE 7]>
  <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="wrapper clearfix">
  <div class="header">
      <div class="logo">
      <a href="<?php echo(get_page_link(get_page_by_title('Home')->ID)) ?> ">
        <img src="<?php echo $GLOBALS["TEMPLATE_RELATIVE_URL"]; ?>images/logo.png" width="177px" height="51px"/>
      </a>
        </div>
        <div class="menu">
            <ul>
                <?php 
                    $my_pages = wp_list_pages('echo=0&title_li=&exclude_tree=218&exclude_tree=216');
                    $var1 = '<a';
                    $var2 = '<span><a';
                    $var3 = '</a';
                    $var4 = '</a></span';
                    $my_pages = str_replace($var1, $var2, $my_pages);
                    $my_pages = str_replace($var3, $var4, $my_pages);
                    echo $my_pages;
                ?>
            </ul>
      
      <div class="social-counter">
        <ul>
          <li>
            <a href="https://plus.google.com/u/0/109515217848822081926/posts" title="Thêm tôi trong Google+" target="_blank">
              <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/icon-google.png" width="18px" height="18px"/>
            </a>
          </li>
          <li>
            <a href="https://twitter.com/#!/wmic75" title="Thêm tôi trong Twitter" target="_blank">
              <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/icon-twitter.png" width="18px" height="18px" />
            </a>
          </li>
          <li>
            <a href="http://www.facebook.com/tunglam.tvtl" title="Thêm tôi trong Facebook" target="_blank">
              <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/icon-facebook.png" width="18px" height="18px"/>
            </a>
          </li>
          <li>
            <a href="<?php bloginfo('atom_url'); ?>" title="Xem RSS" target="_blank">
              <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/icon-rss.png" width="18px" height="18px"/>
            </a>
          </li>
          
          <li>
            <?php get_search_form(); ?>
          </li>
        </ul>
      </div>
        </div>
    </div>