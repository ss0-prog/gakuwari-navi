<?php get_header(); 
while ( have_posts() ) : the_post();?>
<?php
  
  echo SCF::get('scf_field');
?>

<main id="topcontent" class="topcontent wrapcontent">
    <div class="wrapcontentcenter">
		<section class="main-topcontent">
			<div class="main-topcontent-a">
				<div class="single-text">
					<div class="single_title">
						<h1><?php the_title(); ?></h1>
					</div>

					<section>
						<p class="single-days"><?php the_time("Y.M.D"); ?></p>
						<div class="singletext">
							<?php the_content(); ?>
						</div>
					</section>
				</div>
			</div>
			<div class="main-topcontent-b">
                <?php get_sidebar('sidebar'); ?>
            </div>   
		</section>
	</div>	
</main>

<?php endwhile;
get_footer(); ?>