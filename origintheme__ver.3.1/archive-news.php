<?php
/**
 * News&Topics 一覧(/news/)
 *  ヘッダー(導入文・件数) / お知らせの一覧(日付・タイトル・矢印。14日以内はNEW) / ページ送り
 */
get_header();

$paged      = max(1, (int) get_query_var('paged'));
$news_query = new WP_Query(array(
    'post_type'      => 'news',
    'posts_per_page' => 10,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'paged'          => $paged,
));
$gw_count = (int) $news_query->found_posts;
?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a gw-svc gw-news-page">

                <!-- ヘッダー -->
                <header class="gw-svc-hero gw-news-hero bseyifbslink">
                    <p class="gw-svc-hero__en">NEWS</p>
                    <h1 class="gw-svc-hero__title">News&amp;Topics</h1>
                    <p class="gw-svc-hero__lead">学割NAVIからのお知らせや、新しく公開した学割情報などを、新しい順にまとめています。</p>
                    <ul class="gw-svc-hero__stats">
                        <li><b><?php echo esc_html($gw_count); ?></b><span>件のお知らせ</span></li>
                    </ul>
                </header>

                <section class="newstopics__section gw-news-page__list bseyifbslink">
                    <?php if ($news_query->have_posts()) : ?>
                    <ul class="news-list">
                        <?php while ($news_query->have_posts()) : $news_query->the_post();
                            $gw_news_new = (time() - get_post_time('U', true)) < 14 * DAY_IN_SECONDS;
                        ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <time class="news-index-time" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y/m/d')); ?></time>
                                <p class="news-index-title"><?php if ($gw_news_new) : ?><span class="gw-news__new">NEW</span><?php endif; ?><?php the_title(); ?></p>
                                <i class="gw-news__arrow" aria-hidden="true"></i>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                    <?php else : ?>
                        <p class="gw-news-page__empty">現在、お知らせはありません。</p>
                    <?php endif; ?>
                </section>

                <?php if ($news_query->max_num_pages > 1) : ?>
                <nav class="pagination gw-pagination" aria-label="ページ送り">
                    <?php echo paginate_links(array(
                        'total'     => $news_query->max_num_pages,
                        'current'   => $paged,
                        'mid_size'  => 1,
                        'prev_text' => '‹',
                        'next_text' => '›',
                    )); ?>
                </nav>
                <?php endif; ?>

            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
