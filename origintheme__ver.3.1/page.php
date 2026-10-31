<?php get_header(); 
while ( have_posts() ) : the_post();?>

<?php the_content(); ?>




<!-- サンプル01.画像の摘出 -->
<!--img src="<?php echo get_template_directory_uri();?>/common/images/画像名" alt=""-->




<?php endwhile;
get_footer(); ?>