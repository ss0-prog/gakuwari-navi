<<?php get_header('page'); while ( have_posts() ) : the_post();?>
<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter"> 
        <main id="pagecontent" class="allcontent">
                <div class="title thanks thanks-title">
                    <h1>Thank You!</h1>
                    <p>お問合せいただきありがとうございます</p>
                </div>

                <div class="contact-thanks">
                    <p>
                    この度は、学割サイトの、<br>
                    学割情報掲載にお申し込みいただき、誠にありがとうございます。<br>
                    弊社の、WEBサイトの担当者より、平日２営業日以内にご連絡いたします。<br>
                    <br>
                    なお、誠に恐縮ですが、２営業日以内に、当方から連絡がない場合、<br>
                    システム上の不具合などが発生している可能性がありますので、<br>
                    電話にてご連絡いただけますと幸いです。<br>
                    <br>
                    どうかよろしくお願いいたします。<br>
                    <br>
                    〇〇<br>
                    TEL:00-0000-0000<br>
                    </p>
                </div>
                
        </main>
        <div class="btn-motto contact-back">
            <a href="http://gakuwari.site/" class="btn btn-flat"><span>TOPページに戻る</span></a>
        </div>
    </div>
</main>
<?php endwhile; get_footer(); ?>