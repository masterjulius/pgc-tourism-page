<?php
/*
 * Template Name: Temp Page
 * The Temp Page
 */
//get_header();
$theme_dir = get_stylesheet_directory_uri();
$page_id = get_the_ID();
?>

<div class="class1">
<?php if ( is_active_sidebar( 'widget-2' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'widget-2' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>
</div>
	
<?php //get_footer(); ?>