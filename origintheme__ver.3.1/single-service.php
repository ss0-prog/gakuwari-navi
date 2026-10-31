<?php get_header(); 
while ( have_posts() ) : the_post();?>
<?php
  echo SCF::get('scf_field');
?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a">
                <section class="service-topcontent">
                    <div class="service-sin-main">
                        
                        <?php
                                $service_name = SCF::get('service_name', get_the_ID());
                                $service_picture = SCF::get('service_picture', get_the_ID());
                                $service_infotext = SCF::get('service_infotext', get_the_ID());
                                $service_about = SCF::get('service_about', get_the_ID());

                                $details = [
                                    'service_campany' => '会社名',
                                    'service_web' => 'Webサイト',
                                    'service_phonenunber' => '電話番号',
                                    'service_address' => '住所',                                    
                                    'service_time' => '営業時間',
                                    'service_holidays' => '定休日',
                                    'service_pay' => '支払方法',
                                    'service_term' => '対象期間',
                                    'service_note' => '備考',
                                    'service_url' => '学割URL', 
                                    'service_access' => 'アクセス',
                                    'service_map' => '地図'
                                ];

                                echo '<div class="service-sin-container">';

                                if (!empty($service_name)) {
                                    echo '<h1 class="service-sin-title">' . esc_html($service_name) . '</h1>';
                                }

                                echo '<div class="service-sin-info-container">';

                                    if ($service_picture) {
                                        $image_url = wp_get_attachment_url($service_picture);
                                        if ($image_url) {
                                            echo '<div class="service-sin-picture">';
                                            
                                            $service_url = SCF::get('service_url', get_the_ID()); 
                                            if ($service_url) {
                                                echo '<a href="' . esc_url($service_url) . '" target="_blank">';
                                            } else {
                                                $post_url = get_permalink();
                                                echo '<a href="' . esc_url($post_url) . '" target="_blank">';
                                            }
                                    
                                            echo '<img src="' . esc_url($image_url) . '" alt="写真">';
                                            echo '</a>';
                                            echo '</div>';
                                        } else {
                                            echo '<p>画像のURLが取得できませんでした。</p>';
                                        }
                                    } else {
                                        echo '<p>画像が見つかりませんでした。</p>';
                                    }
                                    
                                    echo '<div class="service-sin-texts">';
                                        if (!empty($service_infotext)) {
                                            echo '<div class="service-sin-infotext">' . $service_infotext . '</div>';
                                        }
                                    
                                        if (!empty($service_about)) {
                                            echo '<div class="service-sin-about"><strong>詳細・条件</strong> ' . wp_kses_post($service_about) . '</div>';
                                        }
                                    echo '</div>'; // .service-sin-texts
                                
                                echo '</div>'; // .service-sin-info-container
                                
                                                        
                            
                                // 地域、年齢、カテゴリーのタグを取得
                                $location = SCF::get('location', get_the_ID()); // 地域
                                $age_group = SCF::get('age_group', get_the_ID()); // 年齢
                                $categories = get_the_category(); // カテゴリー
                                
                                echo '<div class="service-sin-tags">';
                                
                                // カテゴリータグ（リンクに変換）
                                if (!empty($categories)) {
                                    foreach ($categories as $category) {
                                        // カテゴリーのリンクを作成
                                        $category_link = home_url('/service-type/' . $category->slug . '/');
                                        echo '<a href="' . esc_url($category_link) . '" class="service-tag">＃' . esc_html($category->name) . '</a>';
                                    }
                                }
                                
                                // 年齢タグ（リンクに変換）
                                if (!empty($age_group)) {
                                    // 年齢グループのリンクを作成
                                    $age_group_link = home_url('/age-type/' . $age_group . '/');
                                    echo '<a href="' . esc_url($age_group_link) . '" class="service-tag">＃' . esc_html($age_group) . '</a>';
                                }
                                
                                // 地域タグ（リンクに変換）
                                if (!empty($location)) {
                                    // 地域のリンクを作成
                                    $location_link = home_url('/region-type/' . $location . '/');
                                    echo '<a href="' . esc_url($location_link) . '" class="service-tag">＃' . esc_html($location) . '</a>';
                                }
                                
                                echo '</div>';
                                
                                
                            echo '</div>'; 


                            
                        ?>

                        <?php

                                
                                
                                
                                

                                echo '<table class="service-custom-fields-table">';
                                foreach ($details as $field_name => $label) {
                                    $value = SCF::get($field_name, get_the_ID());

                                    if (!empty($value)) {
                                        echo '<tr>';
                                        echo '<td class="service-custom-field-label">' . esc_html($label) . '</td>';

                                        echo '<td>';

                                        // リンクを含む2項目だけラッパーdivを入れる
                                        if ($field_name === 'service_web' || $field_name === 'service_url') {
                                            echo '<div class="service-fixed-url-wrapper">'; // ← ラッパーdiv

                                            echo '<a href="' . esc_url($value) . '" target="_blank">' . esc_html($value) . '</a>';

                                            echo '<a href="' . esc_url($value) . '" target="_blank" class="service-fixed-url">';
                                            echo '<div>該当ページへ</div>';
                                            echo '</a>';

                                            echo '</div>'; // ← ラッパーdiv閉じ
                                        } else {
                                            echo esc_html($value);
                                        }

                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                                echo '</table>';




                                
                        ?>
                        <p class="btn-motto service-ith">
                            <a href="http://gakuwari.site/service/" class="btn btn-flat"><span>学割一覧に戻る</span></a>
                        </p>
                        
                    </div>
                </section>
            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>   
           
        </section> 
        <div class="related-articles">
            <div class="related-articles__header">
                <h2 class="related-articles__title">関連する記事</h2>
            </div>
                <ul class="related-articles__list">
                    <?php
                    $taxonomy = 'service-type';
                    $current_terms = get_the_terms($post->ID, $taxonomy);
                    $terms = $current_terms ? array_map(function($term) { return $term->slug; }, $current_terms) : [];
                        $args = array(
                        'post_type' => 'service',
                        'posts_per_page' => 20,
                        'orderby' => 'rand',
                        'post__not_in' => array($post->ID),
                        'tax_query' => array(
                            array(
                                'taxonomy' => $taxonomy,
                                'terms' => $terms,
                                'field' => 'slug',
                            ),
                        ),
                    );
                    $my_query = new WP_Query($args);
                    if($my_query->have_posts()) :
                        while($my_query->have_posts()): $my_query->the_post();
                    ?>
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
                    <?php endwhile; else: ?>
                    <p>現在準備中です。</p>
                    <?php endif; wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
    </div>
</main>
<?php endwhile;
get_footer(); ?>
