<?php
/**
 * The main template file
 *
 */
get_header();?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a">
                <section  class="newstopics__section-ac">
                    <h2 class="newstopics-ac">News&Topics</h2>
                    <div class="newstopicscontents-ac-nw">
                        <?php
                        // 現在のページ番号を取得
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        // 最新のニュース投稿を取得
                        $args = array(
                            'post_type'      => 'news', // カスタム投稿タイプ「news」
                            'posts_per_page' => 10,     
                            'orderby'        => 'date', 
                            'order'          => 'DESC',
                            'paged'          => $paged, // ページネーション対応
                        );
                        $news_query = new WP_Query($args);

                        if ($news_query->have_posts()) :
                            while ($news_query->have_posts()) : $news_query->the_post();
                            ?>
                            <a href="<?php the_permalink(); ?>" class="news-item">
                                <li>
                                    <p class="news-arc-days"><?php echo get_the_date('Y/m/d'); ?></p>
                                    <p class="newscontent"><?php the_title(); ?></p>
                                </li>
                            </a>
                            <?php 
                            endwhile; 
                            wp_reset_postdata();
                        else :
                            echo '<p>現在、ニュースはありません。</p>';
                        endif;
                        ?>
                    </div>

                    <!-- ページネーションの追加 -->
                    <div class="pagination">
                        <?php
                        // ページネーションリンクを表示
                        echo paginate_links(array(
                            'total' => $news_query->max_num_pages, // 総ページ数を設定
                        ));
                        ?>
                    </div>

                </section>
            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </section>
    </div>
    <!-- topcontent__section / END -->
</main>

<?php get_footer(); ?>
