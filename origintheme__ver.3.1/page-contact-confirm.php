<?php get_header(); 
while ( have_posts() ) : the_post();?>



<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter"> 
        <div class="mail-title">
            <p class="mail-title-top">お問合せ内容確認</p>
            <?php the_content(); ?>     
          
           
        </div>
    </div>
</main>


<!-- サンプル01.画像の摘出 -->
<!--img src="<?php echo get_template_directory_uri();?>/common/images/画像名" alt=""-->




<?php endwhile;
get_footer(); ?>