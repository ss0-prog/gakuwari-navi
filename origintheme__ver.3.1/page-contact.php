<?php get_header(); 
while ( have_posts() ) : the_post();?>



<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter"> 
        <div class="mail-title gw-contact">
            <header class="gw-svc-hero gw-contact-hero bseyifbslink">
                <p class="gw-svc-hero__en">CONTACT</p>
                <h1 class="gw-svc-hero__title">お問合せ</h1>
            </header>
            <?php the_content(); ?>     
          
           
        </div>
    </div>
</main>


<!-- サンプル01.画像の摘出 -->
<!--img src="<?php echo get_template_directory_uri();?>/common/images/画像名" alt=""-->




<?php endwhile;
get_footer(); ?>