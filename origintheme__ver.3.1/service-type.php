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
                        <!-- Custom Query to get posts from the current category, region, and age -->
                        <?php
                        // Get the current terms (category, region, and age)
                        $terms_category = get_the_terms(get_the_ID(), 'category');
                        $terms_region = get_the_terms(get_the_ID(), 'region');
                        $terms_age = get_the_terms(get_the_ID(), 'age');

                        // Initialize an empty tax_query array
                        $tax_query = array('relation' => 'AND');

                        // Check if category terms exist
                        if ($terms_category && !is_wp_error($terms_category)) {
                            $tax_query[] = array(
                                'taxonomy' => 'category',
                                'field'    => 'slug',
                                'terms'    => wp_list_pluck($terms_category, 'slug'),
                            );
                        }

                        // Check if region terms exist
                        if ($terms_region && !is_wp_error($terms_region)) {
                            $tax_query[] = array(
                                'taxonomy' => 'region',
                                'field'    => 'slug',
                                'terms'    => wp_list_pluck($terms_region, 'slug'),
                            );
                        }

                        // Check if age terms exist
                        if ($terms_age && !is_wp_error($terms_age)) {
                            $tax_query[] = array(
                                'taxonomy' => 'age',
                                'field'    => 'slug',
                                'terms'    => wp_list_pluck($terms_age, 'slug'),
                            );
                        }

                        // Prepare the custom query args
                        $args = array(
                            'post_type'      => 'service',  // Custom post type
                            'posts_per_page' => 4,         // Number of posts to show
                            'tax_query'      => $tax_query,  // Use the prepared tax_query
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
