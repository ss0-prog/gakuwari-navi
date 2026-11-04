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
 * 一覧ページ(ジャンル・対象・地域)の見出しカード。
 *  英字の小見出し / タイトル / 件数(複数ページのときは、何ページ目かも)
 */
function gw_archive_hero($en, $title, $total, $paged, $pages) {
    echo '<header class="gw-svc-hero gw-arc-hero bseyifbslink">';
    echo '<p class="gw-svc-hero__en">' . esc_html($en) . '</p>';
    echo '<h1 class="gw-svc-hero__title">' . esc_html($title) . '</h1>';
    echo '<ul class="gw-svc-hero__stats"><li><b>' . esc_html($total) . '</b><span>件</span></li>';
    if ($pages > 1) {
        echo '<li><b>' . esc_html($paged) . '/' . esc_html($pages) . '</b><span>ページ</span></li>';
    }
    echo '</ul></header>';
}

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

		// テーマ内ファイルの更新時刻をバージョンにする(CSS/JSを更新したとき、ブラウザの古いキャッシュを使わせないため)
		$ver = function ( $path ) {
			$file = get_template_directory() . $path;
			return file_exists( $file ) ? filemtime( $file ) : null;
		};

		// スタイルシートを読み込みます
		wp_enqueue_style( 'reset-css', $dir.'/common/css/reset.css', array(), $ver('/common/css/reset.css') );
		wp_enqueue_style( 'fonts-css', 'https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap',$cssdeps );
		wp_enqueue_style( 'font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
        wp_enqueue_style('google-fonts-noto', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap');
		wp_enqueue_style( 'slick-css', $dir.'/common/css/slick.css',$cssdeps, $ver('/common/css/slick.css') );
		wp_enqueue_style( 'fancybox-css', $dir.'/common/js/fb3/jquery.fancybox.min.css',$cssdeps, $ver('/common/js/fb3/jquery.fancybox.min.css') );      
        wp_enqueue_style( 'setting-css', $dir.'/common/css/setting.css',$cssdeps, $ver('/common/css/setting.css') );
		wp_enqueue_style( 'style-css', $dir.'/common/css/style.css',$cssdeps, $ver('/common/css/style.css') );
        wp_enqueue_style( 'style0-css', $dir.'/common/css/style0.css',$cssdeps, $ver('/common/css/style0.css') );
		wp_enqueue_style( 'basic-css', $dir.'/common/css/basic.css',$cssdeps, $ver('/common/css/basic.css') );
        wp_enqueue_style( 'media-css', $dir.'/common/css/media.css',$cssdeps, $ver('/common/css/media.css') );
		/*wp_enqueue_style( 'media-css', $dir.'/common/css/media.css',$cssdeps );*/

		// Javascriptを読み込みます 

		// jQueryを差し替える
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', $dir.'/common/js/jquery-2.1.4.min.js', array(), $ver('/common/js/jquery-2.1.4.min.js') );

		// jQueryの後で入れるように指定しています
        wp_enqueue_script( 'easing-script', $dir.'/common/js/jquery.min.1.8.2.js', array('jquery'), $ver('/common/js/jquery.min.1.8.2.js') );
        wp_enqueue_script( 'ready-script', $dir.'/common/js/script.js', array('jquery'), $ver('/common/js/script.js') );
        wp_enqueue_script( 'slick-script', $dir.'/common/js/slick.min.js', array('jquery'), $ver('/common/js/slick.min.js') );
        
		/*wp_enqueue_script( 'easing-script', $dir.'/common/js/jquery.easing.1.3.js', array('jquery'));
		wp_enqueue_script( 'slick-script', $dir.'/common/js/slick/slick.min.js', array('jquery'));
		wp_enqueue_script( 'fancybox-script', $dir.'/common/js/fb3/jquery.fancybox.min.js', array('jquery'));
		wp_enqueue_script( 'ready-script', $dir.'/common/js/script.js', array('jquery'));
        wp_enqueue_script( 'slick-script', $dir.'/common/js/jQueryAutoHeight.js', array('jquery'));*/
	}
}
add_action( 'wp_enqueue_scripts', 'my_scripts', 50 );

