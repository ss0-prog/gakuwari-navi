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

        if ($recommend_query->have_posts()) :
            while ($recommend_query->have_posts()) : $recommend_query->the_post();
        ?>
            <div class="recommend-main">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full', array('alt' => get_the_title())); ?>
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
        <a href="http://gakuwari.site/recommendation/" class="btn btn-flat"><span>もっと見る</span></a>
    </p>
    
</section>
<section class="new-posts-section">
    <h2 class="new-posts-title">NEW!  新着学割</h2>
    <div class="new-posts-list">
        <?php
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
                ?>
                    <article class="new-post-item">
                        <a href="<?php the_permalink(); ?>" class="new-post-link">
                            <div class="new-post-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="new-badge">NEW!</div>
                                    <?php the_post_thumbnail('medium', ['class' => 'new-post-img']); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/example-image/no-image.jpg" class="new-post-img" alt="No Image">
                                <?php endif; ?>
                            </div>
                            <div class="new-post-content">
                                <h3 class="new-post-title"><?php the_title(); ?></h3>
                                <p class="top-content-subtext"><?php echo get_post_meta(get_the_ID(), 'service_campany', true); ?></p>
                            </div>
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
                <!-- 公共交通機関 -->
                <div class="top-content hover-color">
                    <div class="top-topic bseyifbslink">
                        <p class="index-category"><a href="http://gakuwari.site/service-type/transportation/" class="nskxiurs">公共交通機関</a></p>
                        <p class="index-category top-topic-yajirushi">
                            <a href="http://gakuwari.site/service-type/transportation/">全て表示</a>
                        </p>
                    </div>

                    <div class="top-content-gef">
                        <?php
                        // WP_Queryを使用してカスタム投稿を取得
                        $args = array(
                            'post_type' => 'service',
                            'posts_per_page' => 4, // 表示する投稿数
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'service-type', // タクソノミー
                                    'field' => 'slug',
                                    'terms' => 'transportation', // 表示するターム
                                ),
                            ),
                        );
                        $query = new WP_Query($args);

                        // 投稿があればループ開始
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post(); ?>
                               <a href="<?php the_permalink(); ?>" class="content-nuiafe bseyifbslink">
                                    <div class="top-content-img">
                                        <!-- 基本的な画像表示 -->
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('class' => 'hover-zoom')); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/example-image/no-image.jpg" alt="No Image" class="hover-zoom">
                                        <?php endif; ?>
                                    </div>
                                    
                                    <p class="top-content-text"><?php the_title(); ?></p>
                                    <p class="top-content-subtext"><?php echo get_post_meta(get_the_ID(), 'service_campany', true); ?></p>
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

                            <?php endwhile;
                        else :
                            echo '<p>まだ記事がありません</p>';
                        endif;
                        wp_reset_postdata(); // 投稿データのリセット
                        ?>
                    </div>
                </div>
                <!-- 動画、音楽配信 -->
                <div class="top-content hover-color">
                    <div class="top-topic bseyifbslink">
                        <p class="index-category"><a href="http://gakuwari.site/service-type/music/" class="nskxiurs">動画、音楽配信</a></p>
                        <p class="index-category top-topic-yajirushi">
                            <a href="http://gakuwari.site/service-type/music/">全て表示</a>
                        </p>
                    </div>

                    <div class="top-content-gef">
                        <?php
                        // WP_Queryを使用してカスタム投稿を取得
                        $args = array(
                            'post_type' => 'service',
                            'posts_per_page' => 4, // 表示する投稿数
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'service-type', // タクソノミー
                                    'field' => 'slug',
                                    'terms' => 'music', // 表示するターム
                                ),
                            ),
                        );
                        $query = new WP_Query($args);

                        // 投稿があればループ開始
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post(); ?>
                               <a href="<?php the_permalink(); ?>" class="content-nuiafe bseyifbslink">
                                    <div class="top-content-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('class' => 'hover-zoom')); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/example-image/no-image.jpg" alt="No Image" class="hover-zoom">
                                        <?php endif; ?>
                                    </div>
                                    
                                    <p class="top-content-text"><?php the_title(); ?></p>
                                    <p class="top-content-subtext"><?php echo get_post_meta(get_the_ID(), 'service_campany', true); ?></p>
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
                        else :
                            echo '<p>まだ記事がありません</p>';
                        endif;
                        wp_reset_postdata(); // 投稿データのリセット
                        ?>
                    </div>
                </div>
                <!-- 映画館 -->
                <div class="top-content hover-color">
                    <div class="top-topic bseyifbslink">
                        <p class="index-category"><a href="http://gakuwari.site/service-type/movie/" class="nskxiurs">映画館</a></p>
                        <p class="index-category top-topic-yajirushi">
                            <a href="http://gakuwari.site/service-type/movie/">全て表示</a>
                        </p>
                    </div>

                    <div class="top-content-gef">
                        <?php
                        // WP_Queryを使用してカスタム投稿を取得
                        $args = array(
                            'post_type' => 'service',
                            'posts_per_page' => 4, // 表示する投稿数
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'service-type', // タクソノミー
                                    'field' => 'slug',
                                    'terms' => 'movie', // 表示するターム
                                ),
                            ),
                        );
                        $query = new WP_Query($args);

                        // 投稿があればループ開始
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post(); ?>
                               <a href="<?php the_permalink(); ?>" class="content-nuiafe bseyifbslink">
                                    <div class="top-content-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('class' => 'hover-zoom')); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/example-image/no-image.jpg" alt="No Image" class="hover-zoom">
                                        <?php endif; ?>
                                    </div>
                                    
                                    <p class="top-content-text"><?php the_title(); ?></p>
                                    <p class="top-content-subtext"><?php echo get_post_meta(get_the_ID(), 'service_campany', true); ?></p>
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
                        else :
                            echo '<p>まだ記事がありません</p>';
                        endif;
                        wp_reset_postdata(); // 投稿データのリセット
                        ?>
                    </div>
                </div>
                <!-- 遊園地・動物園など -->
                <div class="top-content hover-color">
                    <div class="top-topic bseyifbslink">
                        <p class="index-category"><a href="http://gakuwari.site/service-type/park/" class="nskxiurs">遊園地・動物園・植物園など</a></p>
                        <p class="index-category top-topic-yajirushi">
                            <a href="http://gakuwari.site/service-type/park/">全て表示</a>
                        </p>
                    </div>

                    <div class="top-content-gef">
                        <?php
                        // WP_Queryを使用してカスタム投稿を取得
                        $args = array(
                            'post_type' => 'service',
                            'posts_per_page' => 4, // 表示する投稿数
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'service-type', // タクソノミー
                                    'field' => 'slug',
                                    'terms' => 'park', // 表示するターム
                                ),
                            ),
                        );
                        $query = new WP_Query($args);

                        // 投稿があればループ開始
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post(); ?>
                               <a href="<?php the_permalink(); ?>" class="content-nuiafe bseyifbslink">
                                    <div class="top-content-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('class' => 'hover-zoom')); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/example-image/no-image.jpg" alt="No Image" class="hover-zoom">
                                        <?php endif; ?>
                                    </div>
                                    
                                    <p class="top-content-text"><?php the_title(); ?></p>
                                    <p class="top-content-subtext"><?php echo get_post_meta(get_the_ID(), 'service_campany', true); ?></p>
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
                        else :
                            echo '<p>まだ記事がありません</p>';
                        endif;
                        wp_reset_postdata(); // 投稿データのリセット
                        ?>
                    </div>
                </div>
                <!-- 飲食店 -->
                <div class="top-content hover-color">
                    <div class="top-topic bseyifbslink">
                        <p class="index-category"><a href="http://gakuwari.site/service-type/food/" class="nskxiurs">飲食店</a></p>
                        <p class="index-category top-topic-yajirushi">
                            <a href="http://gakuwari.site/service-type/food/">全て表示</a>
                        </p>
                    </div>

                    <div class="top-content-gef">
                        <?php
                        // WP_Queryを使用してカスタム投稿を取得
                        $args = array(
                            'post_type' => 'service',
                            'posts_per_page' => 4, // 表示する投稿数
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'service-type', // タクソノミー
                                    'field' => 'slug',
                                    'terms' => 'food', // 表示するターム
                                ),
                            ),
                        );
                        $query = new WP_Query($args);

                        // 投稿があればループ開始
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post(); ?>
                               <a href="<?php the_permalink(); ?>" class="content-nuiafe bseyifbslink">
                                    <div class="top-content-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('class' => 'hover-zoom')); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/example-image/no-image.jpg" alt="No Image" class="hover-zoom">
                                        <?php endif; ?>
                                    </div>
                                    
                                    <p class="top-content-text"><?php the_title(); ?></p>
                                    <p class="top-content-subtext"><?php echo get_post_meta(get_the_ID(), 'service_campany', true); ?></p>
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
                        else :
                            echo '<p>まだ記事がありません</p>';
                        endif;
                        wp_reset_postdata(); // 投稿データのリセット
                        ?>
                    </div>
                </div>
                <!--　ツアー -->
                <div class="top-content hover-color">
                    <div class="top-topic bseyifbslink">
                        <p class="index-category"><a href="http://gakuwari.site/service-type/tour/" class="nskxiurs">ツアー</a></p>
                        <p class="index-category top-topic-yajirushi">
                            <a href="http://gakuwari.site/service-type/tour/">全て表示</a>
                        </p>
                    </div>

                    <div class="top-content-gef">
                        <?php
                        // WP_Queryを使用してカスタム投稿を取得
                        $args = array(
                            'post_type' => 'service',
                            'posts_per_page' => 4, // 表示する投稿数
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'service-type', // タクソノミー
                                    'field' => 'slug',
                                    'terms' => 'tour', // 表示するターム
                                ),
                            ),
                        );
                        $query = new WP_Query($args);

                        // 投稿があればループ開始
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post(); ?>
                               <a href="<?php the_permalink(); ?>" class="content-nuiafe bseyifbslink">
                                    <div class="top-content-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('class' => 'hover-zoom')); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/example-image/no-image.jpg" alt="No Image" class="hover-zoom">
                                        <?php endif; ?>
                                    </div>
                                    
                                    <p class="top-content-text"><?php the_title(); ?></p>
                                    <?php
                                    $service_campany = get_post_meta(get_the_ID(), 'service_campany', true);
                                    if (!empty($service_campany)) : ?>
                                        <p class="top-content-subtext"><?php echo esc_html($service_campany); ?></p>
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
                        else :
                            echo '<p>まだ記事がありません</p>';
                        endif;
                        wp_reset_postdata(); // 投稿データのリセット
                        ?>
                    </div>
                </div>
                <!-- カラオケ -->
                <div class="top-content hover-color">
                    <div class="top-topic bseyifbslink">
                        <p class="index-category"><a href="http://gakuwari.site/service-type/karaoke/" class="nskxiurs">カラオケ</a></p>
                        <p class="index-category top-topic-yajirushi">
                            <a href="http://gakuwari.site/service-type/karaoke/">全て表示</a>
                        </p>
                    </div>

                    <div class="top-content-gef">
                        <?php
                        // WP_Queryを使用してカスタム投稿を取得
                        $args = array(
                            'post_type' => 'service',
                            'posts_per_page' => 4, // 表示する投稿数
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'service-type', // タクソノミー
                                    'field' => 'slug',
                                    'terms' => 'karaoke', // 表示するターム
                                ),
                            ),
                        );
                        $query = new WP_Query($args);

                        // 投稿があればループ開始
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post(); ?>
                               <a href="<?php the_permalink(); ?>" class="content-nuiafe bseyifbslink">
                                    <div class="top-content-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('class' => 'hover-zoom')); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/example-image/no-image.jpg" alt="No Image" class="hover-zoom">
                                        <?php endif; ?>
                                    </div>
                                    
                                    <p class="top-content-text"><?php the_title(); ?></p>
                                    <p class="top-content-subtext"><?php echo get_post_meta(get_the_ID(), 'service_campany', true); ?></p>
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
                        else :
                            echo '<p>まだ記事がありません</p>';
                        endif;
                        wp_reset_postdata(); // 投稿データのリセット
                        ?>
                    </div>
                </div>
                <p class="btn-index-ser">
                    <a href="http://gakuwari.site/service/" class="btn btn-flat"><span>もっと見る</span></a>
                </p>
                <section class="newstopics__section">
                    <h2 class="newstopics"><a href="http://gakuwari.site/news/">News&Topics</a></h2>
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
                        <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"> 
                                    <p class="news-index-time"><?php the_time('Y/m/d'); ?></p>
                                    <p class="news-index-title"><?php the_title(); ?></p>
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