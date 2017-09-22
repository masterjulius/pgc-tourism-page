<?php 
/*
 * Template Name: Cagayan Doodles Gallery Page
 * The Doodles Gallery page template file
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
$page_id = get_the_ID();

?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-doodle.min.css" />

<!-- PAGE -->
<div class="cag-page-doodle cag-page-template">
	
  	<div class="row">

	    <div class="container">

			<!--slider-->
<?php
			$slide_query = new WP_Query(array('post_type' => 'doodle','posts_per_page' => 4));
?>			
		  	<div class="slider">
			    <ul class="slides">

<?php
				if ( $slide_query->have_posts() ):
					while ( $slide_query->have_posts() ):
						$slide_query->the_post();
						$slide_id = get_the_ID();
						$slide_title = get_the_title();
						$slide_thumb_id = get_post_thumbnail_id($slide_id);
						$slide_url = get_the_permalink($slide_id);
						// image metas
						$slide_thumb_url = get_the_post_thumbnail_url($slide_id);
						$slide_thumb_title = get_the_title($slide_thumb_id);
						$slide_thumb_alt = !empty(get_post_meta($slide_thumb_id, '_wp_attachment_image_alt', true)) ? get_post_meta($slide_thumb_id, '_wp_attachment_image_alt', true) : 'Cagayan Doodle';
?>		    
			      	<li onclick="window.location.href='<?php echo $slide_url; ?>'">
			        	<img src="<?php echo $slide_thumb_url; ?>" alt="<?php echo $slide_thumb_alt; ?>" title="<?php echo $slide_thumb_title; ?>" />
			      	</li>
<?php
					endwhile;
					wp_reset_postdata();
				endif;
?>

			    </ul>
		  	</div>

			<!--end of slider-->

	     	<div class="cag-doodle-images">

<?php
			$collection_query = new WP_Query(array('post_type' => 'doodle','posts_per_page' => 12));
			if ( $collection_query->have_posts() ):
				$index = 1;
				while ( $collection_query->have_posts() ):
					$collection_query->the_post();
					$cllctn_id = get_the_ID();
					$cllctn_title = get_the_title();
					$cllctn_thumb_id = get_post_thumbnail_id($cllctn_id);
					$cllctn_url = get_the_permalink($cllctn_id);
					// image metas
					$cllctn_thumb_url = get_the_post_thumbnail_url($cllctn_id);
					$cllctn_thumb_title = get_the_title($cllctn_thumb_id);
					$cllctn_thumb_alt = get_post_meta($cllctn_thumb_id, '_wp_attachment_image_alt', true);
?>	     	

				    <a href="<?php echo $cllctn_url; ?>" rel="<?php echo $cllctn_thumb_title; ?>">
				        <div class="col s12 m6 l4">
				          	<img src="<?php echo $cllctn_thumb_url; ?>" alt="<?php echo $cllctnthumb_alt; ?>" title="<?php echo $cllctn_thumb_title; ?>" />
				          	<p><?php echo $cllctn_title; ?></p>
				          	<span><?php echo get_the_date(); ?></span>
				        </div>
				    </a>

				<?php if(($index %3)==0) echo "<hr/>"; ?>

<?php
					$index++;
				endwhile;
				wp_reset_postdata();
			endif;
?>


	      	</div>


    	</div> <!-- End container -->
  
  	</div>

</div>

<!--end page-->
<!-- END PAGE -->

<!-- SCRIPTS -->
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-doodle.js"></script>

<?php
get_footer();
?>