<?php
/**
 * The main template file for displaying categories
 *
 */
get_header(); ?>




<?php single_cat_title(); ?>一覧


<?php
  $args = array(
    'post_type' => 'service',
    'taxonomy' => 'category',
  );
  $the_query = new WP_Query($args);
?>
<?php if ($the_query->have_posts()): ?>
  <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
   <?php the_title(); ?>
  <?php endwhile; ?>
<?php else: ?>
  <!-- ここに投稿がない場合の記述 -->
<?php endif; wp_reset_postdata(); ?>



<ul class="stocklist clearfix">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>

                    <li class="clearfix <?php echo $term_slug; ?>"><a href="<?php the_permalink(); ?>" target="_blank">
                    <h3><?php the_title(); ?></h3>
                    </li>
            <?php endwhile; ?>
            <?php else : ?>
                <li class="no-list">該当の商品はございません</li>
            <?php endif; ?>
            <?php wp_reset_query(); ?>  
            
            </ul>




<?php
// Get the current term (category) details
$terms = get_the_terms(get_the_ID(), 'category');
if ($terms && !is_wp_error($terms)) :
    $term_names = wp_list_pluck($terms, 'name');
    echo 'カテゴリー: ' . implode(', ', $term_names); // Display the category name(s)
endif;

// 投稿ページで地域を表示
$terms_region = get_the_terms(get_the_ID(), 'region');  // 'region' は地域タクソノミー名
if ($terms_region && !is_wp_error($terms_region)) :
    $term_names_region = wp_list_pluck($terms_region, 'name');  // 地域名を取り出す
    echo '地域: ' . implode(', ', $term_names_region);   // 地域名を表示
endif;

// 投稿ページで年齢を表示
$terms_age = get_the_terms(get_the_ID(), 'age');  // 'age' は年齢タクソノミー名
if ($terms_age && !is_wp_error($terms_age)) :
    $term_names_age = wp_list_pluck($terms_age, 'name');  // 年齢名を取り出す
    echo '年齢: ' . implode(', ', $term_names_age);   // 年齢名を表示
endif;
?>







<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a">
                <div class="top-content">
                    <div class="top-content-gef">

                        <!-- Custom Query to get posts from the current category, region, and age -->
                        <?php
                        // Get the current category terms
                        $terms = get_the_terms(get_the_ID(), 'category');
                        $terms_region = get_the_terms(get_the_ID(), 'region');
                        $terms_age = get_the_terms(get_the_ID(), 'age');

                        // Prepare the custom query args
                        $args = array(
                            'post_type' => 'service',  // Custom post type
                            'posts_per_page' => 4,     // Number of posts to show
                            'tax_query' => array(
                                'relation' => 'AND',  // Multiple taxonomies relation (AND to satisfy all)
                                array(
                                    'taxonomy' => 'category',  // Category taxonomy
                                    'field'    => 'slug',      // Slug field
                                    'terms'    => wp_list_pluck($terms, 'slug'), // Current category terms
                                ),
                                array(
                                    'taxonomy' => 'region',  // Region taxonomy
                                    'field'    => 'slug',    // Slug field
                                    'terms'    => wp_list_pluck($terms_region, 'slug'),  // Current region terms
                                ),
                                array(
                                    'taxonomy' => 'age',  // Age taxonomy
                                    'field'    => 'slug', // Slug field
                                    'terms'    => wp_list_pluck($terms_age, 'slug'),  // Current age terms
                                ),
                            ),
                        );
                        $custom_query = new WP_Query($args);

                        // Check if there are any posts
                        if ($custom_query->have_posts()) :
                            while ($custom_query->have_posts()) : $custom_query->the_post();
                                ?>
                                <div class="top-content-item">
                                    <div class="top-content-img">
                                        <a href="<?php the_permalink(); ?>" class="image-container">
                                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="hover-zoom">
                                        </a>
                                    </div>
                                    <a href="<?php the_permalink(); ?>"><p class="top-content-text"><?php the_title(); ?></p></a>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>カテゴリー内に投稿がありません。</p>';
                        endif;
                        ?>
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
