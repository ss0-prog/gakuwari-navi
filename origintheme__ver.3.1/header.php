<!DOCTYPE html>
<html lang="ja" class="no-js">
<head>
    <!-- (アクセス解析のタグは、公開用のこのリポジトリでは省略しています) -->

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="alternate"  hreflang="ja" href="<?php bloginfo('url'); ?>"/>
    <?php // mobile meta (hooray!) ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    
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

    <meta property="og:image" content="https://gakuwari.site/gks-cms/wp-content/uploads/2025/07/gakuwariNAVI-logo-main-OGP.png" />
</head>





<!-- "body"タグに各ページのスラッグを表示 -->
<?php
$catSlug = '';

if (is_post_type_archive() || is_single()) {
    $post_type = get_query_var('post_type');
    
    if (is_array($post_type)) {
        $post_type = reset($post_type);
    }
    
    $post_type_obj = get_post_type_object($post_type);

    if (is_post_type_archive()) {
        $catSlug = $post_type_obj->name;
    } elseif ($post_type) {
        $catSlug = $post_type;
    } else {
        $catSlug = 'post';
    }

} elseif (is_front_page() && is_home()) {
    $catSlug = 'index';
} else {
    $queried_object = get_queried_object();
    
    if (isset($queried_object->post_name)) {
        $catSlug = esc_attr($queried_object->post_name);
    } elseif (isset($queried_object->slug)) { // カテゴリーページやカスタムタクソノミー用
        $catSlug = esc_attr($queried_object->slug);
    } else {
        $catSlug = 'default-slug'; // デフォルト値
    }
}
?>

<body id="<?php echo $catSlug; ?>-pagezone" class="<?php echo $catSlug; ?>">
    <!-- (アクセス解析のタグは、省略) -->

    <header>

        <div class="head-all">

        </div>
        <main id="topcontent" class="topcontent ">
            <div class="wrapcontentcenter">
                <div class="head-text">
                    <div class="head-cont">
                        <?php if (is_front_page() && is_home()) : ?>
                        <h1 class="head-title-h1">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="head-title">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwariNAVI-logo-main001.png" alt="学割NAVI">
                            </a>
                        </h1>
                        <?php else : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="head-title">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwariNAVI-logo-main001.png" alt="学割NAVI">
                        </a>
                        <?php endif; ?>
                        

                        <?php 
                            //フォームを読み込む
                            get_search_form() 
                        ?>
                        <?php if ( is_search() ) : ?><h2><?php the_search_query(); ?></h2><?php endif; ?>

                    </div>
                </div>
            
                <div class="slick-nav-links">
                    <nav class="nav-links">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP<span class="arrow"></span></a>
                        <a href="<?php echo esc_url( home_url( '/service/' ) ); ?>">学割カテゴリ一覧<span class="arrow"></span></a>
                        <a href="<?php echo esc_url( home_url( '/recommendation/' ) ); ?>">おすすめ情報<span class="arrow"></span></a>
                        <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">News & Topics<span class="arrow"></span></a>
                        <a href="<?php echo esc_url( home_url( '/concept/' ) ); ?>">このサイトについて<span class="arrow"></span></a>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問合せ<span class="arrow"></span></a>
                    </nav>

                    <nav class="global-nav">
                        <div class="slide-global-nav-img">
                            <a href="<?php echo esc_url( home_url( '/service-type/transportation/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/traffic.png" alt="公共交通機関">
                                <p>公共交通機関</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/food/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/food.png" alt="飲食店">
                                <p>飲食店</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/park/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/themapark.png" alt="レジャー">
                                <p>遊園地・動物園など</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/musium/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/art.png" alt="美術館">
                                <p>美術館・博物館など</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/telephone/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/mobile.png" alt="携帯電話サービス">
                                <p>携帯電話サービス</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/pc/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/pc.png" alt="パソコン">
                                <p>パソコン・電子機器</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/music/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/music.png" alt="動画音楽配信">
                                <p>動画・音楽配信</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/movie/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/eiga.png" alt="映画館">
                                <p>映画館</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/karaoke/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/karaoke.png" alt="カラオケ">
                                <p>カラオケ</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/hotel/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/hotel.png" alt="ホテル等">
                                <p>ホテル・宿泊施設</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/sports/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/sports.png" alt="スポーツ">
                                <p>スポーツ</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/tour/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/tour.png" alt="ツアー">
                                <p>ツアー</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/fashion/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/fashion.png" alt="ファッション">
                                <p>ファッション</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/study/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/school.png" alt="教育">
                                <p>学習・教育</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/ec/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/shopping.png" alt="EC">
                                <p>EC・ネット通販</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/clinic/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/clinic.png" alt="クリニック">
                                <p>クリニック</p>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/service-type/beauty/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/hairsalon.png" alt="美容">
                                <p>美容</p>
                            </a>
                        </div> 
                    </nav>
                </div>
            </div>
        </main>
   










