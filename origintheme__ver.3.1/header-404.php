<!DOCTYPE html>
<html lang="ja" class="no-js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php // force Internet Explorer to use the latest rendering engine available ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
    <link rel="alternate"  hreflang="ja" href="<?php bloginfo('url'); ?>"/>
    <?php // mobile meta (hooray!) ?>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width">
    
    <?php // icons & favicons ?>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/icon/apple-touch-icon.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
    <?php // or, set /favicon.ico for IE10 win ?>
    <meta name="msapplication-TileColor" content="#fff;">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/icon/win8-tile-icon.png">
    <meta name="theme-color" content="#fff">
    <meta name="format-detection" content="telephone=no">
    
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>




</head>









<body id="404-pagezone" class="">

<header>















<!-- ハンバーガーメニューに関わる記述 -->
<div class="sp-navi sp-zone">
    <div class="Btn-navi_first">
        <a href="#" class="menuBtn"><span class="menu-icon"></span></a><p class="name">MENU</p>
    </div>
   <div class="Btn-navi">
        <a href="" class="menuBtn"><span class="menu-icon"></span><p class="name">MENU</p></a>
    </div>

    <div class="navi">
        <navi>
            <!-- 管理画面に記載したメニューの表示 -->
            <?php wp_nav_menu( array('theme_location'=>'header-menu'));?>
        </navi>
    </div>
</div>

<!-- ハンバーガーメニュー背景画像 -->
<div class="navi-background"></div>




</header><!-- /header -->