/*=========================
reCAPTCHAはフォームのあるページだけで読み込む
(Contact Form 7 は全ページで読み込み、右下にバナーが出るため)
=========================*/
function gw_limit_recaptcha() {
	// お問い合わせ・掲載申込フォームのページ
	$form_pages = array( 'contact', 'contact-confirm', 'form', 'form-confirm' );
	if ( is_page( $form_pages ) ) {
		return;
	}
	// 上記以外でも、本文にContact Form 7のフォームを置いたページでは読み込む
	if ( is_singular() ) {
		$post = get_post();
		if ( $post && has_shortcode( $post->post_content, 'contact-form-7' ) ) {
			return;
		}
	}
	wp_dequeue_script( 'wpcf7-recaptcha' );
	wp_dequeue_script( 'google-recaptcha' );
}
add_action( 'wp_enqueue_scripts', 'gw_limit_recaptcha', 100 );


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
            // 検索結果は「学割一覧」(チケット表示)なので、サービスだけを対象にする
            // (お知らせ・固定ページ・おすすめ情報が「学割」として混ざらないようにする)
            $query->set('post_type', 'service');

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



/*
 * ============================================================
 * 【保留中】企業ロゴ画像の代替: チケット風カード(案C-3)
 * ------------------------------------------------------------
 * 使うとき:
 *   1) この囲み全体のコメント記号を外す(先頭の斜線アスタリスクと末尾のアスタリスク斜線)
 *   2) style0.css 末尾の同名コメントブロックも外す
 *   3) ロゴ画像を出している各テンプレートの
 *        if (has_post_thumbnail()) ... endif の塊を
 *        <?php gw_ticket_visual(); ?>
 *      に置き換える(index.php / search.php / taxonomy-*.php / single-service.php など)
 * ------------------------------------------------------------
 * 入力元:
 *   社名     ... カスタムフィールド service_company(空なら記事タイトル。古い名前 service_campany の値も読む)
 *   ジャンル ... タクソノミー service-type の最初のターム
 *   イラスト ... images/gakuwari.site-header-nav-img/ 内の既存カテゴリ画像
 * ※ 下の対応表のターム識別名のうち「要確認」は推測です。管理画面の実際の識別名に合わせてください。
 * ============================================================
 */

function gw_ticket_map() {
    // 色の系統: [面, 半券の縁, 強調色]
    $teal   = array('#e3f0f2', '#c6e2e6', '#2a7a82');
    $purple = array('#ece6f4', '#d8cce9', '#6a45a0');
    $indigo = array('#e6e9f7', '#d0d6f0', '#4a55b5');
    $amber  = array('#faf0d4', '#f3e0a8', '#8f6200');
    $rose   = array('#f8e6ec', '#efcdd9', '#a8325e');
    $green  = array('#e4f2e6', '#c8e3cc', '#2f7a3d');
    $orange = array('#fbe9dc', '#f5d3b9', '#a94f12');

    // ターム識別名 => [画像ファイル名(拡張子なし), 色]
    return array(
        'transportation' => array('traffic',    $teal),
        'food'           => array('food',       $orange),
        'park'           => array('themapark',  $green),
        'musium'         => array('art',        $indigo),
        'telephone'      => array('mobile',     $indigo),
        'beauty'         => array('hairsalon',  $rose),
        'pc'             => array('pc',         $teal),
        'music'          => array('music',      $purple),
        'movie'          => array('eiga',       $rose),
        'karaoke'        => array('karaoke',    $purple),
        'tour'           => array('tour',       $amber),
        'hotel'          => array('hotel',      $amber),     // 要確認
        'sports'         => array('sports',     $green),     // 要確認
        'ec'             => array('shopping',   $orange),
        'fashion'        => array('fashion',    $rose),      // 要確認
        'study'          => array('school',     $purple),
        'clinic'         => array('clinic',     $green),     // 要確認
    );
}

/*
 * サービスの「主カテゴリ」(ターム識別名)。チケットのタグ・色・アイコンに使うカテゴリと同じもの(最初のターム)。
 * 複数のカテゴリに入っているサービスは、主カテゴリの見出しの下にだけ出す、といった判定に使う。
 */
