<?php
/**
 * フッター
 *  ・上端: チケットの切り取り線 / 掲載のご案内 / 本体(ブランド・メニュー・カテゴリ) / 最下段(コピーライト・戻るボタン)
 *  ・リンク先は従来と同じ(メニュー8件、カテゴリ17件)
 */
$gw_img  = get_template_directory_uri() . '/images/gakuwari.site-header-nav-img/';
$gw_menu = array(
    array('/',               'TOP'),
    array('/service/',       '学割カテゴリ一覧'),
    array('/concept/',       'サイトコンセプト'),
    array('/recommendation/', 'おすすめ情報'),
    array('/news/',          'News&Topics'),
    array('/contact/',       'お問合せ'),
    array('/company/',       '運営会社'),
    array('/form/',          '学割情報掲載申込'),
);
// array(ターム識別名, アイコン画像(拡張子なし), 表示名)
$gw_cats = array(
    array('transportation', 'traffic',   'JR・私鉄などの公共交通機関'),
    array('food',           'food',      '飲食店'),
    array('park',           'themapark', '遊園地・動物園・植物園など'),
    array('musium',         'art',       '美術館・博物館など'),
    array('telephone',      'mobile',    '携帯電話サービス'),
    array('pc',             'pc',        'パソコン・電子機器'),
    array('music',          'music',     '動画・音楽配信'),
    array('movie',          'eiga',      '映画館'),
    array('karaoke',        'karaoke',   'カラオケ'),
    array('hotel',          'hotel',     'ホテル・宿泊施設'),
    array('sports',         'sports',    'スポーツ'),
    array('ec',             'shopping',  'EC・ネット通販'),
    array('fashion',        'fashion',   'ファッション'),
    array('tour',           'tour',      'ツアー'),
    array('study',          'school',    '学習・教育'),
    array('clinic',         'clinic',    'クリニック'),
    array('beauty',         'hairsalon', '美容'),
);

// ブランド欄の「新着の学割」: サービス記事の最新3件(絞り込みは日付順。メインのループには影響しない)
$gw_new = new WP_Query(array(
    'post_type'           => 'service',
    'posts_per_page'      => 3,
    'orderby'             => 'date',
    'order'               => 'DESC',
    'no_found_rows'       => true,
    'ignore_sticky_posts' => true,
));
$gw_icon_map = function_exists('gw_ticket_map') ? gw_ticket_map() : array();
?>
<footer class="gw-footer gw-dots gw-dots--br">

    <!-- 上端: チケットの切り取り線(点線) -->
    <div class="gw-footer__tear" aria-hidden="true"></div>

    <!-- 掲載のご案内 -->
    <section class="gw-footer__cta wrapcontent bseyifbslink">
        <div class="gw-footer__cta-icon" aria-hidden="true">
            <img src="<?php echo esc_url($gw_img . 'school.png'); ?>" alt="" width="64" height="64" loading="lazy">
        </div>
        <div class="gw-footer__cta-text">
            <p class="gw-footer__cta-lead">学割情報の掲載をご希望の方へ</p>
            <p class="gw-footer__cta-sub">掲載のお申し込みは、専用のフォームから受け付けています。</p>
        </div>
        <div class="gw-footer__cta-actions">
            <a class="gw-footer__btn gw-footer__btn--primary" href="<?php echo esc_url(home_url('/form/')); ?>">学割情報 掲載申込</a>
            <a class="gw-footer__btn" href="<?php echo esc_url(home_url('/contact/')); ?>">お問合せ</a>
        </div>
    </section>

    <!-- 本体 -->
    <div class="gw-footer__main wrapcontent">

        <div class="gw-footer__brand bseyifbslink">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="gw-footer__logo">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/gakuwariNAVI-logo-main001.png'); ?>" alt="学割NAVI" width="1200" height="628" loading="lazy">
            </a>
            <p class="gw-footer__lead">大学生・高校生・中学生が得する情報を、まとめた学割情報ポータルサイトです。</p>
            <div class="gw-footer__search"><?php get_search_form(); ?></div>

            <?php if ($gw_new->have_posts()) : ?>
            <div class="gw-footer__new">
                <p class="gw-footer__new-title"><span class="gw-footer__new-badge">NEW</span>新着の学割</p>
                <ul>
                    <?php while ($gw_new->have_posts()) : $gw_new->the_post();
                        $gw_name = gw_service_field('service_company', get_the_ID());
                        if ($gw_name === '' || $gw_name === false || $gw_name === null) {
                            $gw_name = get_the_title();
                        }
                        $gw_icon  = '';
                        $gw_terms = get_the_terms(get_the_ID(), 'service-type');
                        if ($gw_terms && !is_wp_error($gw_terms) && isset($gw_icon_map[$gw_terms[0]->slug])) {
                            $gw_icon = $gw_img . $gw_icon_map[$gw_terms[0]->slug][0] . '.png';
                        }
                    ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php if ($gw_icon !== '') : ?>
                                <img src="<?php echo esc_url($gw_icon); ?>" alt="" width="32" height="32" loading="lazy">
                            <?php endif; ?>
                            <span class="gw-footer__new-name"><?php echo esc_html($gw_name); ?></span>
                            <time class="gw-footer__new-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y/m/d')); ?></time>
                        </a>
                    </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>

        <nav class="gw-footer__menu bseyifbslink" aria-label="サイトメニュー">
            <h2 class="gw-footer__heading"><span class="gw-footer__heading-en">MENU</span><span class="gw-footer__heading-ja">サイトメニュー</span></h2>
            <ul>
                <?php foreach ($gw_menu as $m) : ?>
                    <li><a href="<?php echo esc_url(home_url($m[0])); ?>"><?php echo esc_html($m[1]); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <nav class="gw-footer__cats bseyifbslink" aria-label="学割カテゴリ">
            <h2 class="gw-footer__heading"><span class="gw-footer__heading-en">CATEGORY</span><span class="gw-footer__heading-ja">学割カテゴリ</span></h2>
            <ul>
                <?php foreach ($gw_cats as $c) : ?>
                    <li>
                        <a href="<?php echo esc_url(home_url('/service-type/' . $c[0] . '/')); ?>">
                            <img src="<?php echo esc_url($gw_img . $c[1] . '.png'); ?>" alt="" width="28" height="28" loading="lazy">
                            <span><?php echo esc_html($c[2]); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>

    <!-- 最下段 -->
    <div class="gw-footer__bottom">
        <div class="gw-footer__bottom-inner wrapcontent">
            <p class="gw-footer__copy">&copy; <?php echo esc_html(date_i18n('Y')); ?> 学割NAVI</p>
            <p class="gw-footer__operator">運営: <a href="<?php echo esc_url(home_url('/company/')); ?>">株式会社アトリエあふろ</a></p>
            <a href="#" class="gw-footer__top" id="gw-page-top" aria-label="ページの先頭へ戻る">
                <i class="fa fa-angle-up" aria-hidden="true"></i><span>TOP</span>
            </a>
        </div>
    </div>
</footer>


<?php wp_footer(); ?>
</body>
</html>