<!-- ハンバーガーメニューに関わる記述 -->
<div class="sp-navi sp-zone">
    <div class="Btn-navi_first">
        <a href="#" class="menuBtn"><span class="menu-icon"></span></a><p class="name">MENU</p>
    </div>
   <div class="Btn-navi">
        <a href="" class="menuBtn"><span class="menu-icon"></span><p class="name">MENU</p></a>
    </div>

    <div class="navi">
        <nav>
            <!-- 管理画面に記載したメニューの表示 -->
            <nav class="hum-menu">
                <ul class="hum-side">
                    <li class="csrnu side-fsrdfmru"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a></li>
                    <li>
                        <div class="service-list-wrapper">
                            <a href="<?php echo esc_url( home_url( '/service/' ) ); ?>" class="side-fsrdfmru csrnu ">サービス一覧</a>
                            <span class="header-submenu-toggle-btn"></span>
                        </div>
                        <ul class="service-submenu">
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/traffic.png" alt="公共交通機関">                                
                                <a href="<?php echo esc_url( home_url( '/service-type/transportation/' ) ); ?>">公共交通機関</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/food.png" alt="飲食店">
                                <a href="<?php echo esc_url( home_url( '/service-type/food/' ) ); ?>">飲食店</a>                               
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/themapark.png" alt="レジャー">
                                <a href="<?php echo esc_url( home_url( '/service-type/park/' ) ); ?>">遊園地・動物園・植物園</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/art.png" alt="美術館">
                                <a href="<?php echo esc_url( home_url( '/service-type/musium/' ) ); ?>">美術館・博物館など</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/mobile.png" alt="携帯電話サービス">
                                <a href="<?php echo esc_url( home_url( '/service-type/telephone/' ) ); ?>">携帯電話サービス</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/pc.png" alt="パソコン">
                                <a href="<?php echo esc_url( home_url( '/service-type/pc/' ) ); ?>">パソコン・電子機器</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/music.png" alt="動画音楽配信">
                                <a href="<?php echo esc_url( home_url( '/service-type/music/' ) ); ?>">動画・音楽配信</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/eiga.png" alt="映画館">
                                <a href="<?php echo esc_url( home_url( '/service-type/movie/' ) ); ?>">映画館</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/karaoke.png" alt="カラオケ">
                                <a href="<?php echo esc_url( home_url( '/service-type/karaoke/' ) ); ?>">カラオケ</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/hotel.png" alt="ホテル等">
                                <a href="<?php echo esc_url( home_url( '/service-type/hotel/' ) ); ?>">ホテル・宿泊施設</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/sports.png" alt="スポーツ">
                                <a href="<?php echo esc_url( home_url( '/service-type/sports/' ) ); ?>">スポーツ</a>
                            </li>                           
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/shopping.png" alt="EC">
                                <a href="<?php echo esc_url( home_url( '/service-type/ec/' ) ); ?>">EC・ネット通販</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/fashion.png" alt="ファッション">
                                <a href="<?php echo esc_url( home_url( '/service-type/fashion/' ) ); ?>">ファッション</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/tour.png" alt="ツアー">
                                <a href="<?php echo esc_url( home_url( '/service-type/tour/' ) ); ?>">ツアー</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/school.png" alt="教育">
                                <a href="<?php echo esc_url( home_url( '/service-type/study/' ) ); ?>">学習・教育</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/clinic.png" alt="クリニック">
                                <a href="<?php echo esc_url( home_url( '/service-type/clinic/' ) ); ?>">クリニック</a>
                            </li>
                            <li>
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/hairsalon.png" alt="美容">
                                <a href="<?php echo esc_url( home_url( '/service-type/beauty/' ) ); ?>">美容</a>
                            </li>
                        </ul>
                    </li>

                    <li class="csrnu side-fsrdfmru"><a href="<?php echo esc_url( home_url( '/recommendation/' ) ); ?>" class="side-reco">おすすめ情報</a></li>
                    <li class="csrnu side-fsrdfmru"><a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">News&Topics</a></li>
                    <li class="csrnu side-fsrdfmru"><a href="<?php echo esc_url( home_url( '/concept/' ) ); ?>">このサイトについて</a></li>
                    <li class="csrnu umdrsk side-fsrdfmru"><a href="<?php echo esc_url( home_url( '/form/' ) ); ?>">学割情報<br>掲載申込フォーム</a></li>
                    <li class="csrnu side-fsrdfmru"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問合せ</a></li>
                    
                </ul>
            </nav>
            <div class="sidebar-search">
                <!-- 検索フォーム -->
                <?php get_search_form(); ?>
                <?php if ( is_search() ) : ?><h2><?php the_search_query(); ?></h2><?php endif; ?>

                <!-- 詳細検索ボタン -->
                <button class="toggle-advanced-search">詳細検索</button>

                <!-- 詳細検索フォーム -->
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="advanced-search">
                    <input type="hidden" name="post_type" value="service"> <!-- サービス投稿タイプ -->

                    <!-- サービスタイプ -->
                    <label>サービスカテゴリ:</label>
                    <?php
                    // サービスタイプタクソノミーの選択肢
                    wp_dropdown_categories(array(
                        'taxonomy' => 'service-type',
                        'name' => 'service-type',
                        'show_option_all' => 'すべて',
                        'value_field' => 'term_id',
                        'selected' => isset($_GET['service-type']) ? $_GET['service-type'] : ''
                    ));
                    ?>

                    <!-- 年齢タイプ -->
                    <label>年齢タイプ:</label>
                    <?php
                    // 年齢タイプタクソノミーの選択肢
                    wp_dropdown_categories(array(
                        'taxonomy' => 'age-type',
                        'name' => 'age-type',
                        'show_option_all' => 'すべて',
                        'value_field' => 'term_id',
                        'selected' => isset($_GET['age-type']) ? $_GET['age-type'] : ''
                    ));
                    ?>

                    <!-- 地域タイプ -->
                    <label>地域タイプ:</label>
                    <?php
                    // 地域タイプタクソノミーの選択肢
                    wp_dropdown_categories(array(
                        'taxonomy' => 'region-type',
                        'name' => 'region-type',
                        'show_option_all' => 'すべて',
                        'value_field' => 'term_id',
                        'selected' => isset($_GET['region-type']) ? $_GET['region-type'] : ''
                    ));
                    ?>

                    <div class="search-actions">
                        <button type="reset" class="reset-btn">リセット</button>
                        <button type="submit" class="search-btn">検索</button>
                    </div>
                </form>
            </div>

        </nav>
    </div>
</div>

<!-- ハンバーガーメニュー背景画像 -->
<div class="navi-background"></div>




</header><!-- /header -->