function gw_primary_service_type($post_id) {
    $terms = get_the_terms($post_id, 'service-type');
    return ($terms && !is_wp_error($terms)) ? $terms[0]->slug : '';
}

/*
 * チケットに出す名前。基本は会社名。ただし同じ会社名のサービスが複数あるとき(例: JTB(国内)・JTB(海外))は、
 * 区別がつくよう、サービス名(投稿タイトル)を出す。
 */
function gw_ticket_name($post_id) {
    static $counts = null;
    $name = gw_service_field('service_company', $post_id);
    if ($name === '' || $name === false || $name === null) {
        return get_the_title($post_id);
    }
    if ($counts === null) {
        global $wpdb;
        $counts = array();
        $rows = $wpdb->get_results(
            "SELECT company, COUNT(*) AS n FROM (
                SELECT p.ID,
                       COALESCE(NULLIF(MAX(CASE WHEN pm.meta_key = 'service_company' THEN pm.meta_value END), ''),
                                NULLIF(MAX(CASE WHEN pm.meta_key = 'service_campany' THEN pm.meta_value END), '')) AS company
                FROM {$wpdb->posts} p
                INNER JOIN {$wpdb->postmeta} pm ON pm.post_id = p.ID AND pm.meta_key IN ('service_company', 'service_campany')
                WHERE p.post_type = 'service' AND p.post_status = 'publish'
                GROUP BY p.ID
             ) t WHERE company IS NOT NULL GROUP BY company"
        );
        foreach ((array) $rows as $row) {
            $counts[$row->company] = (int) $row->n;
        }
    }
    return (isset($counts[$name]) && $counts[$name] > 1) ? get_the_title($post_id) : $name;
}

function gw_ticket_visual() {
    $post_id = get_the_ID();

    // 名前(会社名。同じ会社名が複数あるときは、サービス名)
    $name = gw_ticket_name($post_id);

    // ジャンル(最初のターム。なければ中立色・イラストなし)
    $tag   = '';
    $icon  = '';
    $color = array('#eef0f3', '#dde1e6', '#4b5563');
    $terms = get_the_terms($post_id, 'service-type');
    if ($terms && !is_wp_error($terms)) {
        $term = $terms[0];
        $tag  = $term->name;
        $map  = gw_ticket_map();
        if (isset($map[$term->slug])) {
            $icon  = get_template_directory_uri() . '/images/gakuwari.site-header-nav-img/' . $map[$term->slug][0] . '.png';
            $color = $map[$term->slug][1];
        }
    }

    // チケットの下に出すタグ: 地域(塗り)と対象(枠)。登録がない記事は、その部分を出さない
    $levels = array('大学生', '高校生', '中学生');
    $ages   = array();
    $age_terms = get_the_terms($post_id, 'age-type');
    if ($age_terms && !is_wp_error($age_terms)) {
        $have = wp_list_pluck($age_terms, 'name');
        foreach ($levels as $level) {
            if (in_array($level, $have, true)) {
                $ages[] = $level;
            }
        }
    }
    $region = '';
    $region_terms = get_the_terms($post_id, 'region-type');
    if ($region_terms && !is_wp_error($region_terms)) {
        $names  = wp_list_pluck($region_terms, 'name');
        $region = in_array('全国', $names, true) ? '全国' : $names[0] . (count($names) > 1 ? 'ほか' : '');
    }

    printf(
        '<span class="ticket" style="--tk-tint:%s;--tk-stub:%s;--tk-accent:%s">',
        esc_attr($color[0]), esc_attr($color[1]), esc_attr($color[2])
    );
    echo '<span class="ticket__face">';
    if ($tag !== '') {
        echo '<span class="ticket__tag">' . esc_html($tag) . '</span>';
    }
    echo '<span class="ticket__name">' . esc_html($name) . '</span>';
    echo '</span>';
    echo '<span class="ticket__stub">学割</span>';
    if ($icon !== '') {
        echo '<img class="ticket__icon" loading="lazy" src="' . esc_url($icon) . '" alt="">';
    }
    echo '</span>';

    if ($region !== '' || $ages) {
        echo '<span class="ticket__tags">';
        if ($region !== '') {
            echo '<span class="ticket__tag-region">' . esc_html($region) . '</span>';
        }
        foreach ($ages as $age) {
            echo '<span class="ticket__tag-age">' . esc_html($age) . '</span>';
        }
        echo '</span>';
    }
}

