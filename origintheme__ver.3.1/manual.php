









<!-----------------------------------------------------------

            【基本的なHTML記述】

------------------------------------------------------------>

<!-- 画像の表示 -->
<img src="<?php echo get_template_directory_uri();?>/common/images/sample.png" alt="">




<!-- トップページのコーディングに使用 -->
<main id="topcontent" class="topcontent">
    <section  class="topcontent__section">
        <h1>見出し(H1)サンプル</h1>
        <h2>見出し(H2)サンプル</h2>
        <h3>見出し(H3)サンプル</h3>
        <h4>見出し(H4)サンプル</h4>
        <a class="sectionlink" href="/"></a>
        <a class="sectionlink" href="/" target="_blank"></a>
    </section>
    <!-- topcontent__section / END -->
</main>
<!-- topcontent / END -->




<!-- 下層ページのコーディングに使用 -->
<main id="pagecontent" class="pagecontent">

    <section  class="pagecontent__section">
    </section>
    <!-- pagecontent__section / END -->

</main>
<!-- pagecontent / END -->





<!-- NEWS一覧に使用 -->
<div class="archivecontent">

  <ul class="archivecontent__list">

    <li class="archivecontent__list-item">
      <a href="<?php the_permalink(); ?>">
        <span><?php the_time("Y.m.d"); ?></span>
        <?php the_title(); ?>
      </a>
    </li>

  </ul>
  <!-- archivecontent__list / END -->

</div>
<!-- archivecontent / END -->










<!-----------------------------------------------------------

            【基本的なCSS記述 / HTML class side】

------------------------------------------------------------>


<!-- フォントに関わる記述
class="bold"      太字にする記述
class="red"       赤字にする記述
class="glue"      青字にする記述
class="yellow"    黄字にする記述
class="green"     緑字にする記述
 -->


<!-- display: flex;に関わる記述
class="flexcontent"
class="flexcontent twoclum"     //2カラムのコンテンツに使用
class="flexcontent treeclum"    //3カラムのコンテンツに使用
class="flexcontent fourclum"    //4カラムのコンテンツに使用
class="flexcontent fiveclum"    //5カラムのコンテンツに使用
class="flexcontent__item"       //"flexcontent"の子要素として使用
 -->


<!-- display: grid;に関わる記述
class="gridcontent"
class="gridcontent twoclum"     //2カラムのコンテンツに使用
class="gridcontent treeclum"    //3カラムのコンテンツに使用
class="gridcontent fourclum"    //4カラムのコンテンツに使用
class="gridcontent fiveclum"    //5カラムのコンテンツに使用
class="gridcontent__item"       //"gridcontent"の子要素として使用
 -->










<!-----------------------------------------------------------

            【基本的なPHP記述】

------------------------------------------------------------>


<!-- 投稿タイトルの表示 -->
<?php the_title(); ?>


<!-- エディターに記載した文章の表示 -->
<?php the_content(); ?>


<!-- 登校日の表示(Y＝年 , M＝月 , D＝日) -->
<?php the_time("Y.M.D"); ?>


<!-- 一覧の表示 -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!-- タイトル,日付などの投稿内容を表示 -->
<?php endwhile; ?>
<?php else : ?>
<!-- 投稿内容がなかった場合の記述 / 例:現在記事のはございません。 -->
<?php endif; ?>








<!-----------------------------------------------------------

            【Smart Custom Fieldに関わるPHP記述】

------------------------------------------------------------>


<!-- テキスト出力(改行反映なし / 「テキスト」使用に推奨) -->
<?php $scf_field = SCF::get('出力内容'); echo $scf_field; ?>


<!-- テキスト出力(改行反映あり / 「テキストエリア」使用に推奨) -->
<?php echo nl2br(post_custom('出力内容')); ?>


<!-- 画像出力(独立した画像を表示) -->
<?php $scf_field = SCF::get('出力内容'); echo wp_get_attachment_image($scf_field,'thumbnail'/* ''内は画像サイズを指定 */); ?>


<!-- 真偽値出力 -->
<?php
  $scf_field = SCF::get('出力内容');
  if( $scf_field ){
    // はい（true）の時の処理
  }else{
    // いいえ（false）の時の処理
  }
?>


<!-- チェック項目の出力 -->
<?php $scf_field = SCF::get('出力内容'); foreach( $scf_field as $value ){echo $value;} ?>


<!-- ラジオボタン項目の出力 -->
<?php $scf_field = SCF::get('出力内容'); echo $scf_field; ?>


<!-- 選択項目の出力 -->
<?php $scf_field = SCF::get('出力内容'); foreach( $scf_field as $value ){echo $value;} ?>


<!-- WYSIWYGの出力 -->
<?php $scf_field = SCF::get('出力内容'); echo nl2br($scf_field); ?>



<!----------------------------------
    もしも、記述がなかった場合の条件分岐 (if文)
----------------------------------->
<?php if (post_custom('出力内容')) : ?>
<!-- 記述があった場合に表示される内容 -->
<?php else : ?>
<!-- 記述がなかった場合に表示される内容 -->
<?php endif; ?>




