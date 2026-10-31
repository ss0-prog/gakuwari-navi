<?php get_header(); 
while ( have_posts() ) : the_post();?>

<div class="page">
	<div class="contents">

	    <ul id="breadCrumb">
	    	<li><a href="/">ホーム</a></li>
	    	<li><a href="/news">ニュース</a></li>
	    	<li><?php the_title(); ?></li>
	    </ul>

	    <h1><?php the_title(); ?></h1>
	     <div class="list">
	     	<?php the_content(); ?>
	     </div><!-- list end -->
	     
	</div><!-- contents end -->
</div><!-- page end -->

<?php endwhile;
get_footer(); ?>