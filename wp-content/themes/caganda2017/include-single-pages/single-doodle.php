<?php
get_header();
$post_id = get_the_id();
$theme_dir = get_stylesheet_directory_uri();

$slide_title = get_the_title();
$slide_thumb_id = get_post_thumbnail_id($post_id);
$slide_url = get_the_permalink($post_id);
								// image metas
$slide_thumb_url = get_the_post_thumbnail_url($post_id);
$slide_thumb_title = get_the_title($slide_thumb_id);
$slide_thumb_alt = !empty(get_post_meta($slide_thumb_id, '_wp_attachment_image_alt', true)) ? get_post_meta($slide_thumb_id, '_wp_attachment_image_alt', true) : 'Cagayan Doodle';

$prev_ability = array("class" => "disabled", "attr" => "disabled");
$prev_post = get_previous_post();
if (!empty( $prev_post )):
	$prev_link =  get_permalink( $prev_post->ID );
	$prev_ability["class"] = "";
	$prev_ability["attr"] = "";
endif;

$next_ability = array("class" => "disabled", "attr" => "disabled");
$next_post = get_next_post();
if (!empty( $next_post )):
	$next_link = get_permalink( $next_post->ID );
	$next_ability["class"] = "";
	$next_ability["attr"] = "";
endif;


// --------------------------------------
// meta values
$meta_prefix = "cag_doodle_register_meta_box_";

$sktch_img_thumb = array(); $grphc_img_thumb = array(); $anmtn_img_thumb = array();

// IMAGES
if ( !empty(get_post_meta( $post_id, $meta_prefix . "artist_sktch_image_id") ) ) {
	$sktch_img_details = rwmb_meta( $meta_prefix . "artist_sktch_image_id", "image", $post_id );
	if ( !empty( $sktch_img_details ) ) {
		foreach ($sktch_img_details as $sktch_img) {
			$sktch_img_thumb = array(
				"url" => $sktch_img['full_url'],
				"alt" => !empty($sktch_img['alt']) ? $sktch_img['alt'] : 'Cagayan Doodle Sketch Artist',
			);	
		}
	}
}

if ( !empty(get_post_meta( $post_id, $meta_prefix . "artist_grphc_image_id") ) ) {
	$grphc_img_details = rwmb_meta( $meta_prefix . "artist_grphc_image_id", "image", $post_id );
	if ( !empty( $grphc_img_details ) ) {
		foreach ($grphc_img_details as $grphc_img) {
			$grphc_img_thumb = array(
				"url" => $grphc_img['full_url'],
				"alt" => !empty($grphc_img['alt']) ? $grphc_img['alt'] : 'Cagayan Doodle Graphic Artist',
			);	
		}
	}
}

if ( !empty(get_post_meta( $post_id, $meta_prefix . "artist_anmtn_image_id") ) ) {
	$anmtn_img_details = rwmb_meta( $meta_prefix . "artist_anmtn_image_id", "image", $post_id );
	if ( !empty( $anmtn_img_details ) ) {
		foreach ($anmtn_img_details as $anmtn_img) {
			$anmtn_img_thumb = array(
				"url" => $anmtn_img['full_url'],
				"alt" => !empty($anmtn_img['alt']) ? $anmtn_img['alt'] : 'Cagayan Doodle Animation Artist',
			);	
		}
	}
}

$sktch_img_thumb["url"] = !empty($sktch_img_thumb["url"]) ? $sktch_img_thumb["url"] : get_stylesheet_directory_uri() . "/images/svg/animal-icons/pig-1.svg";
$grphc_img_thumb["url"] = !empty($grphc_img_thumb["url"]) ? $grphc_img_thumb["url"] : get_stylesheet_directory_uri() . "/images/svg/animal-icons/panda-3.svg";
$anmtn_img_thumb["url"] = !empty($anmtn_img_thumb["url"]) ? $anmtn_img_thumb["url"] : get_stylesheet_directory_uri() . "/images/svg/animal-icons/dog-1.svg";

// NAMES
$sktch_artist_name = rwmb_meta( $meta_prefix . "artist_sktch_name_id", "type=text", $post_id );							
$grphc_artist_name = rwmb_meta( $meta_prefix . "artist_grphc_name_id", "type=text", $post_id );							
$anmtn_artist_name = rwmb_meta( $meta_prefix . "artist_anmtn_name_id", "type=text", $post_id );

$sktch_img_thumb["artist-name"] = !empty($sktch_artist_name) ? $sktch_artist_name : "Julius B. Palcong";
$grphc_img_thumb["artist-name"] = !empty($grphc_artist_name) ? $grphc_artist_name : "Abigail C. Pineda";
$anmtn_img_thumb["artist-name"] = !empty($anmtn_artist_name) ? $anmtn_artist_name : "Mark Maynard A. Guzman";	

?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/animate.css" /> 
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/slick.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/slick-theme.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/single-doodle.min.css" />

