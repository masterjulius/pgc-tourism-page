<?php get_header(); ?>
<?php 
	if ( have_posts() ):
		$category_ID = get_cat_ID( single_cat_title( '', false ) );
		while ( have_posts() ):
			the_post();
			echo the_title() . "<br/>";
		endwhile;
		wp_reset_postdata();
	endif;	
?>
<?php get_footer(); ?>