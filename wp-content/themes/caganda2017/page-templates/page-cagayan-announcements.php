<?php 
/*
 * Template Name: Cagayan Announcements Page
 * The Announcements page template file
 */
	get_header();

	$theme_dir = get_stylesheet_directory_uri();

	$top_story_ret = get_posts(
		array(
			'post_type' => 'announcements',
			'posts_per_page' => 1,
			'orderby' => 'date',
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
		$parallax_thumbnail = !empty($thumbnail) ? $thumbnail : get_stylesheet_directory_uri() . "/images/others/no-image.png";

		$trimmed_content = wp_trim_words( $excerpt, 50, null );
		if ( empty($trimmed_content) ) {
			$trimmed_content = wp_trim_words( $content, 50, null );
		}

	}

	// get author department for the featured article
	$author_top_meta_name = rwmb_meta('cag_announcements_register_meta_box_author_id', 'text', $top_id);
	$top_author = !empty($author_top_meta_name) ? $author_top_meta_name : $author;
	// get author department for the featured article
	$author_dept_featured = get_the_title( get_user_meta($author_id, 'user_department', true) );

?>

<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-announcements.min.css" />

		<!-- PAGE -->
<div class="cag-page-announcement">

    <div class="container-fluid">
      	
		<div class="parallax-container">
          	<div class="parallax cag-announcements-page-parallax"><img src="<?php echo $parallax_thumbnail; ?>"></div>

          	<div class="cag-page-announcement-header valign-wrapper">
            	<div class="row">
              		<div class="col s12">
                		<div class="chip cag-announcement-chip">
                  			<span>Announcement</span>
                		</div>
                		<a href="<?php echo $permalink; ?>" class="header valign">
                  			<h2><?php echo $title; ?></h2>
                		</a>
              		</div>
            	</div>
          	</div>
        </div>  	

          		<!--- Main Contents -->
			<div class="cag-page-announcement-body">

          		<div class="row cag-sticky-parent">

            		<div class="col l9 m8 s12 cag-sticky-column">
            			
						<div class="card hoverable cag-page-announcement-top">
                			<div class="cag-page-announcement-author">
                  				<span class="author-img valign-wrapper">
                    				<img src="<?php echo $author_avatar; ?>" class="z-depth-1 valign" />
                  				</span>
                  				<span class="author-time">
                    				<h5>By <a href="<?php echo $latest_post_permalink; ?>"><?php echo $top_author; ?>, <?php echo ucwords(strtolower($author_dept_featured)); ?></a></h5>
                    				<h6><i class="cagicon-book-open-page-variant"></i>Published <?php echo $post_date; ?></h6>
                  				</span>
                			</div>
                			<div class="card-content"><?php echo $trimmed_content; ?></div>
              			</div>


              	<?php
					// While loop using WP_Query
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$latest_query = new WP_Query(
						array(
							'post_type' => 'announcements',
							'post__not_in' => array($top_id),
							'posts_per_page' => 6,
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

							$latest_trimmed_content = wp_trim_words( $latest_post_excerpt, 50, $more = null );
							if ( empty($latest_trimmed_content) ) {
								$latest_trimmed_content = wp_trim_words( $latest_post_content, 50, $more = null );
							}

							// author from meta
							$latest_author_meta_name = rwmb_meta('cag_activities_post_meta_box_author_id', 'text', $latest_post_id);
							$latest_author = !empty($latest_author_meta_name) ? $latest_author_meta_name : $latest_post_author;

							// get author department for the featured article
							$latest_dept_office = get_the_title( get_user_meta($latest_post_author_id, 'user_department', true) );
				?>				

              			<div class="card hoverable cag-page-announcement-article">

                			<div class="card-content">
                  				<a href="<?php echo $latest_post_permalink; ?>" class="cag-page-announcement-article-title">
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
					// check if you if can paginate
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

		        <?php
		        	}
		        	wp_reset_postdata();

	            ?>	

            		</div>


					<div class="col l3 m4 s12 cag-sticky-column">

              			<div class="card hoverable cag-page-announcement-side">

			                <!-- Sidebar Title -->
			                <div class="cag-sidebar-title">
			                  <a href="#!"><i class="cagicon-flag"></i> Category</a>
			                </div> <!-- End Sidebar Title -->

                			<div class="card-content">
                  				<ul>

                    				<li>
                      					<a href="#!" class="waves-effect waves-light"><i class="cagicon-book-open-variant"></i>Class Suspentions</a>
                    				</li>
                    				<li>
                      					<a href="#!" class="waves-effect waves-light"><i class="cagicon-fiesta"></i>Special Holidays</a>
                    				</li>
                    				<li>
                      					<a href="#!" class="waves-effect waves-light"><i class="cagicon-book-open-variant"></i>Class Suspentions</a>
                    				</li>
                    				<li>
                      					<a href="#!" class="waves-effect waves-light"><i class="cagicon-fiesta"></i>Special Holidays</a>
                    				</li>

                  				</ul>
                			</div>

              			</div>

            		</div>


            	</div>

            </div>		
          		<!-- End of Main Contents -->


    </div>

</div>

<?php get_footer(); ?>