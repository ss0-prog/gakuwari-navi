<?php
/**
 * The main template file
 */
get_header();

while ( have_posts() ) : the_post();
?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a">
                <div class="single-text">
                    <div class="single_title">
                        <h1><?php the_title(); ?></h1>
                    </div>

                    <section>
                        <!-- メイン画像 -->
                        <div>
                            <?php
                            $image_id = SCF::get('image_url');
                            if ($image_id) {
                                $image_src = wp_get_attachment_image_src($image_id, 'full');
                                if ($image_src) {
                                    echo '<img src="' . esc_url($image_src[0]) . '" alt="画像の説明">';
                                }
                            }
                            ?>
                        </div>

                        <!-- 投稿日 -->
                        <p class="single-days">
                            <?php
                            $recommendation_date = SCF::get('recommendation_date'); 
                            echo esc_html($recommendation_date);
                            ?>
                        </p>

                        <!-- サブタイトル -->
                        <p class="single-subtitle">
                            <?php
                            $sub_title = SCF::get('sub_title');
                            echo esc_html($sub_title);
                            ?>
                        </p>

                        <!-- 本文 -->
                        <div class="singletext">
                            <?php the_content(); ?>
                        </div>

                        <!-- おすすめ情報ブロック -->
                        <?php
                        $rec_title = SCF::get('recommendation_title');
                        $rec_image_id = SCF::get('recommendation_image');
                        $rec_text = SCF::get('recommendation_text');
                        $rec_url = SCF::get('recommend_url');

                        if ($rec_title || $rec_image_id || $rec_text|| $rec_url) :
                        ?>
                        <div class="recommendation-block">
                            <?php if ($rec_title): ?>
                                <h2 class="recommendation-title"><?php echo esc_html($rec_title); ?></h2>
                            <?php endif; ?>

                            <?php if ($rec_image_id):
                                $rec_image_src = wp_get_attachment_image_src($rec_image_id, 'full');
                                if ($rec_image_src):
                            ?>
                                <img src="<?php echo esc_url($rec_image_src[0]); ?>" class="recommendation-image" alt="おすすめ画像">
                            <?php endif; endif; ?>

                            <?php if ($rec_text): ?>
                                <div class="recommendation-text">
                                    <?php echo wpautop(wp_kses_post($rec_text)); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($rec_url): ?>
                                <div class="recommendation-link">
                                    <a href="<?php echo esc_url($rec_url); ?>" class="recommendation-button" target="_blank" rel="noopener noreferrer">
                                        詳細を見る
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </section>
                </div>


            </div>

            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </section>
    </div>    
</main>

<?php endwhile;

get_footer();
?>
