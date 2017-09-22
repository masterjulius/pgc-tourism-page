<?php 
/*
 * Template Name: Cagayan Events Page
 * The Events page template file
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-activities.min.css" />

<?php	
 
	/** 
	 * start setting variables
	 */
	// Retrieving the popular posts / latest post
	$rdio_upcoming_meta_id = "cag_activities_post_meta_box_event_type_id";
	$top_story_ret = get_posts(
		array(
			'post_type' => 'events',
			'posts_per_page' => 1,
			'meta_query' => array(
				array(
      				'key' => $rdio_upcoming_meta_id, // this key will change!
      				'compare' => '=',
      				'value' => 'evnt'
      			)
			),
			'meta_key' => 'cag_activities_post_meta_box_date_of_event_id',
			'orderby' => 'meta_value',
			'order' => 'DESC'
		)
	);
	if ( null != $top_story_ret ) {
		$top_id = $top_story_ret[0]->ID;

		$title = $top_story_ret[0]->post_title;
		$content = $top_story_ret[0]->post_content;
		$excerpt = $top_story_ret[0]->post_excerpt;
		$thumbnail = get_the_post_thumbnail_url($top_id);
		$permalink = get_the_permalink($top_story_ret[0]);
		$author_id = $top_story_ret[0]->post_author;
		$author_avatar = get_author_img_url($author_id);
		$author = get_author_name_info($author_id);
		$post_date = get_the_date( 'h:i A, F j, Y',  $top_id);

		// check for thumbnail if empty
		$parallax_thumbnail = !empty($thumbnail) ? $thumbnail : get_stylesheet_directory_uri() . "/images/others/no-thumbnail_1366x800.png";

		$trimmed_content = wp_trim_words( $excerpt, 50, null );
		if ( empty($trimmed_content) ) {
			$trimmed_content = wp_trim_words( $content, 50, null );
		}

	}
	// get author department for the featured article
	// get author department for the featured article
	$author_top_meta_name = rwmb_meta('cag_activities_post_meta_box_author_id', 'text', $top_id);
	$top_author = !empty($author_top_meta_name) ? $author_top_meta_name : $author;
	$author_dept_featured = get_the_title( get_user_meta($author_id, 'user_department', true) );
?>

