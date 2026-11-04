<?php
/**
 * お知らせの記事ページ(/news/〇〇/)
 *  パンくず / 見出し(日付・NEW・タイトル) / 本文 / 前後のお知らせ / 一覧へ戻る
 */
get_header();

while ( have_posts() ) : the_post();
    $gw_news_new = (time() - get_post_time('U', true)) < 14 * DAY_IN_SECONDS;
    $gw_prev = get_previous_post();
    $gw_next = get_next_post();
?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a gw-reco gw-reco-single gw-news-single">

                <nav class="gw-crumb" aria-label="現在位置">
                    <a href="<?php echo esc_url(home_url('/')); ?>">TOP</a><span>›</span><a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>">News&amp;Topics</a><span>›</span><em><?php the_title(); ?></em>
                </nav>

                <article class="gw-reco-article bseyifbslink">
                    <header class="gw-reco-article__head">
                        <p class="gw-reco-article__meta">
                            <time class="gw-reco-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y/m/d')); ?></time>
                            <?php if ($gw_news_new) : ?><span class="gw-news__new">NEW</span><?php endif; ?>
                        </p>
                        <h1 class="gw-reco-article__title"><?php the_title(); ?></h1>
                    </header>
                    <div class="gw-reco-article__body">
                        <?php the_content(); ?>
                    </div>
                </article>

                <?php if ($gw_prev || $gw_next) : ?>
                <nav class="gw-news-pn" aria-label="前後のお知らせ">
                    <?php if ($gw_prev) : ?>
                        <a class="gw-news-pn__prev" href="<?php echo esc_url(get_permalink($gw_prev)); ?>"><small>前のお知らせ</small><span><?php echo esc_html(get_the_title($gw_prev)); ?></span></a>
                    <?php endif; ?>
                    <?php if ($gw_next) : ?>
                        <a class="gw-news-pn__next" href="<?php echo esc_url(get_permalink($gw_next)); ?>"><small>次のお知らせ</small><span><?php echo esc_html(get_the_title($gw_next)); ?></span></a>
                    <?php endif; ?>
                </nav>
                <?php endif; ?>

                <p class="gw-reco-back"><a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>">お知らせの一覧へ戻る</a></p>

            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </section>
    </div>
</main>

<?php endwhile;

get_footer();
