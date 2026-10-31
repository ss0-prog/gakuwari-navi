<?php
/**
 * The main template file
 *
 */
get_header();?>

<div class="page">

<div class="contents">

    <ul id="breadCrumb">
      <li><a href="index.html">ホーム</a></li>
      <li>ニュース</li>
    </ul>

  <h1>NEWS<span>ニュース</span></h1>

<div class="list">

<ul class="NEWS-box">
  <li><a href="/news">全ての記事</a></li>
  <?php $args = array(
  'order'            => 'ASC',
  'title_li'           => '',
  'taxonomy'           => 'information'
   );
  wp_list_categories( $args );  ?>
</ul>

    <ul class="NEWS-area">


    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
        $tax = get_the_terms(get_the_ID(),'information');//タクソノミーを取得
        $tax_id = $tax[0]->term_id;
        /*echo 'IDは'.$tax_id;*/ ?>
        <?php /*p class="report-icon"><?PHP if ($tax_id > 15) { echo "勉強・交流"; } elseif($tax_id < 16){ echo "企業・訪問";} ?></p> */?>
                    <li>
                      <span class="times"><?php the_time('Y.m.d'); ?></span>
                    <?php if ($tax_id == 3) :?>
                        <span class="news-icon01"><a href="/information/info/">お知らせ</a></span>
                    <?php elseif($tax_id == 4):?>
                        <span class="news-icon02">
                          <a class="" href="/information/write/">執筆活動</a>
                        </span>
                    <?php elseif($tax_id == 5):?>
                        <span class="news-icon03">
                        <a href="/information/lecture/">講演活動</a>
                        </span>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
                    <?php else : ?>
                    <li>まだ記事がありません</li>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </ul>

        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

</div><!-- list end -->

</div><!-- contents end -->

</div><!-- page end -->

<?php get_footer(); ?>