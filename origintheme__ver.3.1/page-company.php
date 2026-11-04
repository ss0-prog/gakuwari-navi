<?php get_header(); 
while ( have_posts() ) : the_post();?>

<?php the_content(); ?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
    <section class="main-topcontent">
            <div class="main-topcontent-a gw-svc gw-company">
                <header class="gw-svc-hero gw-company-hero bseyifbslink">
                    <p class="gw-svc-hero__en">COMPANY</p>
                    <h1 class="gw-svc-hero__title">構成スタッフ・運営会社</h1>
                </header>
                <section class="newstopics__section-ac gw-company-card">
                    <div class="campany-container">
                        <div class="info-list">
                            <p>[運営スタッフ]</p>
                            
                            <div class="campany-info">
                                <div class="info-title">プロデューサー</div>
                                <div class="info-content"><img class="gw-company__name" src="<?php echo get_template_directory_uri(); ?>/images/producer-name.svg" width="48" height="19" alt=""></div>
                            </div>
                            <div class="campany-info">
                                <div class="info-title">サイト運営</div>
                                <div class="info-content"><img class="gw-company__name" src="<?php echo get_template_directory_uri(); ?>/images/producer-name.svg" width="48" height="19" alt=""><br>アトリエあふろ</div>
                            </div>
                        </div>
                        <div class="info-list">
                            <p>[運営会社の概要]</p>
                            <div class="campany-info">
                                <div class="info-title">会社名</div>
                                <div class="info-content">株式会社アトリエあふろ atelier Afullo Co.LTD.</div>
                            </div>
                            <div class="campany-info">
                                <div class="info-title">所在地</div>
                                <div class="info-content">
                                    <div class="address-group">
                                        <strong>[東京本社]</strong><br>107-0062<br>東京都港区南青山5-4-35-902<br>TEL 03-6419-7399 FAX 03-6419-7395
                                    </div>
                                </div>
                            </div>
                            <div class="campany-info">
                                <div class="info-title">URL</div>
                                <div class="info-content campany-url">
                                    <a href="https://afullo.co.jp/" target="_blank">https://afullo.co.jp/</a>
                                </div>
                            </div>
                            <div class="campany-info">
                                <div class="info-title">メールアドレス</div>
                                <div class="info-content campany-url">
                                    <div href="gakuwari@afullo.com" target="_blank">toiawase@gakuwari.site</div>
                                </div>
                            </div>
                        </div>
                    </div>
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