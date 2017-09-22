<?php

	get_header();

	if ( have_posts() ):
		the_post();
?>
	<script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/social-media-integration.js"></script>

	<div class="caganda-single-main-page">

<?php

	/** 
	 * call post/page view counter
	 */
	wpb_set_post_views( get_the_ID() );

	// Conditions
	$post_type = get_post_type( get_the_ID() );
			
	$single_dir = TEMPLATEPATH . '/include-single-pages/';
	$template_dir = TEMPLATEPATH . '/page-templates/';
	if ( $post_type === "post" ) {

		/** Get the Categorie(s) of this post */
		$cats = get_the_category( get_the_ID() );
		$array_cats = array();
		foreach ($cats as $value) {
			array_push($array_cats, strtoupper($value->name));
		}

		if ( in_array("ACTIVITY", $array_cats) ) {
			include( $single_dir . 'single-activities.php' );
		} else {
			include( $single_dir . 'single-main.php' );
		}

	} elseif ( $post_type === "advisories" ) {

		include( $single_dir . 'single-advisories.php' );
				
	} elseif ( $post_type === "bids-and-awards" ) {

		include( $single_dir . 'single-bids-and-awards.php' );
				
	} elseif ( $post_type === "doodle" ) {

		include( $single_dir . 'single-doodle.php' );
				
	} elseif ( $post_type === "events" ) {

		include( $single_dir . 'single-events.php' );
				
	} elseif ( $post_type === "fdp-files" ) {

		include( $template_dir . 'page-cagayan-fdp.php' );

	} elseif ( $post_type === "gallery" ) {

		include( $single_dir . 'single-gallery.php' );
				
	} elseif ( $post_type === "government-offices" ) {

		// no files yet
				
	} elseif ( $post_type === "news" ) {

		include( $single_dir . 'single-news.php' );

	} elseif ( $post_type === "videos" ) {

		include( $single_dir . 'single-videos.php' );

	} else {

		include( $single_dir . 'single-main.php' );
		
	}

?>

	</div>

	<!-- <div class="row">
		<h4>View Counts</h4>
		<h5><?php //echo wpb_get_post_views(get_the_ID()); ?></h5>
	</div> -->
		
<?php
	endif;

	get_footer();

?>