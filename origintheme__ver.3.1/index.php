<?php
/**
 * The main template file
 *
 */
get_header('index'); ?>

<section class="recommend-section">
    
    <div class="slide-recommend-img">
        <?php
        $args = array(
            'post_type'      => 'recommendation',
            'posts_per_page' => 6, // 最大6件取得
        );
        $recommend_query = new WP_Query($args);

        $reco_index = 0;
        if ($recommend_query->have_posts()) :
            while ($recommend_query->have_posts()) : $recommend_query->the_post();
                // 1枚目は最優先で読み込み、2枚目以降は遅延読み込み(表示は最大でも約800px幅なので768pxの画像で足りる)
                $reco_attr = array('alt' => get_the_title());
                if ($reco_index === 0) {
                    $reco_attr['loading']       = 'eager';
                    $reco_attr['fetchpriority'] = 'high';
                } else {
                    $reco_attr['loading'] = 'lazy';
                }
                $reco_index++;
        ?>
            <div class="recommend-main">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium_large', $reco_attr); ?>
                    <?php else : ?> 
                        <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari-nav/gakuwari-sample.jpg" alt="おすすめ情報画像">
                    <?php endif; ?>
                </a>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>おすすめ情報はまだありません。</p>';
        endif;
        ?>
    </div>

    <p class="reco-btn-index">
        <a href="<?php echo esc_url( home_url( '/recommendation/' ) ); ?>" class="btn btn-flat"><span>もっと見る</span></a>
    </p>
    
</section>
<section class="new-posts-section">
    <h2 class="new-posts-title bseyifbslink">NEW!  新着学割</h2>
    <div class="new-posts-list">
        <?php
        // トップページに出したサービスのID。同じサービスを、新着とカテゴリ別の一覧に重ねて出さないために記録する
        $gw_shown = array();
        $args = array(
            'post_type'      => 'service', 
            'posts_per_page' => 10, // 投稿数を設定
            'orderby'        => 'date', 
            'order'          => 'DESC',
        );
        $new_posts_query = new WP_Query($args);        
            if ($new_posts_query->have_posts()) :
        ?>
            <div class="new-posts-slider">
                <?php
                    while ($new_posts_query->have_posts()) : $new_posts_query->the_post();
                        $gw_shown[] = get_the_ID();
                ?>
                    <article class="new-post-item">
                        <a href="<?php the_permalink(); ?>" class="new-post-link">
                            <div class="new-post-thumbnail">
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
                            <div class="new-post-content">
                                <h3 class="new-post-title"><?php the_title(); ?></h3>
                                <p class="top-content-subtext"><?php echo get_post_meta(get_the_ID(), 'service_campany', true); ?></p>
                            </div>
                            */ ?>
                        </a>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                ?>
            </div>
        <?php else : ?>
            <p>新しい投稿はありません。</p>
        <?php endif; ?>
    </div>
    <div class="new-posts-dots"></div>
</section>



