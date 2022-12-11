<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
</head>
<body>
    
  <div class="wraper">
      <header class="header">  
          <a class="header__logo" href="index.html">
            <?php echo get_theme_mod('title_tagline_logo', 'Logo'); ?>             
          </a>
          <a class="header__phone" href="<?php get_theme_mod('title_tagline_phone', '+3 (096) 333-33-33'); ?>">
            <?php echo get_theme_mod('title_tagline_phone', '+3 (096) 333-33-33'); ?>   
          </a>   
      </header>
