<?php
/*-------------------------------
管理画面のカスタマイズ
-------------------------------*/

/*=========================
 ログイン画面
=========================*/
//ログイン画面のロゴのカスタマイズ
function custom_login_logo() {
 echo '<style type="text/css">h1 a { background: url('.get_bloginfo('template_directory').'/icon/login-logo.png) 50% 50% no-repeat !important; width:100% !important; }</style>';
 }
add_action('login_head', 'custom_login_logo');

if ( is_multisite() ) {
 $login_header_url   = network_home_url();
 $login_header_title = $current_site->site_name;
 } else {
 $login_header_url   = __( 'http://afullo.co.jp/' );
 $login_header_title = __( 'Powered by Atelier Afullo' );
}

//fancybox
add_filter( 'image_send_to_editor', 'add_fancybox' );

function add_fancybox( $html ) {
	$class = 'fancybox';
    if(preg_match('/<a href="https?:\/\/+[-_.\/a-zA-Z0-9]+(?:png|jpg|jpeg|gif)"><img/' , $html)){
        $html = str_replace( '<a ', '<a class="'. $class. '" ', $html );
    }
    return $html;
}

/*=========================
 管理画面全般
=========================*/


// フッターWordPressリンクを非表示に
function custom_admin_footer() {
 echo '<a href="mailto:mail@example.com">お問い合わせ</a>';
 }
add_filter('admin_footer_text', 'custom_admin_footer');


//ダッシュボードカスタマイズ
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
//wp_add_dashboard_widget('custom_help_widget', '管理画面について', 'dashboard_text');

	if (!current_user_can('level_10')) { //level10以下のユーザーの場合ウィジェットをunsetする
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']); // アクティビティ
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // 現在の状況
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイック投稿
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // 最近の下書き
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
		unset($wp_meta_boxes['dashboard']['side']['core']['feedwordpress_dashboard']); //feedwordpress_dashboard
	}
}

add_action('admin_menu', 'basic_menu');

function basic_menu() {
	//add_menu_page(ページタイトル, メニュータイトル, 権限, メニュースラッグ, 関数, アイコン URL, 場所);
  add_menu_page('基本情報設定', '基本情報設定', 'edit_themes', 'basic_menu', 'basic_options_page','',2);
  add_action( 'admin_init', 'register_basic_settings' );
  global $menu;
  unset($menu[5]);//投稿非表示
  $menu[20][0]  = 'ページ一覧';//固定ページ
}

function register_basic_settings() {   
	register_setting( 'basic-settings-group', 'basic_name' );
	register_setting( 'basic-settings-group', 'basic_tel' );
	register_setting( 'basic-settings-group', 'basic_fax' );
	register_setting( 'basic-settings-group', 'basic_zipcode' );
	register_setting( 'basic-settings-group', 'basic_address' );
	register_setting( 'basic-settings-group', 'basic_reception_time' );
	register_setting( 'basic-settings-group', 'basic_facebook' );
}

function basic_options_page() {
	// カスタムメニューページを読み込む
    require TEMPLATEPATH.'/admin/basic_settings.php';
}


/*
function dashboard_text() {
echo '<p>左のメニューから操作をしてください。<br /><br />
<ul id="mymenu">
<li><b>基本情報設定</b>　…　会社名などを設定できます。会社概要などに出ます。 
<p class="edit"><a href=""><span class="dashicons dashicons-admin-page"></span>新規追加</a></p></li>
<li><b>投稿</b>　…　NEWS & TOPICSと、ブログの更新を行います。
<p class="edit"><a href="http://tamuratomo.com/stccms/wp-admin/post-new.php"><span class="dashicons dashicons-admin-page"></span>新規追加</a></p></li>
<li><b>コレクション</b>　…　コレクションを追加します。
<p class="edit"><a href="http://tamuratomo.com/stccms/wp-admin/post-new.php?post_type=collection"><span class="dashicons dashicons-admin-page"></span>新規追加</a></p></li>
<li><b>商品</b>　…　商品を追加します。
<p class="edit"><a href="http://tamuratomo.com/stccms/wp-admin/post-new.php?post_type=item"><span class="dashicons dashicons-admin-page"></span>新規追加</a></p></li>
<li><b>ピックアップ</b>　…　トップページのピックアップを３つまで、自由に変更できます。</li>
<li><b>固定ページ</b>　…　店舗案内、デザイナーページや、コンセプトページ、プライバシーポリシーのページが編集できます。</li>
</ul>
<br>
<a class="manual" href="http://tamuratomo.com/manual/操作マニュアル.pdf" target="_blank"><span class="dashicons dashicons-info"></span>操作マニュアルをダウンロード</a><br><br>
操作方法が不明な場合は、<a href="mailto:mail@example.com">アトリエあふろwebteam</a>へ</p>
<style type="text/css" media="all">#mymenu li { background-color:#f5f5f5; padding:10px; margin-bottom:10px; border-radius:4px;}
.edit { text-align:right; padding-right:10px; margin-bottom:0px; }
.manual { display:block; padding:4px; background:#F08C00; color:#fff; font-weight:bold; border-radius:5px; text-align:center; width:50%; margin:10px auto;}</style>';
}
*/
/*
add_action('admin_head', 'disable_help_link');
function disable_help_link() {
    echo '<style type="text/css">
            #contextual-help-link-wrap {display: none !important;}
            #screen-options-link-wrap {display: none !important;}
          </style>';
}*/




// メニューを非表示にする
/*
function remove_menus () {
	 global $menu;
	
	 //unset($menu[2]); // ダッシュボード
	 //unset($menu[4]); // メニューの線1
	 //unset($menu[5]); // 投稿
	 unset($menu[25]); // コメント
	 //unset($menu[59]); // メニューの線2
	 //unset($menu[60]); // テーマ
	 //unset($menu[65]); // プラグイン
	 //unset($menu[99]); // ローカルニュース
	 if (!current_user_can('level_10')) { //level10以下のユーザーの場合メニューをunsetする
	 ($menu[10]); // メディア
	 //unset($menu[15]); // リンク
	 //unset($menu[20]); // ページ
	 //unset($menu[70]); // プロフィール
	 unset($menu[75]); // ツール
	 unset($menu[80]); // 設定
	 unset($menu[100]); // feedwordpress
	 remove_menu_page('wpcf7'); //Contact Form 7
	 }
}
*/


// 管理バーの項目を非表示
/*
function remove_admin_bar_menu( $wp_admin_bar ) {
	$wp_admin_bar->remove_menu( 'wp-logo' ); // WordPressシンボルマーク
	$wp_admin_bar->remove_menu( 'comments' ); // コメント
	$wp_admin_bar->remove_menu( 'new-content' ); // 新規
	//$wp_admin_bar->remove_menu( 'wpseo-menu' ); // SEO
	//$wp_admin_bar->remove_menu('my-account'); // マイアカウント
}
add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 99 );
*/

/*=========================
 投稿画面
=========================*/

//見出しの限定
function custom_editor_settings( $initArray ){
    // WordPress3くらい
    //$initArray['theme_advanced_blockformats'] = 'p,address,pre,code,h3,h4,h5,h6';
    // WordPress4から
    $initArray['block_formats'] = "大見出し=h2; 中見出し=h3; 小見出し=h4; 段落=p; グループ=div;";
    return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );


/* DON'T DELETE THIS CLOSING TAG */ ?>