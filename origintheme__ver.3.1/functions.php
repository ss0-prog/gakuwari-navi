<?php
/* ////////////////////////////////
Theme Name: ORIGIN Web Site
Theme URI: https://○○○○○○.com
Author: SakaShugo
Version: 2024/2/15 v3.0
//////////////////////////////// */

// Load Library
require_once('library/custom-admin.php');
require_once('library/custom-post-type.php');

/**
 * WPHEADのセットアップ
 */
function my_setup_theme() {
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'my_setup_theme' );



/*=========================
CSSとJAVASCRIPTの設定
=========================*/
function my_scripts() {
	// 管理画面では読み込まないようにします
	if ( !is_admin() ) { 
		// スタイルシートディレクトリーを取得する。この方法だと子テーマでもそのまま使える
		$dir = get_template_directory_uri();
		$cssdeps = array('reset-css');

		// スタイルシートを読み込みます
		wp_enqueue_style( 'reset-css', $dir.'/common/css/reset.css' );
		wp_enqueue_style( 'fonts-css', 'https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap',$cssdeps );
		wp_enqueue_style( 'font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
        wp_enqueue_style('google-fonts-noto', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&display=swap');
		wp_enqueue_style( 'slick-css', $dir.'/common/css/slick.css',$cssdeps );
		wp_enqueue_style( 'fancybox-css', $dir.'/common/js/fb3/jquery.fancybox.min.css',$cssdeps );      
        wp_enqueue_style( 'setting-css', $dir.'/common/css/setting.css',$cssdeps );
		wp_enqueue_style( 'style-css', $dir.'/common/css/style.css',$cssdeps );
        wp_enqueue_style( 'style0-css', $dir.'/common/css/style0.css',$cssdeps );
		wp_enqueue_style( 'basic-css', $dir.'/common/css/basic.css',$cssdeps );
        wp_enqueue_style( 'media-css', $dir.'/common/css/media.css',$cssdeps );
		/*wp_enqueue_style( 'media-css', $dir.'/common/css/media.css',$cssdeps );*/

		// Javascriptを読み込みます 

		// jQueryを差し替える
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', $dir.'/common/js/jquery-2.1.4.min.js' );

		// jQueryの後で入れるように指定しています
        wp_enqueue_script( 'easing-script', $dir.'/common/js/jquery.min.1.8.2.js', array('jquery'));
        wp_enqueue_script( 'ready-script', $dir.'/common/js/script.js', array('jquery'));
        wp_enqueue_script( 'slick-script', $dir.'/common/js/slick.min.js', array('jquery'));
        
		/*wp_enqueue_script( 'easing-script', $dir.'/common/js/jquery.easing.1.3.js', array('jquery'));
		wp_enqueue_script( 'slick-script', $dir.'/common/js/slick/slick.min.js', array('jquery'));
		wp_enqueue_script( 'fancybox-script', $dir.'/common/js/fb3/jquery.fancybox.min.js', array('jquery'));
		wp_enqueue_script( 'ready-script', $dir.'/common/js/script.js', array('jquery'));
        wp_enqueue_script( 'slick-script', $dir.'/common/js/jQueryAutoHeight.js', array('jquery'));*/
	}
}
add_action( 'wp_enqueue_scripts', 'my_scripts', 50 );


/*=========================
画像関連の設定
=========================*/
/* 画像切り抜き設定 */
add_theme_support('post-thumbnails');
add_image_size( 'afullo-thumb-200', 200, 200, true );
add_image_size( 'afullo-thumb-230', 230, 130, true );
add_image_size( 'afullo-thumb-1000', 1120, 480, true );
add_image_size( 'afullo-thumb-1600', 1600, 900, true );
/*add_image_size( 'afullo-slide', 1120, 480, true );*/

add_filter( 'image_size_names_choose', 'my_custom_image_sizes' );
function my_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'afullo-thumb-200' => __('200px by 200px'),
        'afullo-thumb-230' => __('230px by 130px'),
        'afullo-thumb-1600' => __('1600px by 900px'),
        /*'afullo-slide' => __('1120px by 480px')*/
    ) );
}

//画像がないときにNOimage用の画像を出す
function get_no_image() {
	return get_template_directory_uri()."/common/images/noimage2-300.png";
}


