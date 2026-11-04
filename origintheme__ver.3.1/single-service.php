<?php get_header(); 
while ( have_posts() ) : the_post();?>
<?php
  echo SCF::get('scf_field');
?>

<?php
$gw_id       = get_the_ID();
$gw_img      = get_template_directory_uri() . '/images/gakuwari.site-header-nav-img/';
$gw_map      = function_exists('gw_ticket_map') ? gw_ticket_map() : array();
$service_name     = SCF::get('service_name', $gw_id);
$service_infotext = SCF::get('service_infotext', $gw_id);
$service_about    = SCF::get('service_about', $gw_id);
if (empty($service_name)) { $service_name = get_the_title(); }
$gw_discount = trim((string) SCF::get('service_discount', $gw_id));
$gw_need = array();
foreach ((array) SCF::get('service_needs', $gw_id) as $gw_row) {
    $gw_item = isset($gw_row['service_need_item']) ? trim((string) $gw_row['service_need_item']) : '';
    if ($gw_item !== '') { $gw_need[] = $gw_item; }
}
$gw_title_summary = trim((string) SCF::get('service_title_summary', $gw_id));
$gw_title_need    = trim((string) SCF::get('service_title_need', $gw_id));
$gw_title_about   = trim((string) SCF::get('service_title_about', $gw_id));
if ($gw_title_summary === '') { $gw_title_summary = 'どんな学割?'; }
if ($gw_title_need === '')    { $gw_title_need = '利用に必要なもの'; }
if ($gw_title_about === '')   { $gw_title_about = '詳細・条件'; }

// ジャンル(最初のターム)から、アイコンと色を決める
$gw_genre = null; $gw_icon = ''; $gw_color = array('#eef0f3', '#dde1e6', '#4b5563');
$gw_terms = get_the_terms($gw_id, 'service-type');
if ($gw_terms && !is_wp_error($gw_terms)) {
    $gw_genre = $gw_terms[0];
    if (isset($gw_map[$gw_genre->slug])) {
        $gw_icon  = $gw_img . $gw_map[$gw_genre->slug][0] . '.png';
        $gw_color = $gw_map[$gw_genre->slug][1];
    }
}
// タグ(ジャンル・対象・地域)。ターム一覧ページへのリンク
$gw_tags = array();
foreach (array('service-type', 'age-type', 'region-type') as $tx) {
    $ts = get_the_terms($gw_id, $tx);
    if ($ts && !is_wp_error($ts) && $tx === 'age-type') {
        // 大学生 → 高校生 → 中学生 → そのほか の順に並べる
        $order = array('university' => 1, 'high' => 2, 'junior-high' => 3, 'other' => 4);
        usort($ts, function ($a, $b) use ($order) {
            return (isset($order[$a->slug]) ? $order[$a->slug] : 9) - (isset($order[$b->slug]) ? $order[$b->slug] : 9);
        });
    }
    if ($ts && !is_wp_error($ts)) {
        foreach ($ts as $t) {
            $l = get_term_link($t);
            if (!is_wp_error($l)) { $gw_tags[] = array($t->name, $l, $tx); }
        }
    }
}

