<?php get_header(); 
while ( have_posts() ) : the_post();?>

<?php the_content(); ?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
    <section class="main-topcontent">
            <div class="main-topcontent-a">
                <section  class="newstopics__section-ac">
                    <div class="campany-container">
                        <div class="campany-title">構成スタッフ・運営会社</div>
                        <div class="info-list">
                            <p>[運営スタッフ]</p>
                            
                            <div class="campany-info">
                                <div class="info-title">デザイン</div>
                                <div class="info-content">コバヤシデザイン</div>
                            </div>
                            <div class="campany-info">
                                <div class="info-title">サイト運営</div>
                                <div class="info-content">アトリエあふろ</div>
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
                                        <strong>[東京本社]</strong><br>107-0062<br>東京都港区南青山5-4-35-902<br>TEL 00-0000-0000 FAX 00-0000-0000
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
                                    <div href="mail@example.com" target="_blank">mail@example.com</div>
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