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
                    <div class="top-content-gef">





                    <!-- 以下より [php構文] [if文] [繰り返し処理] 開始 -->
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>

                        <!-- 以下 投稿がある場合に表示したい項目 -->
                        <?php the_title(); ?>
                        <!-- 投稿がある場合に表示したい項目 以上 -->

                        <!-- 以下 [繰り返し処理]ストップ -->
                        <?php endwhile; ?>

                        <?php else : ?>
                            該当の商品はございません

                    <!-- 以下 [if文]ストップ -->
                    <?php endif; ?>
                    
                    <!-- 以下 [php構文]ストップ -->
                    <?php wp_reset_query(); ?>  
                        







                    </div>
                </div>
            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
