<?php
/*-------------------------------
カスタムポストタイプ
-------------------------------*/
add_action( 'init', 'custom_posts');

// area , event , item 
function custom_posts() { 
	register_post_type( 'news',
		array(
			'labels' => array(
				'name' => 'お知らせ',
				'menu_name' => 'お知らせ',
				'singular_name' => 'news',
				'all_items' => 'お知らせ一覧',
				'add_new' => '新規登録', 
				'add_new_item' => '新規登録',
				'enter_title_here' => 'タイトルを入力',
			),
			'public' => true,
			'menu_position' =>4,
			'supports' => array('title','editor'),
			'has_archive' => true,//'custom_type',//true,
			'capability_type' => 'post',
			'show_ui' => true,
			'show_in_menu' => true,
			'hierarchical' => false,
			'rewrite' => true,
			'menu_icon' => 'dashicons-email'
		)
	);
	register_taxonomy(
		'information', // 分類名
		'news',  // 投稿タイプ名
		array(
			'hierarchical' => true,
			'label' => 'カテゴリー', // フロントで表示する分類名
			'hierarchical' => true,   // 階層構造か否か（trueの場合はカテゴリー、falseの場合はタグ）
			'show_ui' => true,
			'query_var' => true
		)
	);




	register_post_type( 'service',
		array(
			'labels' => array(
				'name' => 'サービス一覧',
				'menu_name' => 'サービス一覧',
				'singular_name' => 'service',
				'all_items' => 'サービス紹介',
				'add_new' => '新規登録', 
				'add_new_item' => '新規登録',
				'enter_title_here' => 'タイトルを入力',
			),
			'public' => true,
			'menu_position' =>4,
			'supports' => array('title','thumbnail'),
			'has_archive' => true,//'custom_type',//true,
			'capability_type' => 'post',
			'show_ui' => true,
			'show_in_menu' => true,
			'hierarchical' => false,
			'rewrite' => true,
			'menu_icon' => 'dashicons-analytics'
		)
	);
	// カスタム検索クエリを修正
	if (!function_exists('modify_search_query')) {
		function modify_search_query($query) {
			// メインクエリかつ検索時にのみ適用
			if ($query->is_search() && !is_admin() && $query->is_main_query()) {
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

	

	add_action('pre_get_posts', 'modify_search_query');


	register_post_type( 'recommendation',
		array(
			'labels' => array(
				'name'               => 'おすすめ情報',
				'menu_name'          => 'おすすめ情報',
				'singular_name'      => 'recommendation',
				'all_items'          => 'おすすめ情報紹介',
				'add_new'            => '新規登録',
				'add_new_item'       => '新規登録',
				'enter_title_here'   => 'タイトルを入力',
			),
			'public'             => true, 
			'menu_position'      => 4,    
			'supports'           => array( 'title', 'editor', 'thumbnail' ), 
			'has_archive'        => true, 
			'capability_type'    => 'post', 
			'show_ui'            => true,  
			'show_in_menu'       => true, 
			'hierarchical'       => false,
			'rewrite'            => true,
			'menu_icon'          => 'dashicons-analytics', 
		)
	);
	register_post_type( 'news',
		array(
			'labels' => array(
				'name' => 'お知らせ',
				'menu_name' => 'お知らせ',
				'singular_name' => 'news',
				'all_items' => 'お知らせ一覧',
				'add_new' => '新規登録', 
				'add_new_item' => '新規登録',
				'enter_title_here' => 'タイトルを入力',
			),
			'public' => true,
			'menu_position' =>4,
			'supports' => array('title','editor'),
			'has_archive' => true,//'custom_type',//true,
			'capability_type' => 'post',
			'show_ui' => true,
			'show_in_menu' => true,
			'hierarchical' => false,
			'rewrite' => true,
			'menu_icon' => 'dashicons-email'
		)
	);
	
	/*
	register_post_type( 'member',
		array(
			'labels' => array(
				'name' => 'メンバー紹介',
				'menu_name' => 'メンバー紹介',
				'singular_name' => 'member',
				'all_items' => 'メンバー紹介',
				'add_new' => '新規登録', 
				'add_new_item' => '新規登録',
				'enter_title_here' => '名前を入力（管理画面のみ表示されます）',
			),
			'public' => true,
			'menu_position' =>4,
			'supports' => array('title'),
			'has_archive' => true,//'custom_type',//true,
			'capability_type' => 'post',
			'show_ui' => true,
			'show_in_menu' => true,
			'hierarchical' => false,
			'rewrite' => true,
			'menu_icon' => 'dashicons-groups'
		)
	);
	register_taxonomy(
		'worktype', // 分類名
		'member',  // 投稿タイプ名
		array(
			'hierarchical' => true,
			'label' => '職種', // フロントで表示する分類名
			'hierarchical' => true,   // 階層構造か否か（trueの場合はカテゴリー、falseの場合はタグ）
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => '/member')
			//'rewrite' => true // アドレスのカスタマイズなし array('slug' => 'spot')
		)
	);

	//投稿ページの本文非表示をしたい場合
	//remove_post_type_support( 'post', 'editor' );
	//remove_post_type_support( 'page', 'editor' );
	*/
}
/*
add_filter('register_post_type_args', function($args, $post_type) {
    if ('post' == $post_type) {
        global $wp_rewrite;
        $archive_slug = 'news';
        $args['label'] = 'お知らせ';
        $args['has_archive'] = $archive_slug;
        $archive_slug = $wp_rewrite->root.$archive_slug;
        $feeds = '(' . trim( implode('|', $wp_rewrite->feeds) ) . ')';
        add_rewrite_rule("{$archive_slug}/?$", "index.php?post_type={$post_type}", 'top');
        add_rewrite_rule("{$archive_slug}/feed/{$feeds}/?$", "index.php?post_type={$post_type}".'&feed=$matches[1]', 'top');
        add_rewrite_rule("{$archive_slug}/{$feeds}/?$", "index.php?post_type={$post_type}".'&feed=$matches[1]', 'top');
        add_rewrite_rule("{$archive_slug}/{$wp_rewrite->pagination_base}/([0-9]{1,})/?$", "index.php?post_type={$post_type}".'&paged=$matches[1]', 'top');
    }
    return $args;
}, 10, 2);
*/


/* DON'T DELETE THIS CLOSING TAG */ ?>