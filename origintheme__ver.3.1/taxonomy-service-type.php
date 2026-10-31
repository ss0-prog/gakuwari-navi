<?php
/**
 * The main template file for displaying categories
 *
 */
get_header(); ?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a">
                <div class="top-content">
                    <?php
                    // 現在のタクソノミー term を取得
                    $terms_service_type = get_queried_object(); 
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    if ($terms_service_type) {
                        $args = array(
                            'post_type'      => 'service',
                            'posts_per_page' => 20,
                            'paged'          => $paged,
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'service-type',
                                    'field'    => 'slug',
                                    'terms'    => $terms_service_type->slug,
                                ),
                            ),
                        );
                        $custom_query = new WP_Query($args);
                        $total_posts = $custom_query->found_posts;
                        $posts_per_page = 20; // 投稿数20件
                        $total_pages = $custom_query->max_num_pages;
                    ?>

                    <!-- 件数付き見出し -->
                    <div class="category-header" style="display: flex; align-items: center; gap: 1em; margin-bottom: 1em;">
                        <h1><?php echo esc_html(single_cat_title('', false)); ?> の学割一覧</h1>
                        <span class="post-count" style="font-size: 14px; color: #666;">
                            全<?php echo $total_posts; ?>件  <?php echo $paged; ?> / <?php echo $total_pages; ?> ページ表示中
                        </span>
                    </div>

                    <div class="top-content-gef-ser">
                        <?php
                        if ($custom_query->have_posts()) :
                            while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                                <a href="<?php the_permalink(); ?>" class="content-nuiafe">
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
                            wp_reset_postdata();
                        else :
                            echo '<p>該当する投稿がありません。</p>';
                        endif;
                        ?>
                    </div>

                    <!-- ページネーション -->
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'total' => $custom_query->max_num_pages,
                        ));
                        ?>
                    </div>

                    <?php } // if ($terms_service_type) ?>
                </div>
            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
