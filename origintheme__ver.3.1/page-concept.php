<?php get_header(); 
while ( have_posts() ) : the_post();?>

<?php the_content(); ?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
        <section class="main-topcontent">
            <div class="main-topcontent-a concept-nuibavsdae gw-reco gw-reco-single gw-concept">
                <nav class="gw-crumb" aria-label="現在位置">
                    <a href="<?php echo esc_url(home_url('/')); ?>">TOP</a><span>›</span><em>サイトコンセプト</em>
                </nav>
                <article class="gw-reco-article bseyifbslink">
                    <header class="gw-reco-article__head">
                        <p class="gw-svc-hero__en">CONCEPT</p>
                        <h1 class="gw-reco-article__title"><span class="gw-concept-mark">学生の“お得”を、もっと身近に。</span></h1>
                    </header>
                    <div class="gw-reco-article__body gw-concept-text">
                        <p>バイト代や仕送り、限られたお金の中でやりくりしながら<br>遊びも勉強も全力で楽しみたい——。<br>そんな学生のリアルな気持ちに寄り添い、お得な情報をひとつにまとめたのが、<br>この学割ポータルサイト『学割ナビ』です。</p>
                        <p>「映画を観たい！」「旅行に行きたい！」「最新のPCやスマホも欲しい！」<br>でも、できるだけ安く抑えたい。<br>そんなあなたのために、学割で得する情報を、わかりやすく、シンプルに、<br>すぐに見つけられる形でお届けします。</p>
                        <p>「こんな学割があったんだ！」という発見を、もっと身近に。<br>学生生活を、もっと自由に、もっとお得に。<br>日常をアップデートしよう。</p>
                        <p>このサイトは、あなたのかけがえのない学生生活をサポートします。</p>
                        <p class="gw-concept-sign">学割NAVI編集部<br><a href="mailto:toiawase@gakuwari.site">toiawase@gakuwari.site</a></p>
                    </div>
                </article>
            </div>
            <div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>   
        </section> 
    </div>
</main>

<?php endwhile;
get_footer(); ?>