// 基本情報の項目
$details = array(
    'service_company'     => '会社名',
    'service_web'         => 'Webサイト',
    'service_phone'       => '電話番号',
    'service_address'     => '住所',
    'service_time'        => '営業時間',
    'service_holidays'    => '定休日',
    'service_pay'         => '支払方法',
    'service_term'        => '対象期間',
    'service_note'        => '備考',
    'service_url'         => '学割URL',
    'service_access'      => 'アクセス',
    'service_map'         => '地図',
);
$gw_rows = array();
foreach ($details as $field => $label) {
    $v = gw_service_field($field, $gw_id);
    if (!empty($v)) { $gw_rows[$field] = array($label, $v); }
}
$gw_ages = array();
foreach ($gw_tags as $tag) {
    if ($tag[2] === 'age-type') { $gw_ages[] = $tag[0]; }
}
if ($gw_ages) {
    $gw_rows = array('gw_age' => array('対象', implode('・', $gw_ages))) + $gw_rows;
}
$gw_url = SCF::get('service_url', $gw_id);
?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a gw-sv">

                <nav class="gw-crumb" aria-label="現在位置">
                    <a href="<?php echo esc_url(home_url('/')); ?>">TOP</a><span>›</span><a href="<?php echo esc_url(home_url('/service/')); ?>">学割カテゴリ一覧</a><?php if ($gw_genre) : $gl = get_term_link($gw_genre); if (!is_wp_error($gl)) : ?><span>›</span><a href="<?php echo esc_url($gl); ?>"><?php echo esc_html($gw_genre->name); ?></a><?php endif; endif; ?><span>›</span><em><?php echo esc_html($service_name); ?></em>
                </nav>

                <!-- ヘッダー: ジャンルの色のカード(アイコン・名前・タグ・公式ページへのボタン) -->
                <header class="gw-sv-hero bseyifbslink">
                    <?php if ($gw_icon !== '') : ?>
                        <span class="gw-sv-hero__icon"><img src="<?php echo esc_url($gw_icon); ?>" alt="" width="96" height="96"></span>
                    <?php endif; ?>
                    <div class="gw-sv-hero__text">
                        <p class="gw-sv-hero__genre"><?php echo $gw_genre ? esc_html($gw_genre->name) : 'STUDENT DISCOUNT'; ?></p>
                        <h1 class="gw-sv-hero__title"><?php echo esc_html($service_name); ?></h1>
                        <?php if ($gw_discount !== '') : ?>
                        <p class="gw-sv-hero__deal"><span>学割</span><?php echo esc_html($gw_discount); ?></p>
                        <?php endif; ?>
                        <?php if ($gw_tags) : ?>
                        <ul class="gw-sv-tags">
                            <?php foreach ($gw_tags as $t) : ?>
                                <li><a class="gw-sv-tag gw-sv-tag--<?php echo esc_attr($t[2]); ?>" href="<?php echo esc_url($t[1]); ?>"><?php echo esc_html($t[0]); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <?php if ($gw_url) : ?>
                        <a class="gw-sv-hero__btn" href="<?php echo esc_url($gw_url); ?>" target="_blank" rel="noopener noreferrer">学割ページを見る</a>
                    <?php endif; ?>
                </header>

                <?php if (!empty($service_infotext)) : ?>
                <section class="gw-sv-card gw-sv-summary gw-dots gw-dots--br bseyifbslink">
                    <h2 class="gw-sv-card__label"><span>SUMMARY</span><?php echo esc_html($gw_title_summary); ?></h2>
                    <div class="gw-sv-card__body"><?php echo $service_infotext; ?></div>
                </section>
                <?php endif; ?>

                <?php if ($gw_need) : ?>
                <section class="gw-sv-card gw-sv-need bseyifbslink">
                    <h2 class="gw-sv-card__label"><span>NEED</span><?php echo esc_html($gw_title_need); ?></h2>
                    <ul class="gw-sv-need__list">
                        <?php foreach ($gw_need as $item) : ?>
                        <li><?php echo esc_html($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </section>
                <?php endif; ?>

                <?php if (!empty($service_about)) : ?>
                <section class="gw-sv-card gw-sv-about gw-dots gw-dots--br bseyifbslink">
                    <h2 class="gw-sv-card__label"><span>DETAIL</span><?php echo esc_html($gw_title_about); ?></h2>
                    <div class="gw-sv-card__body"><?php echo wp_kses_post($service_about); ?></div>
                </section>
                <?php endif; ?>

                <?php if ($gw_rows) : ?>
                <section class="gw-sv-card gw-sv-info bseyifbslink">
                    <h2 class="gw-sv-card__label"><span>INFORMATION</span>基本情報</h2>
                    <dl class="gw-sv-dl">
                        <?php foreach ($gw_rows as $field => $row) : ?>
                        <div class="gw-sv-dl__row">
                            <dt><?php echo esc_html($row[0]); ?></dt>
                            <dd>
                                <?php if ($field === 'service_web' || $field === 'service_url') : ?>
                                    <a class="gw-sv-dl__url" href="<?php echo esc_url($row[1]); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($row[1]); ?></a>
                                    <a class="gw-sv-dl__go" href="<?php echo esc_url($row[1]); ?>" target="_blank" rel="noopener noreferrer">該当ページへ</a>
                                <?php else : ?>
                                    <?php echo esc_html($row[1]); ?>
                                <?php endif; ?>
                            </dd>
                        </div>
                        <?php endforeach; ?>
                    </dl>
                </section>
                <?php endif; ?>

                <?php gw_share_bar(); ?>

                <p class="gw-reco-back"><a href="<?php echo esc_url(home_url('/service/')); ?>">学割カテゴリ一覧へ戻る</a></p>

            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </section> 
        <div class="related-articles">
            <div class="related-articles__header">
                <h2 class="related-articles__title">関連する記事</h2>
            </div>
                <ul class="related-articles__list">
                    <?php
                    $taxonomy = 'service-type';
                    $current_terms = get_the_terms($post->ID, $taxonomy);
                    $terms = $current_terms ? array_map(function($term) { return $term->slug; }, $current_terms) : [];
                        $args = array(
                        'post_type' => 'service',
                        'posts_per_page' => 20,
                        'orderby' => 'rand',
                        'post__not_in' => array($post->ID),
                        'tax_query' => array(
                            array(
                                'taxonomy' => $taxonomy,
                                'terms' => $terms,
                                'field' => 'slug',
                            ),
                        ),
                    );
                    $my_query = new WP_Query($args);
                    if($my_query->have_posts()) :
                        while($my_query->have_posts()): $my_query->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="content-nuiafe bseyifbslink">
                                    <div class="top-content-img">
                                        <!-- 基本的な画像表示 -->
                                        <?php gw_ticket_visual(); ?>
                                        <?php /* 【テスト前の表示】チケットを無効に戻すときは、上の行を消し、この囲みのコメント記号を外す
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('class' => 'hover-zoom')); ?>
                                        <?php else : ?>
                                            <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/example-image/no-image.jpg" alt="No Image" class="hover-zoom">
                                        <?php endif; ?>
                                        */ ?>
                                    </div>
                                    
                                    <?php /* 【テスト前の表示】チケットを無効に戻すときは、この囲みのコメント記号を外す
                                    <p class="top-content-text"><?php the_title(); ?></p>
                                    <p class="top-content-subtext"><?php echo get_post_meta(get_the_ID(), 'service_campany', true); ?></p>
                                    */ ?>
                                    <div class="favorite item-list-favorite" data-post-id="<?php the_ID(); ?>">
                                        <a href="#" class="favorite-icon favorite-off"></a>
                                        <a href="#" class="favorite-icon favorite-on hide"></a>
                                    </div>
                                    <div class="top-content-tags">
                                        <div class="related-articles__meta-cat">
                                            <?php
                                            $related_cats = get_the_terms(get_the_ID(), 'service-type');
                                            if ($related_cats) :
                                                foreach ($related_cats as $cat) :
                                            ?>
                                                <span class="tag"><?php echo esc_html($cat->name); ?></span>
                                            <?php endforeach; endif; ?>
                                        </div>
                                    </div>
                                </a>
                    <?php endwhile; else: ?>
                    <p>現在準備中です。</p>
                    <?php endif; wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
    </div>
</main>
<?php endwhile;
get_footer(); ?>
