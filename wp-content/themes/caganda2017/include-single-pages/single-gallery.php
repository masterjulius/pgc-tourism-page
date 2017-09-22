<?php	

	$post_id  = get_the_ID();	

	$cag_meta_id = "cag_gallery_widget_register_meta_box_gallery_images_id";
	$args = "type=image";
	$cag_meta_box_images = rwmb_meta( $cag_meta_id, $args, $post_id );

	if ( !empty( $cag_meta_box_images ) ) {
		$child_theme_dir = get_stylesheet_directory_uri();
?>
		<!--- CSS/JS -->
		<!-- lightGallery -->
	    <link rel="stylesheet" href="<?php echo $child_theme_dir; ?>/css/justifiedGallery.min.css" />
	    <link rel="stylesheet" href="<?php echo $child_theme_dir; ?>/lightgallery/css/lightgallery.min.css" />
		<!--- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo $child_theme_dir; ?>/css/single-gallery.min.css" />

		<!-- PAGE -->
	    <div class="cag-page-gallery-single">
			
			<!-- Paralax Sections Here -->
			<div class="cag-gallery-album-header">

	        	<div class="parallax-container">
	          		<div class="parallax cag-single-gallery"><img src="<?php echo get_the_post_thumbnail_url($post_id); ?>"></div>
	          		<div class="gallery-header-title">

	            		<div class="gallery-header-img">
	        <?php
			        	// Conditional line for meta values from meta box
		        		// Author Details
		        		$author_id = get_the_author_meta( 'ID' );
		        		$profile_image = get_author_img_url( $author_id );
			        	$meta_gallery_gallery_provider_id = "cag_gallery_widget_register_meta_box_directory_id";
						$meta_gallery_gallery_provider = rwmb_meta( $meta_gallery_gallery_provider_id, "type=text", $post_id );
						// post type page infos
						$post_type = get_post_type();
						$post_type_page_link = get_permalink( get_page_by_title($post_type) );

						if ( !empty( $meta_gallery_gallery_provider ) ) {
							$profile_image = get_the_post_thumbnail_url($meta_gallery_gallery_provider);
						}
	        ?>    		
	            			<img src="<?php echo $profile_image; ?>" alt="<?php echo $profile_image; ?>" />
	            		</div>

	            		<div class="gallery-header-text">

	              			<h3><?php echo get_the_title($post_id); ?></h3>
	              			<h5><?php echo count($cag_meta_box_images); ?> Photos &bull; <?php echo get_the_date(); ?></h5>
	              			<a href="<?php echo $post_type_page_link; ?>" class="waves-effect waves-light btn"><i class="cagicon-gallery left"></i> More Albums</a>
	              			<a href="#cag-gallery-thumbnails-single" class="waves-effect waves-light btn page-scroll"><i class="cagicon-book-open-page-variant right"></i> Browse Photos</a>

	            		</div>

	          		</div>
	        	</div>


	      	</div>

	    	<!-- Images Here -->
			<div class="cag-gallery-thumbnails-single" id="cag-gallery-thumbnails-single">

		        <div class="gallery-selector-single" id="gallery-selector-single">
		        	<!-- // Loop -->
<?php
					foreach ($cag_meta_box_images as $cag_meta_box_images_value) {
						$title = $cag_meta_box_images_value["title"]; // title/name
						$full_url = $cag_meta_box_images_value["full_url"]; // full url without size/original image
						$url = $cag_meta_box_images_value["url"]; // full url with size
						$desc = $cag_meta_box_images_value["description"]; // description
?>
						<div class="gallery-thumb-single waves-effect waves-light" data-src="<?php echo $full_url; ?>" data-sub-html="<h4><?php echo $title; ?></h4><p><?php echo $desc; ?></p>" data-download-url="false">
		            		<img src="<?php echo $full_url; ?>" alt="<?php echo $title ?>" />
		          		</div>

<?php						
					}
?>

		        </div>

	        </div>

	    </div>
	    <!-- END PAGE -->

	    	<!-- Plugin JavaScript -->
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/js/jquery.justifiedGallery.min.js"></script>
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/js/jquery.easing.min.js"></script>

		<!-- Plugins for lightgallery -->
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/lightgallery/js/lightgallery.min.js"></script>
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/lightgallery/js/lg-fullscreen.min.js"></script>
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/lightgallery/js/lg-thumbnail.min.js"></script>
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/lightgallery/js/lg-autoplay.min.js"></script>
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/lightgallery/js/lg-zoom.min.js"></script>
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/lightgallery/js/lg-hash.min.js"></script>
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/lightgallery/js/lg-pager.min.js"></script>
		<!-- Extra Plugin For LightGallery-->
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/js/picturefill.min.js"></script>
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/js/jquery.mousewheel.min.js"></script>

		<!-- Custom Scripts -->
		<script type="text/javascript" src="<?php echo $child_theme_dir; ?>/js/single-gallery.js"></script>

<?php

	}

?>