<?php
/**
 * The main template file
 */
get_header(); ?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a">
                <section class="newstopics__section-ac">
                    <h2 class="newstopics-ac">おすすめ情報</h2>
                    <ul class="reco-ac-main">
                        <?php
                        // カスタム投稿タイプ 'recommendation' を取得
                        $args = array(
                            'post_type'      => 'recommendation', // 投稿タイプを変更
                            'posts_per_page' => 10, 
                            'orderby'        => 'date',
                            'order'          => 'DESC'
                        );
                        $the_query = new WP_Query($args);
                        ?>

                        <?php if ($the_query->have_posts()) : ?>
                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="reco-ac-text">
                                            <div class="reco-nsbfe">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="reco-hover-zoom">
                                                <?php else : ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/images/example-image/no-image.jpg" alt="No Image" class="reco-hover-zoom">
                                                <?php endif; ?>
                                            </div>
                                            <div class="reco-ac-font">      
                                                <p class="reco-ac-title"><?php the_title(); ?></p>
                                                <p><?php echo get_post_meta(get_the_ID(), 'sub_title', true); ?></p>
                                                <p class="reco-ac-date"><?php the_time('Y/m/d'); ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php else : ?>
                            <p>おすすめ情報がありません。</p>
                        <?php endif; ?>
                    </ul>
                </section>
            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>   
        </section> 
    </div>
</main>
<?php get_footer(); ?>
