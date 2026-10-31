<?php get_header(); 
while ( have_posts() ) : the_post();?>

<?php the_content(); ?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a concept-nuibavsdae">
                <section class="newstopics__section-ac">
                    <div class="concept-page-text">
                        <p class="concept-head">学生の“お得”を、もっと身近に。</p>
                        <p>バイト代や仕送り、限られたお金の中でやりくりしながら<br>遊びも勉強も全力で楽しみたい——。<br>そんな学生のリアルな気持ちに寄り添い、お得な情報をひとつにまとめたのが、<br>この学割ポータルサイト『学割ナビ』です。</p>
                        <p>「映画を観たい！」「旅行に行きたい！」「最新のPCやスマホも欲しい！」<br>でも、できるだけ安く抑えたい。<br>そんなあなたのために、学割で得する情報を、わかりやすく、シンプルに、<br>すぐに見つけられる形でお届けします。</p>
                        <p>「こんな学割があったんだ！」という発見を、もっと身近に。<br>学生生活を、もっと自由に、もっとお得に。<br>日常をアップデートしよう。</p>
                        <p>このサイトは、あなたのかけがえのない学生生活をサポートします。</p>
                        <p>学割NAVI編集部
                        　　mail@example.com</p>
                    </div>
                </section>
                <section class="concept-picture">
                    
                </section>
            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>   
        </section> 
    </div>
</main>


<!-- サンプル01.画像の摘出 -->
<!--img src="<?php echo get_template_directory_uri();?>/common/images/画像名" alt=""-->




<?php endwhile;
get_footer(); ?>