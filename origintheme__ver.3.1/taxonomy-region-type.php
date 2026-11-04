<?php
/**
 * The main template file for displaying categories (region-type taxonomy)
 *
 */
get_header(); ?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a">
                <div class="top-content">
                    <!-- タクソノミー名と表示件数 -->
                    <div class="category-container content__container">
                        <?php
                        // 現在のタクソノミー term を取得
                        $terms_region_type = get_queried_object(); // 'region-type' タクソノミーのターム
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        if ($terms_region_type) {
                            $args = array(
                                'post_type'      => 'service',  // 投稿タイプ
                                'posts_per_page' => 20,         // 表示する投稿数（20件）
                                'paged'          => $paged,     // ページネーション対応
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'region-type',  // 'region-type' タクソノミー
                                        'field'    => 'slug',
                                        'terms'    => $terms_region_type->slug, // 現在のタームのスラッグ
                                    ),
                                ),
                            );
                            $custom_query = new WP_Query($args);
                            $total_posts = $custom_query->found_posts;
                            $posts_per_page = 20; // 投稿数20件
                            $total_pages = $custom_query->max_num_pages;
                        ?>

                    <?php gw_archive_hero('AREA', single_cat_title('', false) . ' の学割一覧', (int) $total_posts, (int) $paged, (int) $total_pages); ?>

                        <?php
                            // 投稿があるか確認
                            if ($custom_query->have_posts()) :
                                echo '<div class="top-content-gef" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">';
                                while ($custom_query->have_posts()) : $custom_query->the_post();
                                    ?>
                                    
                                    <a href="<?php the_permalink(); ?>" class="content-nuiafe-ser">
                                        <div class="top-content-img">
                                            <?php gw_ticket_visual(); ?>
                                            <?php /* 【テスト前の表示】チケットを無効に戻すときは、上の行を消し、この囲みのコメント記号を外す
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php the_post_thumbnail('afullo-thumb-200', ['class' => 'hover-zoom', 'style' => 'width: 100%; height: auto; border-radius: var(--radius-md);']); ?>
                                            <?php else: ?>
                                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/example-image/no-image.jpg" alt="No Image" class="hover-zoom">
                                            <?php endif; ?>
                                            */ ?>
                                        </div>
                                        <?php /* 【テスト前の表示】チケットを無効に戻すときは、この囲みのコメント記号を外す
                                        <p class="top-content-text"><?php the_title(); ?></p>
                                        <?php
                                        $service_campany = get_post_meta(get_the_ID(), 'service_campany', true);
                                        if (!empty($service_campany)) : ?>
                                            <p class="top-content-subtext"><?php echo esc_html($service_campany); ?></p>
                                        <?php endif; ?>
                                        */ ?>

                                        <div class="top-content-tags">
                                            <div class="related-articles__meta-cat">
                                                <?php
                                                $related_cats = get_the_terms(get_the_ID(), 'service-type');
                                                if ($related_cats) :
                                                    foreach ($related_cats as $cat) :
                                                        ?>
                                                        <span class="tag"><?php echo esc_html($cat->name); ?></span>
                                                    <?php endforeach;
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                endwhile;
                                echo '</div>'; // .top-content-gef
                                wp_reset_postdata();
                            else :
                                echo '<p>該当する投稿がありません。</p>';
                            endif;
                        }
                        ?>
                    </div>
                </div>

                <?php if ( ! empty( $custom_query ) ) : ?>
                <!-- ページネーション -->
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'total' => $custom_query->max_num_pages, // 総ページ数を設定
                    ));
                    ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
