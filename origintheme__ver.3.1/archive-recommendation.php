<?php
/**
 * おすすめ情報(/recommendation/)
 *  ヘッダー(導入文・件数) / 最新の1件を大きく + 残りをカードで並べる
 *  見出し・本文の書き出し・日付は、記事に登録されているデータから作る
 */
get_header();

$gw_query = new WP_Query(array(
    'post_type'      => 'recommendation',
    'posts_per_page' => 10,
    'orderby'        => 'date',
    'order'          => 'DESC',
));
$gw_count = (int) $gw_query->found_posts;
?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a gw-reco">

                <!-- ヘッダー -->
                <header class="gw-svc-hero gw-reco-hero bseyifbslink">
                    <p class="gw-svc-hero__en">PICK UP</p>
                    <h1 class="gw-svc-hero__title">おすすめ情報</h1>
                    <p class="gw-svc-hero__lead">学生におすすめの学割サービスを、ピックアップして紹介します。気になるものは、記事の中から、各サービスの学割情報ページへ進めます。</p>
                    <ul class="gw-svc-hero__stats">
                        <li><b><?php echo esc_html($gw_count); ?></b><span>件の紹介</span></li>
                    </ul>
                </header>

                <?php if ($gw_query->have_posts()) : ?>
                <ul class="gw-reco-list">
                    <?php $gw_i = 0; while ($gw_query->have_posts()) : $gw_query->the_post();
                        $post_id = get_the_ID();

                        // 見出し(登録がなければ記事のタイトル)
                        $headline = get_post_meta($post_id, 'recommendation_title', true);
                        if ($headline === '' || $headline === false) {
                            $headline = get_the_title();
                        }

                        // 日付(「2025/7/1」のような登録を「2025/07/01」にそろえる。読めないときは公開日)
                        $date_raw = get_post_meta($post_id, 'recommendation_date', true);
                        $ts       = $date_raw ? strtotime(str_replace('/', '-', $date_raw)) : false;
                        $date     = $ts ? date_i18n('Y/m/d', $ts) : get_the_time('Y/m/d');

                        // 本文の書き出し
                        $text = get_post_meta($post_id, 'recommendation_text', true);
                        $text = trim(preg_replace('/\s+/u', ' ', wp_strip_all_tags((string) $text)));
                        $excerpt = $text !== '' ? mb_strimwidth($text, 0, 190, '…', 'UTF-8') : '';

                        $is_featured = ($gw_i === 0);
                        $gw_i++;
                        // 公開から14日以内のものだけに「NEW」を付ける(News&Topics と同じ基準)
                        $is_new = (time() - get_post_time('U', true)) < 14 * DAY_IN_SECONDS;
                    ?>
                    <li class="gw-reco-card bseyifbslink<?php echo $is_featured ? ' is-featured' : ''; ?>">
                        <a href="<?php the_permalink(); ?>">
                            <span class="gw-reco-card__img">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php echo get_the_post_thumbnail($post_id, 'medium_large', array('alt' => $headline, 'loading' => $is_featured ? 'eager' : 'lazy')); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/example-image/no-image.jpg'); ?>" alt="" loading="lazy">
                                <?php endif; ?>
                                <?php if ($is_new) : ?><span class="gw-reco-card__badge">NEW</span><?php endif; ?>
                            </span>
                            <span class="gw-reco-card__body">
                                <span class="gw-reco-card__meta">
                                    <time class="gw-reco-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html($date); ?></time>
                                    <span class="gw-reco-card__tag"><?php the_title(); ?></span>
                                </span>
                                <span class="gw-reco-card__title"><?php echo esc_html($headline); ?></span>
                                <?php if ($excerpt !== '') : ?>
                                    <span class="gw-reco-card__ex"><?php echo esc_html($excerpt); ?></span>
                                <?php endif; ?>
                                <span class="gw-reco-card__go" aria-hidden="true">記事を読む</span>
                            </span>
                        </a>
                    </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
                <?php else : ?>
                    <p>おすすめ情報がありません。</p>
                <?php endif; ?>

            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>