/* メニュー追加 */
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'ヘッダーメインメニュー' ),
      'footer-menu' => __( 'フッターメニュー' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

//メニューに属性追加
add_filter('walker_nav_menu_start_el', 'description_in_nav_menu', 10, 4);
 
function description_in_nav_menu($item_output, $item){
  return preg_replace('/(<a.*?>[^<]*?)</', '$1' . "<br><span>{$item->attr_title}</span><", $item_output);
}

/*
function catbase_function($link) {
    return str_replace("/category/", "/", $link);
}
function catbase_flush_rules() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
function catbase_rewrite($wp_rewrite) {
    $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_filter('user_trailingslashit', 'catbase_function');
add_action('init', 'catbase_flush_rules');
add_filter('generate_rewrite_rules', 'catbase_rewrite');
*/


//画像リンクにクラス追加
add_filter('wp_get_attachment_link','my_add_class_attachment_link',10,1);
function my_add_class_attachment_link($html){
  return str_replace('<a','<a class="fancybox" data-fancybox="group"',$html);
}

add_filter( 'get_the_archive_title', function ( $title ) {
    if( is_category() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
});

// リサイズ位置をずらす
function my_awesome_image_resize_dimensions( $payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop ){
    if( false ) return $payload;

    if ( $crop ) {
        $aspect_ratio = $orig_w / $orig_h;
        $new_w = min($dest_w, $orig_w);
        $new_h = min($dest_h, $orig_h);

        if ( !$new_w ) $new_w = intval($new_h * $aspect_ratio);
        if ( !$new_h ) $new_h = intval($new_w / $aspect_ratio);

        $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
        $crop_w = round($new_w / $size_ratio);
        $crop_h = round($new_h / $size_ratio);

        $s_x = ($orig_w - $crop_w) / 2;//左右中央
        $s_y = ($orig_h - $crop_h) / 2;//上下中央
        //$s_y = 0;//上
    } else {
        $crop_w = $orig_w;
        $crop_h = $orig_h;

        $s_x = ($orig_w - $crop_w) / 2;//左右中央
        $s_y = ($orig_h - $crop_h) / 2;//上下中央

        list( $new_w, $new_h ) = wp_constrain_dimensions( $orig_w, $orig_h, $dest_w, $dest_h );
    }

    if ( $new_w >= $orig_w && $new_h >= $orig_h ) return false;
    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter( 'image_resize_dimensions', 'my_awesome_image_resize_dimensions', 10, 6 );



//ウィジェット
/*function afullo_widgets_init() {
	register_sidebar( array(
		'name'          => __( '共通サイドバー上部', 'afullo' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'afullo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="title"><h4 class="widget-title">',
		'after_title'   => '</h4></div>'
	) );
	register_sidebar( array(
		'name'          => __( '共通サイドバー下部', 'afullo' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="title"><h4 class="widget-title">',
		'after_title'   => '</h4></div>'
	) );
}

add_action( 'widgets_init', 'afullo_widgets_init' );*/


add_filter( 'get_the_archive_title', function ($title) {
    if ( is_archive() ) {       
            $title = post_type_archive_title( '', false );   
        } elseif (  is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        }
    return $title;
});
add_filter('protected_title_format', 'remove_protected');
function remove_protected($title) {
       return '%s';
}




//抜粋の内容をカスタマイズ
function new_excerpt_more($more) {
    return '…';
}

add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
     return 80; 
}   
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );








function load_recent_posts() {
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 5;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $posts_per_page,
        'orderby'        => 'date',
        'order'          => 'DESC'
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>
            <?php
        }
    } else {
        echo '<li>新着記事はありません。</li>';
    }

    wp_die();
}
add_action('wp_ajax_load_recent_posts', 'load_recent_posts');
add_action('wp_ajax_nopriv_load_recent_posts', 'load_recent_posts');









// タクソノミーの設定
function register_custom_taxonomies() {
    // サービスタイプ
    register_taxonomy('service-type', 'service', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => 'サービスカテゴリ',
        ),
        'rewrite' => array(
            'slug' => 'service-type', 
            'with_front' => false,
        ),
        'show_ui' => true,
    ));

    // 年齢タイプ
    register_taxonomy('age-type', 'service', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => '年齢タイプ',
        ),
        'rewrite' => array(
            'slug' => 'age-type', 
            'with_front' => false,
        ),
        'show_ui' => true,
    ));

    // 地域タイプ
    register_taxonomy('region-type', 'service', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => '地域タイプ',
        ),
        'rewrite' => array(
            'slug' => 'region-type', 
            'with_front' => false,
        ),
        'show_ui' => true,
    ));
}
add_action('init', 'register_custom_taxonomies');

// カスタムリライトルールの設定
function custom_rewrite_rule() {
    add_rewrite_rule('^service/([^/]+)/([^/]+)/([^/]+)/?', 'index.php?post_type=service&service-type=$matches[1]&age-type=$matches[2]&region-type=$matches[3]', 'top');
}
add_action('init', 'custom_rewrite_rule');

// 検索クエリの修正
// カスタム検索クエリを修正
if (!function_exists('modify_search_query')) {
    function modify_search_query($query) {
        // メインクエリかつ検索時にのみ適用
        if ($query->is_search() && !is_admin() && $query->is_main_query()) {
            // 検索結果からおすすめ情報(recommendation)を除外
            $searchable_post_types = get_post_types(array('exclude_from_search' => false));
            unset($searchable_post_types['recommendation']);
            $query->set('post_type', array_values($searchable_post_types));

            $tax_query = [];

            // サービスタイプの条件
            if (!empty($_GET['service-type']) && $_GET['service-type'] !== '0') {
                $terms = is_array($_GET['service-type']) ? $_GET['service-type'] : [(int) $_GET['service-type']];
                $tax_query[] = [
                    'taxonomy' => 'service-type',
                    'field'    => 'term_id',
                    'terms'    => $terms,
                ];
            }

            // 年齢タイプの条件
            if (!empty($_GET['age-type']) && $_GET['age-type'] !== '0') {
                $terms = is_array($_GET['age-type']) ? $_GET['age-type'] : [(int) $_GET['age-type']];
                $tax_query[] = [
                    'taxonomy' => 'age-type',
                    'field'    => 'term_id',
                    'terms'    => $terms,
                ];
            }

            // 地域タイプの条件
            if (!empty($_GET['region-type']) && $_GET['region-type'] !== '0') {
                $terms = is_array($_GET['region-type']) ? $_GET['region-type'] : [(int) $_GET['region-type']];
                $tax_query[] = [
                    'taxonomy' => 'region-type',
                    'field'    => 'term_id',
                    'terms'    => $terms,
                ];
            }

            // 絞り込み条件を設定
            if (!empty($tax_query)) {
                $query->set('tax_query', $tax_query);
            }
        }
    }
    add_action('pre_get_posts', 'modify_search_query');
}



/* DON'T DELETE THIS CLOSING TAG */ ?>


