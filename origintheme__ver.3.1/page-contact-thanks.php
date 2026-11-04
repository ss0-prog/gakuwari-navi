<?php get_header('page'); while ( have_posts() ) : the_post();?>
<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter"> 
        <main id="pagecontent" class="allcontent">
                <div class="title thanks">
                    <h1>Thank You!</h1>
                    <p>お問い合わせいただきありがとうございます</p>
                </div>

                <div class="contact-thanks">
                <p>
                この度は、学割サイトに、<br>
                お問い合わせくださり、誠にありがとうございます。<br>
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