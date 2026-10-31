<!-----------------------------
基本的なPHP記述
------------------------------>

<!-- 投稿タイトルの表示 -->
<?php the_title(); ?>

<!-- エディターに記載した文章の表示 -->
<?php the_content(); ?>

<!-- 登校日の表示(Y＝年 , M＝月 , D＝日) -->
<?php the_time("Y.M.D"); ?>

<!-- SRCに関わるディレクトリ -->
<?php echo get_template_directory_uri();?>

<!-- instagramアイコンSVG 呼び起こし -->
<?php get_template_part('instagram-icon'); ?>

<!-- facebookアイコンSVG 呼び起こし -->
<?php get_template_part('facebook-icon'); ?>

<!-- youtubeアイコンSVG 呼び起こし -->
<?php get_template_part('youtube-icon'); ?>

<!-- サイドバー 呼び起こし -->
<?php get_sidebar('sidebar'); ?>

<?php the_permalink()

<!-- カスタム投稿一覧の表示(archive   ※ulタグで書いた場合) -->

<ul>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
<!-- ここからフリーエリア -->
<li><?php the_title(); ?></li>
<!-- フリーエリアここまで -->
<?php endwhile; ?>
<?php else : ?>
<li>まだ記事がありません</li>
<?php endif; ?>
<?php wp_reset_query(); ?>
</ul>




<!-- カスタム投稿一覧の表示(top,他   ※ulタグで書いた場合) -->

<ul>
<?php query_posts( array(
'post_type' => 'post', //カスタム投稿スラッグ名
'showposts' => 5, //表示したい投稿数
'paged' => $paged)); 
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<?php query_posts( array(
'post_type' => 'service', //カスタム投稿スラッグ名
'showposts' => 4, //表示したい投稿数
'paged' => $paged)); 
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>



<!-- ここからフリーエリア -->
<li><?php the_title(); ?></li>
<!-- フリーエリアここまで -->

<?php endwhile; ?>
<?php else : ?>
<li>まだ記事がありません</li>
<?php endif; ?>
<?php wp_reset_query(); ?>
</ul>





<!-----------------------------
基本的なPHP記述
------------------------------>

<!-- 基本的なテキスト表示 -->
<?php echo nl2br(post_custom('カスタム名を記述'));?>

<!-- 基本的な画像表示 -->
<?php $mainimg = post_custom('カスタム名を記述'); echo wp_get_attachment_image($mainimg, '画像の規格名を表示。なければ「full」'); ?>

<!-- カスタム名に記述がなければのif文 -->
<?php if(post_custom('カスタム名を記述')): ?>
<!-- 
    ここに記載
 -->
<?php endif; ?>




<!-- 基本的なグループ表示 -->
<?php $group_set = SCF::get( 'カスタムグループ名を記述' );
 foreach ( $group_set as $field_name => $field_value ) {?>

    <!-- テキスト表示の場合 -->
    <?php echo nl2br( $field_value['カスタム名を記述'] ); ?>

    <!-- 画像表示の場合 -->
    <?php echo wp_get_attachment_image( $field_value['カスタム名を記述'],'画像の規格名を表示。なければ「full」'); ?>

<?php } ?>








<!-- taxonomyに関わる記述 -->
<ul>
<?php
	$args = array(
		'taxonomy' => 'タクソノミー名',
		'order' => 'ASC'
	);
	$categories = get_categories( $args );
?>
<?php foreach( $categories as $category ) : ?>
    <li>
		<a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a>
    </li>
<?php endforeach; ?>
</ul>