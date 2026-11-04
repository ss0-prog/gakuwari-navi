<?php
/**
 * 学割カテゴリ一覧(/service/)
 *  ヘッダー(導入文・件数) / 対象から探す / ジャンルから探す(カテゴリのカード) / 地域から探す
 *  件数・サービス名の例は、登録されているデータから自動で作る
 */
get_header();

$gw_img = get_template_directory_uri() . '/images/gakuwari.site-header-nav-img/';
$gw_map = function_exists('gw_ticket_map') ? gw_ticket_map() : array();

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

$gw_total = (int) wp_count_posts('service')->publish;

// 対象(年齢)と地域のターム
$gw_ages    = get_terms(array('taxonomy' => 'age-type',    'hide_empty' => false, 'orderby' => 'count', 'order' => 'DESC'));
$gw_age_order = array('university' => 1, 'high' => 2, 'junior-high' => 3, 'other' => 4);
if (!is_wp_error($gw_ages)) {
    usort($gw_ages, function ($a, $b) use ($gw_age_order) {
        return (isset($gw_age_order[$a->slug]) ? $gw_age_order[$a->slug] : 9) - (isset($gw_age_order[$b->slug]) ? $gw_age_order[$b->slug] : 9);
    });
}
?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
    <section class="main-topcontent">
            <div class="main-topcontent-a gw-svc">

                <!-- ヘッダー -->
                <header class="gw-svc-hero gw-svc-hero--dots bseyifbslink">
                    <p class="gw-svc-hero__en">CATEGORY</p>
                    <h1 class="gw-svc-hero__title">学割カテゴリ一覧</h1>
                    <p class="gw-svc-hero__lead">映画やカラオケ、交通、サブスクなど、学生が使える学割を、ジャンルごとにまとめています。気になるカテゴリから探してみてください。対象の学年や、地域から探すこともできます。</p>
                    <ul class="gw-svc-hero__stats">
                        <li><b><?php echo esc_html($gw_total); ?></b><span>サービス</span></li>
                        <li><b><?php echo esc_html(count($gw_cats)); ?></b><span>カテゴリ</span></li>
                    </ul>
                </header>

                <!-- 対象から探す -->
                <?php if (!is_wp_error($gw_ages) && $gw_ages) : ?>
                <section class="gw-svc-block bseyifbslink">
                    <h2 class="gw-svc-heading"><span class="gw-svc-heading__en">FOR WHO</span><span class="gw-svc-heading__ja">対象から探す</span></h2>
                    <ul class="gw-svc-chips">
                        <?php foreach ($gw_ages as $age) : $link = get_term_link($age); if (is_wp_error($link)) { continue; } ?>
                            <li><a href="<?php echo esc_url($link); ?>"><span><?php echo esc_html($age->name); ?></span><small><?php echo esc_html($age->count); ?>件</small></a></li>
                        <?php endforeach; ?>
                    </ul>
                </section>
                <?php endif; ?>

                <!-- ジャンルから探す -->
                <section class="gw-svc-block">
                    <h2 class="gw-svc-heading bseyifbslink"><span class="gw-svc-heading__en">GENRE</span><span class="gw-svc-heading__ja">ジャンルから探す</span></h2>
                    <ul class="gw-svc-cards">
                        <?php foreach ($gw_cats as $c) :
                            list($slug, $icon, $label) = $c;
                            $term = get_term_by('slug', $slug, 'service-type');
                            if (!$term) { continue; }
                            $link  = get_term_link($term);
                            $count = (int) $term->count;
                            $color = isset($gw_map[$slug]) ? $gw_map[$slug][1] : array('#eef0f3', '#dde1e6', '#4b5563');

                            // サービス名の例(新しい順に最大3件)
                            $examples = array();
                            if ($count > 0) {
                                $q = new WP_Query(array(
                                    'post_type' => 'service', 'posts_per_page' => 3, 'no_found_rows' => true,
                                    'orderby' => 'date', 'order' => 'DESC',
                                    'tax_query' => array(array('taxonomy' => 'service-type', 'field' => 'term_id', 'terms' => $term->term_id)),
                                ));
                                while ($q->have_posts()) {
                                    $q->the_post();
                                    $examples[] = gw_ticket_name(get_the_ID());
                                }
                                wp_reset_postdata();
                            }
                        ?>
                        <li class="gw-svc-card bseyifbslink<?php echo $count === 0 ? ' is-empty' : ''; ?>" style="--c-tint:<?php echo esc_attr($color[0]); ?>;--c-stub:<?php echo esc_attr($color[1]); ?>;--c-accent:<?php echo esc_attr($color[2]); ?>">
                            <a href="<?php echo esc_url(is_wp_error($link) ? '#' : $link); ?>">
                                <span class="gw-svc-card__head">
                                    <img class="gw-svc-card__icon" src="<?php echo esc_url($gw_img . $icon . '.png'); ?>" alt="" width="64" height="64" loading="lazy">
                                    <span class="gw-svc-card__count"><?php echo $count > 0 ? esc_html($count) . '件' : '準備中'; ?></span>
                                </span>
                                <span class="gw-svc-card__name"><?php echo esc_html($label); ?></span>
                                <?php if ($examples) : ?>
                                    <span class="gw-svc-card__ex"><?php echo esc_html(implode('、', $examples)); ?><?php echo $count > 3 ? ' ほか' : ''; ?></span>
                                <?php else : ?>
                                    <span class="gw-svc-card__ex">掲載の準備を進めています。</span>
                                <?php endif; ?>
                                <span class="gw-svc-card__go" aria-hidden="true">一覧を見る</span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </section>

                <!-- 地域から探す -->
                <section class="gw-svc-block bseyifbslink">
                    <h2 class="gw-svc-heading"><span class="gw-svc-heading__en">AREA</span><span class="gw-svc-heading__ja">地域から探す</span></h2>
                    <?php get_template_part('section-area-map'); ?>
                </section>

            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </section>

    </div>
</main>
<?php get_footer(); ?>