<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
 

        <section class="main-topcontent seunfkse">
        

            <div class="main-topcontent-a">
                <?php
                /*
                 * カテゴリ別の一覧(トップ)
                 *  ・その見出しのカテゴリが「主カテゴリ」(チケットのタグに出るカテゴリ)のサービスだけを出す
                 *    → 複数カテゴリのサービスが、別の見出しの下に出て、タグと見出しが食い違うのを防ぐ
                 *  ・新着や、前の見出しに出したサービスは出さない(次の候補で埋める)
                 *    → トップページ全体で、同じサービスが重ならないようにする
                 */
                $gw_sections = array(
                    array('transportation', '公共交通機関'),
                    array('music',          '動画、音楽配信'),
                    array('movie',          '映画館'),
                    array('park',           '遊園地・動物園・植物園など'),
                    array('food',           '飲食店'),
                    array('tour',           'ツアー'),
                    array('karaoke',        'カラオケ'),
                );
                foreach ($gw_sections as $gw_i => $gw_sec) :
                    list($gw_slug, $gw_label) = $gw_sec;
                ?>
                <!-- <?php echo esc_html($gw_label); ?> -->
                <div class="top-content hover-color">
                    <div class="top-topic bseyifbslink">
                        <p class="index-category"><a href="<?php echo esc_url( home_url( '/service-type/' . $gw_slug . '/' ) ); ?>" class="nskxiurs"><?php echo esc_html($gw_label); ?></a></p>
                        <p class="index-category top-topic-yajirushi">
                            <a href="<?php echo esc_url( home_url( '/service-type/' . $gw_slug . '/' ) ); ?>">全て表示</a>
                        </p>
                    </div>

                    <div class="top-content-gef">
                        <?php
                        $query = new WP_Query(array(
                            'post_type'      => 'service',
                            'posts_per_page' => -1, // 主カテゴリで絞り込むため、いったん全件を見て、先頭の4件を取る
                            'no_found_rows'  => true,
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'service-type',
                                    'field'    => 'slug',
                                    'terms'    => $gw_slug,
                                ),
                            ),
                        ));

                        $gw_count = 0;
                        if ($query->have_posts()) :
                            while ($query->have_posts() && $gw_count < 4) : $query->the_post();
                                if (in_array(get_the_ID(), $gw_shown, true) || gw_primary_service_type(get_the_ID()) !== $gw_slug) {
                                    continue;
                                }
                                $gw_shown[] = get_the_ID();
                                $gw_count++; ?>
                               <a href="<?php the_permalink(); ?>" class="content-nuiafe bseyifbslink">
                                    <div class="top-content-img">
                                        <?php gw_ticket_visual(); ?>
                                    </div>
                                    <?php if ($gw_i === 0) : /* 最初の見出しだけにあった「お気に入り」の部品(従来のまま) */ ?>
                                    <div class="favorite item-list-favorite" data-post-id="<?php the_ID(); ?>">
                                        <a href="#" class="favorite-icon favorite-off"></a>
                                        <a href="#" class="favorite-icon favorite-on hide"></a>
                                    </div>
                                    <?php endif; ?>
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

                            <?php endwhile;
                        endif;
                        if ($gw_count === 0) {
                            echo '<p>まだ記事がありません</p>';
                        }
                        wp_reset_postdata(); // 投稿データのリセット
                        ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <p class="btn-index-ser">
                    <a href="<?php echo esc_url( home_url( '/service/' ) ); ?>" class="btn btn-flat"><span>もっと見る</span></a>
                </p>
                <!-- 地域から探す(日本地図)。News&Topics の上 -->
                <section class="newstopics__section gw-top-area bseyifbslink">
                    <div class="gw-news__head">
                        <h2 class="newstopics"><span>地域から探す</span></h2>
                    </div>
                    <?php get_template_part('section-area-map'); ?>
                </section>
                <section class="newstopics__section bseyifbslink">
                    <div class="gw-news__head">
                        <h2 class="newstopics"><a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">News&Topics</a></h2>
                        <a class="gw-news__all" href="<?php echo esc_url( home_url( '/news/' ) ); ?>">一覧を見る</a>
                    </div>
                    <ul class="newstopicscontents newstopicscontents-index">
                    <?php
                    $args = array(
                        'post_type'      => 'news',  
                        'posts_per_page' => 5       
                    );
                    $the_query = new WP_Query($args);
                    ?>

                    <?php if ($the_query->have_posts()): ?>
                        <ul class="news-list">
                        <?php while ($the_query->have_posts()): $the_query->the_post();
                            // 公開から14日以内のお知らせには「NEW」を付ける
                            $gw_news_new = (time() - get_post_time('U', true)) < 14 * DAY_IN_SECONDS;
                        ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"> 
                                    <time class="news-index-time" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php the_time('Y/m/d'); ?></time>
                                    <p class="news-index-title"><?php if ($gw_news_new) : ?><span class="gw-news__new">NEW</span><?php endif; ?><?php the_title(); ?></p>
                                    <i class="gw-news__arrow" aria-hidden="true"></i>
                                </a>
                            </li>
                        <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                    </ul>
            
                </section>
            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
            
        </section>
        
    </div>
    <!-- topcontent__section / END -->
</main>
<!-- topcontent / END -->





<?php get_footer(); ?>