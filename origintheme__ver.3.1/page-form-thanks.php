<?php get_header('page'); while ( have_posts() ) : the_post();?>
<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter"> 
        <main id="pagecontent" class="allcontent">
                <div class="title thanks thanks-title">
                    <h1>Thank You!</h1>
                    <p>お申し込みいただきありがとうございます</p>
                </div>

                <div class="contact-thanks">
                    <p>
                    この度は、学割サイトの、<br>
                    学割情報掲載にお申し込みいただき、誠にありがとうございます。<br>
                    弊社の、WEBサイトの担当者より、平日２営業日以内にご連絡いたします。<br>
                    <br>
                    どうかよろしくお願いいたします。<br>
                    <br>
                    学割サイト担当<br>
                    </p>
                </div>
                
        </main>
        <div class="btn-motto contact-back">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-flat"><span>TOPページに戻る</span></a>
        </div>
    </div>
</main>
<?php endwhile; get_footer(); ?>