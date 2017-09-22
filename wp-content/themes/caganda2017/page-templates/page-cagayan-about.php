<?php 
/*
 * Template Name: Cagayan About Page
 * The About Cagayan page template file
 */
	// get the header
get_header();
$curr_page_id  = get_the_ID();
$parent_args = array(
	'child_of' => $curr_page_id,
	'sort_order' => 'desc',
	'sort_column' => 'post_title',
	'post_type' => 'page',
	'post_status' => 'publish',
);
$pages = get_pages( $parent_args );
?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-about-cagayan.min.css" />

    <!-- Sticky Sidebar -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/sticky-kit-1.1.3.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/sticky-sidebar-about-cagayan.min.js"></script>
<!-- PAGE -->
<div class="cag-page-aboutcagayan cag-page-template">
    <div class="container-fluid">
        <div class="row" data-sticky_parent>

          <div class="cag-about-cagayan-main-contents col l9 m8 s12" data-sticky_column>

<?php

if ( count($pages) > 0 ):
	$i = 1;
	foreach ($pages as $page) {
		$url_title = str_replace(" ", "-", $page->post_title);
		$visibility = $i > 1 ? " inactive" : " active";
		$parent_title = $page->post_title;
?>
		<div class="cag-about-data-container<?php echo $visibility; ?>" data-container="<?php echo strtolower($url_title); ?>" data-index="<?php echo $i; ?>">
<?php			
		$page_id = $page->ID;
		$child_args = array(
			'post_type' => 'page',
			'child_of' => $page_id,
			'parent' => $page_id,
			'sort_order' => 'asc',
			'sort_column' => 'post_title',
			'post_status' => 'publish'
		);
		$get_sub_pages = get_pages( $child_args );
		if ( count($get_sub_pages) > 0 ) {
			foreach ($get_sub_pages as $sub_pages_value) {
				$the_content = apply_filters('the_content', get_post_field('post_content', $sub_pages_value->ID));
				// Load the Child Page
?>
				<!-- About Title -->
				<div class="card">
			        <div class="cag-about-title">
			            <h5><i class="cagicon-map"></i> <?php echo $sub_pages_value->post_title; ?></h5>
			        </div> <!-- End About Title -->
			        <div class="card-content cag-about-content"><?php echo $the_content; ?></div>
			    </div>    		
<?php
				$x++;
			}
			wp_reset_postdata();

		} else {
			$the_content = apply_filters('the_content', get_post_field('post_content', $page->ID));
		// Load the Current Page
?>	
	        <!-- About Title -->
	        <div class="card">
			    <div class="cag-about-title">
			       	<h5><i class="cagicon-map"></i> <?php echo $parent_title; ?></h5>
			    </div> <!-- End About Title -->
			    <div class="card-content cag-about-content"><?php echo $the_content; ?></div>
			</div>      

<?php
		}
		wp_reset_postdata();
		$i++;
?>
		</div>
<?php		
	}

endif;

?>		
			</div>

				<!-- =============================================================================== -->
										<!-- The Sidebar goes here -->
			
			<div class="cag-about-cagayan-main-sidebar col l3 m4 s12" data-sticky_column>
            	<div class="card">
              	<!-- About Title -->
              		<div class="cag-about-title">
                		<h5><i class="cagicon-flag"></i> Contents</h5>
              		</div> <!-- End About Title -->
              		<div class="card-content cag-about-side">
                		<ul>
               <?php
               		$sidebar_args = array(
						'child_of' => $curr_page_id,
						'parent' => $curr_page_id,
						'sort_order' => 'desc',
						'sort_column' => 'post_title',
						'post_type' => 'page',
						'post_status' => 'publish'
					);           			

               		$sidebar_pages = get_pages( $sidebar_args );
               		if ( count($sidebar_pages) > 0 ):
               			$x = 1;
               			foreach ($sidebar_pages as $sidebar_page):
               				$sidebar_page_id = $sidebar_page->ID;
               				$sidebar_url_title = str_replace(" ", "-", $sidebar_page->post_title);
               				$curr_active = $x === 1 ? "active" : "";
               ?> 		
                  			<li class="<?php echo $curr_active; ?>">
                    			<a href="<?php echo strtolower($sidebar_url_title); ?>" class="waves-effect waves-light z-depth-1 hoverable">
                      			<span class="about-side-item">
                        			<img src="<?php echo get_the_post_thumbnail_url($sidebar_page_id); ?>" />
                        			<span class="about-side-text"><?php echo $sidebar_page->post_title; ?></span>
                      			</span>
                    			</a>
                  			</li>

                <?php
                			$x++;
                		endforeach;
                		wp_reset_query();
                	endif;
                ?>  			
                		</ul>
              		</div>
            	</div>
          	</div>

			
				<!-- =============================================================================== -->
										<!-- End ofthe Sidebar here -->

		</div>
	</div>
</div>

	<!-- End Page -->

	<!-- Custom -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/page-cagayan-about.js"></script>

<?php get_footer(); ?>