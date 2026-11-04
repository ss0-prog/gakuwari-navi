<?php
/**
 * おすすめ情報の記事ページ(/recommendation/〇〇/)
 *  見出し(タグ・日付・タイトル) / 画像 / 本文 / 学割ページへの案内 / ほかのおすすめ
 */
get_header();

while ( have_posts() ) : the_post();
    $post_id = get_the_ID();

    $rec_title    = SCF::get('recommendation_title');
    $rec_image_id = SCF::get('recommendation_image');
    $rec_text     = SCF::get('recommendation_text');
    $rec_url      = SCF::get('recommend_url');
    $sub_title    = SCF::get('sub_title');
    $main_image   = SCF::get('image_url');

    // 日付(「2025/7/1」を「2025/07/01」にそろえる。読めないときは公開日)
    $date_raw = SCF::get('recommendation_date');
    $ts       = $date_raw ? strtotime(str_replace('/', '-', $date_raw)) : false;
    $date     = $ts ? date_i18n('Y/m/d', $ts) : get_the_time('Y/m/d');

    // 画像は、先頭の画像(メイン画像があればそちら)を1枚だけ大きく出す
    $img_id  = $main_image ? $main_image : $rec_image_id;
    $img_src = $img_id ? wp_get_attachment_image_src($img_id, 'large') : false;
    $has_content = trim(wp_strip_all_tags(get_the_content())) !== '';
    $heading = $rec_title ? $rec_title : get_the_title();
?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a gw-reco gw-reco-single">

                <nav class="gw-crumb" aria-label="現在位置">
                    <a href="<?php echo esc_url(home_url('/')); ?>">TOP</a><span>›</span><a href="<?php echo esc_url(get_post_type_archive_link('recommendation')); ?>">おすすめ情報</a><span>›</span><em><?php the_title(); ?></em>
                </nav>

                <article class="gw-reco-article bseyifbslink">
                    <header class="gw-reco-article__head">
                        <p class="gw-reco-article__meta">
                            <time class="gw-reco-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html($date); ?></time>
                            <span class="gw-reco-card__tag"><?php the_title(); ?></span>
                        </p>
                        <h1 class="gw-reco-article__title"><?php echo esc_html($heading); ?></h1>
                        <?php if ($sub_title) : ?><p class="gw-reco-article__sub"><?php echo esc_html($sub_title); ?></p><?php endif; ?>
                    </header>

                    <?php if ($img_src) : ?>
                    <figure class="gw-reco-article__img">
                        <img src="<?php echo esc_url($img_src[0]); ?>" alt="<?php echo esc_attr($heading); ?>" width="<?php echo esc_attr($img_src[1]); ?>" height="<?php echo esc_attr($img_src[2]); ?>">
                    </figure>
                    <?php endif; ?>

                    <div class="gw-reco-article__body">
                        <?php if ($has_content) : the_content(); endif; ?>
                        <?php if ($rec_text) : echo wpautop(wp_kses_post($rec_text)); endif; ?>
                    </div>

                    <?php if ($rec_url) : ?>
                    <aside class="gw-reco-article__cta">
                        <p class="gw-reco-article__cta-text"><b><?php the_title(); ?></b>の学割の条件や使い方を、まとめたページです。</p>
                        <a class="gw-reco-article__cta-btn" href="<?php echo esc_url($rec_url); ?>" target="_blank" rel="noopener noreferrer">学割の詳細を見る</a>
                    </aside>
                    <?php endif; ?>
                </article>

                <?php
                $gw_more = new WP_Query(array(
                    'post_type' => 'recommendation', 'posts_per_page' => 3, 'post__not_in' => array($post_id),
                    'orderby' => 'date', 'order' => 'DESC', 'no_found_rows' => true,
                ));
                if ($gw_more->have_posts()) : ?>
                <section class="gw-svc-block gw-reco-more">
                    <h2 class="gw-svc-heading bseyifbslink"><span class="gw-svc-heading__en">MORE</span><span class="gw-svc-heading__ja">ほかのおすすめ情報</span></h2>
                    <ul class="gw-reco-list">
                        <?php while ($gw_more->have_posts()) : $gw_more->the_post();
                            $h = get_post_meta(get_the_ID(), 'recommendation_title', true);
                            if ($h === '' || $h === false) { $h = get_the_title(); }
                        ?>
                        <li class="gw-reco-card bseyifbslink">
                            <a href="<?php the_permalink(); ?>">
                                <span class="gw-reco-card__img">
                                    <?php if (has_post_thumbnail()) { echo get_the_post_thumbnail(get_the_ID(), 'medium_large', array('alt' => $h, 'loading' => 'lazy')); } ?>
                                </span>
                                <span class="gw-reco-card__body">
                                    <span class="gw-reco-card__meta"><span class="gw-reco-card__tag"><?php the_title(); ?></span></span>
                                    <span class="gw-reco-card__title"><?php echo esc_html($h); ?></span>
                                    <span class="gw-reco-card__go" aria-hidden="true">記事を読む</span>
                                </span>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </section>
                <?php endif; ?>

                <p class="gw-reco-back"><a href="<?php echo esc_url(get_post_type_archive_link('recommendation')); ?>">おすすめ情報の一覧へ戻る</a></p>

            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </section>
    </div>
</main>

<?php endwhile;

get_footer();
