<?php get_header(); ?>

<section>
    <main id="topcontent" class="topcontent wrapcontent">
        <div class="wrapcontentcenter">
            <section class="main-topcontent">
                <div class="main-topcontent-a">
                    <h2 class="search-admin"> <?php echo get_search_query(); ?> の学割一覧</h2>
                    <div class="top-content-gef" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">
                        <?php if(have_posts()): ?>
                            <?php while(have_posts()): the_post(); ?>
                                <a href="<?php the_permalink(); ?>" class="content-nuiafe-ser search-disp bseyifbslink">
                                    <div class="top-content-img">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('afullo-thumb-200', ['class' => 'hover-zoom', 'style' => 'width: 100%; height: auto; border-radius: var(--radius-md);']); ?>
                                        <?php else: ?>
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
                                                <?php endforeach;
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <h3>検索キーワードに該当する記事がありませんでした</h3>
                        <?php endif; ?>
                    </div>
                    <div class="pagination">
                        <?php
                        // ページネーションリンクを表示
                        echo paginate_links(array(
                            'total' => $wp_query->max_num_pages, // 総ページ数を設定
                            'current' => max(1, get_query_var('paged')), // 現在のページ番号を設定
                            'mid_size' => 2, // 現在のページの前後2ページを表示
                            'prev_text' => '« 前', // 前のページリンクテキスト
                            'next_text' => '次 »'  // 次のページリンクテキスト
                        ));
                        ?>
                    </div>
                </div>
                <div class="main-topcontent-b">
                    <?php get_sidebar('sidebar'); ?>
                </div>
            </section>
        </div>
    </main>
</section>

<?php get_footer(); ?>