/*
 * 記事ページの、シェアとブックマークのボタン。
 * X・LINE・Facebook・はてなブックマークは、リンクで開く。リンクのコピー・端末の共有・ブックマークは、script.js が動かす
 */
function gw_share_bar() {
    $url   = get_permalink();
    $title = wp_strip_all_tags(get_the_title()) . ' | 学割NAVI';
    $u = rawurlencode($url);
    $t = rawurlencode($title);
    $links = array(
        array('x',        'X',        'X',  'https://x.com/intent/post?text=' . $t . '&url=' . $u),
        array('line',     'LINE',     'L',  'https://social-plugins.line.me/lineit/share?url=' . $u),
        array('facebook', 'Facebook', 'f',  'https://www.facebook.com/sharer/sharer.php?u=' . $u),
        array('hatena',   'はてブ',   'B!', 'https://b.hatena.ne.jp/entry/panel/?url=' . $u . '&btitle=' . $t),
    );
    ?>
    <div class="gw-share" data-url="<?php echo esc_url($url); ?>" data-title="<?php echo esc_attr($title); ?>">
        <p class="gw-share__label"><span>SHARE</span>シェア・ブックマーク</p>
        <ul class="gw-share__list">
            <?php foreach ($links as $l) : ?>
            <li>
                <a class="gw-share__btn gw-share__btn--<?php echo esc_attr($l[0]); ?>" href="<?php echo esc_url($l[3]); ?>" target="_blank" rel="noopener noreferrer">
                    <b class="gw-share__mark" aria-hidden="true"><?php echo esc_html($l[2]); ?></b><?php echo esc_html($l[1]); ?><span class="screen-reader-text">でシェア</span>
                </a>
            </li>
            <?php endforeach; ?>
            <li><button type="button" class="gw-share__btn gw-share__copy" hidden><i class="fa fa-link" aria-hidden="true"></i><span>リンクをコピー</span></button></li>
            <li><button type="button" class="gw-share__btn gw-share__native" hidden><i class="fa fa-share-alt" aria-hidden="true"></i><span>その他</span></button></li>
            <li><button type="button" class="gw-share__btn gw-share__bookmark" aria-pressed="false" hidden><i class="fa fa-bookmark-o" aria-hidden="true"></i><span>ブックマーク</span></button></li>
        </ul>
        <p class="gw-share__note" role="status" aria-live="polite"></p>
    </div>
    <?php
}

/*
 * 学割サービスの入力画面(Smart Custom Fields)。
 * 入力項目の構成・名前・ヒント・並び順を、このコードで決める。DBに保存された設定(ID 26/30/31/32/35/36)は、画面に出さない
 * 既存の記事のデータは、そのまま残る(項目名は変えていない。会社名と電話番号だけ、綴りを直した新しい名前を使う)
 * 「メインイメージ(写真)」は、表示で使わないので、入力画面から外した(保存済みの画像は、DBに残る)
 */