<!-- PAGE -->
	
	<div class="cag-page-activities cag-page-template">

	    <div class="container-fluid">
	      		
	      		<!-- Start of the Paralax Container -->
	        <div class="parallax-container">
			
	          <div class="parallax cag-activities-page-parallax"><img src="<?php echo $parallax_thumbnail; ?>"></div>

	          <div class="cag-page-activities-header valign-wrapper">
	            <div class="row">
	              <div class="col s12">	
	              
	                <div class="chip cag-activities-chip">
	                  <span>Events</span>
	                </div>
	                <a href="<?php echo $permalink; ?>" class="header valign">
	                  <h2><?php echo $title; ?></h2>
	                </a>

	              </div>
	            </div>
	          </div>

	        </div>
				<!-- End of the Paralax Container -->

				<!-- Start of the Main Contents -->
			<div class="cag-page-activities-body">

					<!-- Start Row -->
	          	<div class="row cag-sticky-parent">

	          			<!-- Start of main column for activities -->
	            	<div class="col l8 m7 s12 cag-sticky-column">
	            		
							<!-- Start NOTE: -->
								<!-- 
								/**
								 * The first data is a custom design
								 * While the second up to below others are the same design
								 */ 
								-->
							<!-- End NOTE: -->


						<div class="card hoverable cag-page-activities-top">
				            <div class="cag-page-activities-author">
				               <span class="author-img valign-wrapper">
				                 <img src="<?php echo $author_avatar; ?>" class="z-depth-1 valign" />
				               </span>
				               <span class="author-time">
				                 <h5>By <a href="<?php echo $latest_post_permalink; ?>"><?php echo $top_author; ?>, <?php echo ucwords(strtolower($author_dept_featured)); ?></a></h5>
				                 <h6><i class="cagicon-book-open-page-variant"></i>Published <?php echo $post_date; ?></h6>
				               </span>
				            </div>
				            <div class="card-content">
				            <?php echo $trimmed_content; ?>
				            </div>
				            <div class="card-action">
				               <a href="<?php echo get_the_permalink($top_id); ?>" class="">Read Full Story<i class="cagicon-arrow-right"></i></a>
				            </div>
				        </div>

				<?php
					// While loop using WP_Query
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$latest_query = new WP_Query(
						array(
							'post_type' => 'events',
							'post__not_in' => array($top_id),
							'posts_per_page' => 6,
							'meta_query' => array(
								array(
				      				'key' => $rdio_upcoming_meta_id, // this key will change!
				      				'compare' => '=',
				      				'value' => 'evnt'
				      			)
							),
							'paged' => $paged,
	      					'page' => $paged
						)
					);
					// echo "<h1>{$latest_query->max_num_pages}</h1>";
					if ($latest_query->have_posts()){
						while ($latest_query->have_posts()) {
							$latest_query->the_post();
							// variables
							$latest_post_title = get_the_title();
							$latest_post_id = get_the_ID();
							$latest_post_author_id = get_the_author_meta( 'ID' );
							$latest_post_permalink = get_the_permalink($latest_post_id);

							$latest_post_content = get_the_content();
							$latest_post_excerpt = get_the_excerpt();
							$latest_post_thumbnail = get_the_post_thumbnail_url($latest_post_id);
							$latest_post_author = get_author_name_info($latest_post_author_id);
							$latest_post_author_avatar = get_author_img_url($latest_post_author_id);
							$latest_post_date = get_the_date( 'h:i A, F j, Y', $latest_post_id );

							// author from meta
							$latest_author_meta_name = rwmb_meta('cag_activities_post_meta_box_author_id', 'text', $latest_post_id);
							$latest_author = !empty($latest_author_meta_name) ? $latest_author_meta_name : $latest_post_author;

							$latest_trimmed_content = wp_trim_words( $latest_post_excerpt, 50, $more = null );
							if ( empty($latest_trimmed_content) ) {
								$latest_trimmed_content = wp_trim_words( $latest_post_content, 50, $more = null );
							}
							
							// get author department for the featured article
							$latest_dept_office = get_the_title( get_user_meta($latest_post_author_id, 'user_department', true) );

				?>			

							<!-- ========== \\\\\\\\\\\\\\\\\\\\ ========== -->
							
						<div class="card hoverable cag-page-activities-article">
				            <div class="card-content">
				               <a href="<?php echo $latest_post_permalink; ?>" class="cag-page-activities-article-title">
				                 <h5><?php echo $latest_post_title; ?></h5>
				               </a>
				               <p><?php echo $latest_trimmed_content; ?></p>
				               <img src="<?php echo $latest_post_thumbnail; ?>">
				            </div>
				            <div class="card-action">
				               <span class="author-img valign-wrapper">
				                 <img src="<?php echo $latest_post_author_avatar; ?>" class="z-depth-1 valign" />
				               </span>
				               <span class="author-time">
				                 <h5><a href="#!"><?php echo $latest_author; ?>, <?php echo ucwords(strtolower($latest_dept_office)); ?></a></h5>
				                 <h6><i class="cagicon-book-open-page-variant"></i>Published <?php echo $latest_post_date; ?></h6>
				               </span>
				            </div>
				        </div>

				<?php
						}	
					}
					$pagination = custom_pagination($latest_query->max_num_pages,"",$paged);

					// if has paging
					if ( $pagination ){

				?>
							<!-- ======================================= -->
							<!-- Pagination -->
						<div class="cag-page-new-pagination-row">
							<div class="col l12 m12 s12">
				          		<div class="cag-page-new-pagination">
					            	<ul class="pagination">
										
								<?php
									foreach ($pagination['paginate_links'] as $paginate_links) {
										echo "<li class='waves-effect'>{$paginate_links}</li>";
									}
								?>		

					            	</ul>
				          		</div>
				        	</div>
				        </div>
					        <!-- End of Pagination -->
							<!-- ======================================= -->
				<?php } ?>
				
		        <?php wp_reset_postdata(); ?>


	            	</div>
	            		<!-- End of main column for activities -->

	            	<!-- Start of Sidebar -->

	            	<div class="col l4 m5 s12 cag-sticky-column">
							
							<!-- This is the upcoming events -->
		              	
						<div class="card hoverable cag-page-activities-side cag-page-activities-upcoming">
                			<!-- Sidebar Title -->
                			<div class="cag-sidebar-title">
                  				<a href="!#"><i class="cagicon-calendar"></i> Upcoming Events</a>
                			</div> <!-- End Sidebar Title -->
	                		<div class="card-content">

		                  		<ul>
		            <?php
		            		// upcoming events query
		            		$today = date('Y-m-d');
		            		$meta_event_id = "cag_activities_post_meta_box_date_of_event_id";
		            		$upcoming_args =   array (
								'post__not_in' => array(get_the_ID()),
								'showposts' => 6,
								'post_type' => 'events',
								'meta_query'=> array(
								    array(
								        'key' => $meta_event_id, // this key will change!
								        'compare' => '>=',
								        'value' => $today,
								        'type' => 'DATE',
								    )
								),
								'meta_key' => $meta_event_id,
								'orderby' => 'meta_value',
								'order' => 'DESC'
							);	            		
		            		$upcoming_query = new WP_Query($upcoming_args);
		            		if ( $upcoming_query->have_posts() ):
		            			while ( $upcoming_query->have_posts() ):
		            				$upcoming_query->the_post();
		            				$cag_activities_post_date = rwmb_meta( $meta_event_id, "type=date", get_the_ID() );
		            				if ( !empty($cag_activities_post_date) ):
		            					$get_event_date = date("M-d-Y", strtotime($cag_activities_post_date));
					                  	$get_splitted_date = explode( "-", $get_event_date );
		            ?>
			            				<li>
			                      			<a href="<?php echo get_the_permalink(); ?>" class="waves-effect waves-light">
				                          		<span class="cag-activities-date-container z-depth-1">
					                            	<h6><?php echo $get_splitted_date[0]; ?></h6>
					                            	<h5><?php echo $get_splitted_date[1]; ?></h5>
				                          		</span>
				                          		<span class="cag-activities-other-text valign-wrapper"><?php echo get_the_title(); ?></span>
			                      			</a>
			                    		</li>
		            <?php
		            				endif;
		            			endwhile;
		            			wp_reset_postdata();
		            		endif;	
		            ?>
		                  		</ul>

	                		</div>
              			</div>

							<!-- This is the end of upcoming events -->



							<!-- Start of Popular Articles -->

		              	<div class="card hoverable cag-page-activities-side">

		                	<!-- Sidebar Title -->
		                	<div class="cag-sidebar-title">
		                  		<a href="#!"><i class="cagicon-flag"></i> Popular Articles</a>
		                	</div> <!-- End Sidebar Title -->

		                	<div class="card-content">
		                  		<ul>
						<?php
							$post_types_array = array("post", "announcements", "trivia", "doodle", "news", "videos");
							$popular_query = new WP_Query(
								array(
									'post_type' => $post_types_array,
									'posts_per_page' => 5,
									'meta_key' => 'wpb_post_views_count',
									'orderby' => 'meta_value_num',
									'order' => 'DESC'
								)
							);

							if ( $popular_query->have_posts() ):
								while( $popular_query->have_posts() ):
									$popular_query->the_post();
									$popular_id = get_the_ID();
									$popular_thumbnail = get_the_post_thumbnail_url($popular_id, array(475,250));
									$popular_thumbnail_url = !empty($popular_thumbnail) ? $popular_thumbnail : $theme_dir . "/images/others/no-thumbnail_475x250.png";
						?>
									<li>
		                      			<a href="<?php echo get_the_permalink(); ?>" class="waves-effect waves-light">
		                        		<span class="activities-side-img valign-wrapper">
		                          			<img src="<?php echo $popular_thumbnail_url; ?>" class="z-depth-1 valign" />
		                        		</span>
		                        		<span class="activities-side-text">
		                          			<p><?php echo get_the_title(); ?></p>
		                        		</span>
		                      			</a>
		                    		</li>
						<?php		
								endwhile;
								wp_reset_postdata();
							endif;
						?>
		                    
		                  		</ul>
		                	</div>

		              	</div>

		              		<!-- End of Popular Articles -->

		            </div>
	            	
					<!-- End of Sidebar -->

				</div>
	       			<!-- End Row  -->
	       	</div>	
				<!-- End of the Main contents -->

	    </div>

	</div>

	<!--- Enquue JS Scripts in this line -->
	<!-- Sticky Sidebar -->

	<!-- Sticky Sidebar -->
    <script src="<?php echo $theme_dir; ?>/js/sticky-kit-1.1.3.min.js"></script>

    <!-- Custom -->
    <script src="<?php echo $theme_dir; ?>/js/cag-activities-init-sticky.min.js"></script>



<?php get_footer(); ?>