<!--page-->
    <div class="cag-doodle-single cag-page-template">
    
      	<div class="cag-doodle-single-slider-container">

	      	<div class="row">
	        	<div class="container">
	          		<div class="col s12 m12 l12 cag-doodle-inner-slider-parent">
	            		<div class="cag-doodle-single-slider">
            		
	                		<div style="position:relative;">
	                			<img class="responsive-img" src="<?php echo $slide_thumb_url; ?>" alt="<?php echo $slide_thumb_alt; ?>" title="<?php echo $slide_thumb_title; ?>" id="sliderDoodleMainImg" />
	                			<div class="loading-container valign-wrapper">
	                				<img src="<?php echo $theme_dir; ?>/images/svg/hourglass.svg" height="90" alt="" class="valign" id="loadingDoodleGif" />
	                			</div>
	                			
	                		</div>
	                		
	            		</div>
					
						
						<div class="div-prev valign-wrapper">
		                	<a href="<?php echo get_the_permalink($prev_post->ID); ?>" data-slider-id="<?php echo $prev_post->ID; ?>" class="navigate-buttons nav-btn-prev btn-floating btn-large red center <?php echo $prev_ability['class']; ?>" <?php echo $prev_ability["attr"]; ?> data-action="previous"><i class="material-icons">skip_previous</i></a>
		                </div>

		                <div class="div-next valign-wrapper">
		                	<a href="<?php echo get_the_permalink($next_post->ID); ?>" data-slider-id="<?php echo $next_post->ID; ?>" class="navigate-buttons nav-btn-next btn-floating btn-large red center <?php echo $next_ability['class']; ?>" <?php echo $next_ability["attr"]; ?> data-action="next"><i class="material-icons">skip_next</i></a>
		                </div>

	          		</div>
	        	</div>
	      	</div>

      	</div>

    	<div class="cag-single-doodle-bg">

      		<div class="row">

		        <div class="container">

		          	<div class="col s12 m12 l4">

		            	<div class="cag-doodle-single-more">

<?php
					$side_query = new WP_Query(array(
							'post_type' => 'doodle',
							'posts_per_page' => 5,
							'post__not_in' => array($post_id)
						)
					);
					if ( $side_query->have_posts() ):
						while ( $side_query->have_posts() ):
							$side_query->the_post();
							$side_id = get_the_ID();
							$side_title = get_the_title();
							$side_thumb_id = get_post_thumbnail_id($side_id);
							$side_url = get_the_permalink($side_id);
							// image metas
							$side_thumb_url = get_the_post_thumbnail_url($side_id);
							$side_thumb_title = get_the_title($side_thumb_id);
							$side_thumb_alt = !empty(get_post_meta($side_thumb_id, '_wp_attachment_image_alt', true)) ? get_post_meta($side_thumb_id, '_wp_attachment_image_alt', true) : 'Cagayan Doodle';
?>		            	
		              
			              	<div class="card">

			                	<div class="card-image">
			                  		<a href="<?php echo get_the_permalink($side_id); ?>"><img class="responsive-img" src="<?php echo $side_thumb_url; ?>" alt="<?php echo $side_thumb_alt; ?>" title="<?php echo $side_thumb_title; ?>" /></a>
			                	</div>

			                	<div class="card-content">
			                		<h5><?php echo $side_title; ?></h5>
			                 		<span><?php echo get_the_date(); ?></span>
			                	</div>

			              	</div>

<?php
						endwhile;
						wp_reset_postdata();
					endif;	
?>			              	

		            	</div>

		          	</div>

		          	<div class="col s12 m12 l8 doodle-main-details">

			          	<div class="card-panel">
			            	<p class="detail-date"><?php echo get_the_date(); ?></p>
			            	<h5><span class="detail-title"><?php echo get_the_title(); ?></span></h5>
			          	</div>

			            <div class="card-panel">

			              	<p class="detail-content"><?php echo get_the_content(); ?></p>

			            </div>

						<!-- Artists -->
			            <div class="row">

			                <div class="col s12 m6 l4 art-sketch-group">
			                  	<div class="card">
			                    	<div class="card-image">			            
			                      		<img src="<?php echo $sktch_img_thumb["url"]; ?>" alt="<?php echo $sktch_img_thumb["alt"]; ?>" />
			                    	</div>
			                    	<div class="card-content">
			                      		<p><?php echo $sktch_img_thumb["artist-name"]; ?></p>
			                    	</div>
			                    	<div class="card-action">
			                      		<span>Sketch Artist</span>
			                    	</div>
			                  	</div>
			                </div>

			                <div class="col s12 m6 l4 art-graphic-group">
			                  	<div class="card">
			                    	<div class="card-image circle">
			                      		<img src="<?php echo $grphc_img_thumb["url"]; ?>" alt="<?php echo $grphc_img_thumb["alt"]; ?>" />
			                    	</div>
			                    	<div class="card-content">
			                      		<p><?php echo $grphc_img_thumb["artist-name"]; ?></p>
			                    	</div>
			                    	<div class="card-action">
			                      		<span>Graphic Artist</span>
			                    	</div>
			                  	</div>
			                </div>

			                <div class="col s12 m6 l4 art-animator-group">
			                  	<div class="card">
			                    	<div class="card-image">
			                      		<img src="<?php echo $anmtn_img_thumb["url"]; ?>" alt="<?php echo $anmtn_img_thumb["alt"]; ?>" />
			                    	</div>
			                   	 	<div class="card-content">
			                      		<p><?php echo $anmtn_img_thumb["artist-name"]; ?></p>
			                    	</div>
			                    	<div class="card-action">
			                      		<span>Animator</span>
			                    	</div>
			                  	</div>
			                </div>

			            </div>
			            <!-- End Artists -->

		          	</div>

		        </div>

	      	</div>

    	</div>

    </div>
<!--end page-->

<!-- Plugin JavaScript -->
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/slick.min.js"></script>
<!-- Custom Scripts -->

<?php
	/** AJAX */
	// function enquee ajax search help
	
?>

<?php get_footer(); ?>