function gw_scf_service_fields($settings, $type, $id, $meta_type, $types) {
    if ($meta_type !== 'post' || $type !== 'service') {
        return $settings;
    }

    $make = function ($key, $title, array $groups) {
        $setting = SCF::add_setting($key, $title);
        foreach ($groups as $g) {
            $setting->add_group($g[0], $g[1], $g[2]);
        }
        return $setting;
    };

    $new = array();

    $new['gw-service-basic'] = $make('gw-service-basic', '基本', array(array(0, false, array(
        array('name' => 'service_name', 'label' => '施設名・サービス名', 'type' => 'text',
            'instruction' => 'ページのタイトルと、チケットに出ます。必須。'),
        array('name' => 'service_discount', 'label' => '割引の内容(一言)', 'type' => 'text',
            'instruction' => '例: 学生料金 1,000円 / 10%OFF / 初回無料。ページの上のほうに、大きく出ます。必須。'),
    ))));

    $new['gw-service-body'] = $make('gw-service-body', '学割の内容', array(array(0, false, array(
        array('name' => 'service_infotext', 'label' => '学割の概要', 'type' => 'wysiwyg',
            'instruction' => 'どんな学割かを、数行で書きます。ページの上のほうに出ます。必須。'),
        array('name' => 'service_about', 'label' => '詳細・条件', 'type' => 'wysiwyg',
            'instruction' => '対象、割引の細かい条件、注意点を書きます。必須。'),
    ))));

    $new['gw-service-need'] = $make('gw-service-need', '必要なもの', array(array('service_needs', true, array(
        array('name' => 'service_need_item', 'label' => '必要なもの', 'type' => 'text',
            'instruction' => '1つずつ入力して、「+」で行を増やします。例: 学生証の提示。'),
    ))));

    $new['gw-service-heads'] = $make('gw-service-heads', '小見出しのタイトル', array(array(0, false, array(
        array('name' => 'service_title_summary', 'label' => '「学割の概要」の見出し', 'type' => 'text',
            'instruction' => '空欄なら「どんな学割?」と出ます。'),
        array('name' => 'service_title_need', 'label' => '「必要なもの」の見出し', 'type' => 'text',
            'instruction' => '空欄なら「利用に必要なもの」と出ます。'),
        array('name' => 'service_title_about', 'label' => '「詳細・条件」の見出し', 'type' => 'text',
            'instruction' => '空欄なら「詳細・条件」と出ます。'),
    ))));

    $new['gw-service-info'] = $make('gw-service-info', '利用情報', array(array(0, false, array(
        array('name' => 'service_time', 'label' => '営業時間', 'type' => 'text'),
        array('name' => 'service_holidays', 'label' => '定休日', 'type' => 'text'),
        array('name' => 'service_pay', 'label' => '支払方法', 'type' => 'text'),
        array('name' => 'service_address', 'label' => '住所', 'type' => 'text'),
        array('name' => 'service_access', 'label' => 'アクセス', 'type' => 'text',
            'instruction' => '最寄り駅や、道順を書きます。'),
        array('name' => 'service_map', 'label' => 'Googleマップの住所', 'type' => 'text'),
        array('name' => 'service_term', 'label' => '対象期間', 'type' => 'text'),
        array('name' => 'service_note', 'label' => '備考', 'type' => 'text'),
    ))));

    $new['gw-service-contact'] = $make('gw-service-contact', '連絡先とリンク', array(array(0, false, array(
        array('name' => 'service_company', 'label' => '会社名', 'type' => 'text'),
        array('name' => 'service_phone', 'label' => '電話番号', 'type' => 'text'),
        array('name' => 'service_web', 'label' => '公式サイト', 'type' => 'text',
            'instruction' => '会社やお店の公式サイトのURL。必須。'),
        array('name' => 'service_url', 'label' => '学割の案内ページ', 'type' => 'text',
            'instruction' => '学割の条件が載っているページのURL。ヘッダーのボタンの行き先になります。必須。'),
    ))));

    $replaced = array(26, 30, 31, 32, 35, 36);
    foreach ($settings as $key => $setting) {
        if (!in_array((int) $key, $replaced, true)) {
            $new[$key] = $setting;
        }
    }
    return $new;
}
add_filter('smart-cf-register-fields', 'gw_scf_service_fields', 10, 5);

/*
 * 学割サービスの項目の値。綴りを直した新しい名前の値が空なら、古い名前の値を使う(移行の前後どちらでも表示が崩れない)
 */
function gw_service_field($field, $post_id = 0) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $value = SCF::get($field, $post_id);
    if ($value !== '' && $value !== null && $value !== false) {
        return $value;
    }
    $old = array('service_company' => 'service_campany', 'service_phone' => 'service_phonenunber');
    return isset($old[$field]) ? get_post_meta($post_id, $old[$field], true) : $value;
}

/* DON'T DELETE THIS CLOSING TAG */ ?>


