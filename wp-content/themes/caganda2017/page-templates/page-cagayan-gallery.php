<?php 
/*
 * Template Name: Cagayan Gallery Page
 */
?>
<?php get_header(); ?>

<?php $page_id = get_the_ID(); ?>

<!-- External Scripts -->
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-gallery.min.css" />

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-cagayan-gallery.js"></script> 

<!-- PAGE -->
    <div class="cag-page-gallery cag-page-template">
		
      	<div class="cag-gallery-feature">
        	<div class="parallax-container cag-news-page-parallax-container">
          		<div class="parallax cag-gallery-page-parallax animate-bg"><img src="<?php echo get_the_post_thumbnail_url($page_id); ?>"></div>
            		<div class="cag-gallery-feature-heading">
	              		<h1><?php echo get_the_title( $page_id ); ?></h1>
	              		<p><?php echo get_post_field( 'post_content', $page_id ); ?></p>
	              		<a href="#cag-page-gallery-content" class="waves-effect waves-light page-scroll"><i class="cagicon-chevron-double-down"></i></a>
            		</div>
        	</div>
      	</div>

      	<!-- End of the Main Banner Image -->

      	<div class="cag-page-gallery-content" id="cag-page-gallery-content">
        	<div class="row">
		
<?php
	$args = array(
		'post_type' => 'gallery'
	);
	$query = new WP_Query($args);
	if ( $query->have_posts() ):
		while ( $query->have_posts() ):
			$query->the_post();
			$the_post_id = get_the_ID();
			$meta_id = "cag_gallery_widget_register_meta_box_gallery_images_id";
			$meta_type= "image";
			$cag_meta_images = rwmb_meta( $meta_id, $meta_type, $the_post_id );
			if ( !empty( $cag_meta_images ) ):
				$i = 1;
				$meta_total_images = count($cag_meta_images);
?>
				<div class="col l3 m4 s6">
			        <div class="card">
			            <div class="album-selector waves-effect waves-light">
<?php				
					foreach ($cag_meta_images as $cag_meta_value) {
						
						if ( $i <= 3 ) {
?>

					        <div class="album-thumb">
					        	<img src="<?php echo $cag_meta_value['url']; ?>" />
					        </div>
				              		
<?php
						}
						$i++;

					}
?>

						</div>
					    <div class="album-text">
					    	<a href="<?php echo get_the_permalink(); ?>"><h5><?php echo get_the_title(); ?></h5></a>
					    	<h6><?php echo get_the_date(); ?></h6>
					    	<p><i class="cagicon-gallery left"></i><?php echo $meta_total_images; ?> Photos</p>
					    </div>

					</div>
				</div>

<?php				
			endif;				
		endwhile;
		wp_reset_postdata();
	endif;	
?>

        	</div>
      	</div>


    </div><!-- END PAGE -->   

<?php get_footer(); ?>