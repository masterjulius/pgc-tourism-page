<!-- CSS Fonts -->
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/single-activities.min.css" />
<?php
  /**
   * Variables
   */
  $post_id = get_the_ID();
  $post_title = get_the_title();
  $thumbnail = get_the_post_thumbnail_url();
  $post_permalink  = get_the_permalink();
  $post_date = get_the_date( 'h:i A, F j, Y' );

  $post_thumbnail = !empty($thumbnail) ? $thumbnail : get_stylesheet_directory_uri() . "/images/others/no-thumbnail_1366x800.png";

  // Author Details
  $author_id = get_the_author_meta( 'ID' );
  $author_post_links = get_author_posts_url( $author_id );
  $the_author = get_author_name_info($author_id);

  $author_top_meta_name = rwmb_meta('cag_activities_post_meta_box_author_id', 'text', $post_id);
  $author_full_name = !empty($author_top_meta_name) ? $author_top_meta_name : $the_author;
  $author_dept = get_the_title( get_user_meta($author_id, 'user_department', true) );

?> 
  <!-- PAGE -->
<div class="cag-singlepage-activities page-container-main" id="">
      <div class="container-fluid">

        <div class="parallax-container">

          <div class="parallax cag-activities-single-parallax"><img src="<?php echo $post_thumbnail; ?>"></div>

          <div class="cag-singlepage-activities-header valign-wrapper">
            <div class="row">
              <div class="col s12">
                <div class="chip cag-activities-chip">
                  <span>Activity / Event</span>
                </div>
                <h2 class="header valign"><?php echo $post_title; ?></h2>
              </div>
            </div>
          </div>

        </div>


        <div class="cag-singlepage-activities-body">
          <div class="row">
            <div class="col l8 m7 s12">
              <div class="card hoverable">
                <div class="cag-singlepage-activities-author">
                  <span class="author-img valign-wrapper">

                    <img src="<?php echo get_author_img_url($author_id); ?>" class="z-depth-1 valign" />
                  </span>
                  <span class="author-time">
                    <h5>By <a href="<?php echo $author_post_links; ?>"><?php echo $author_full_name; ?>, <?php echo ucwords(strtolower($author_dept)); ?></a></h5>
                    
                    <h6><i class="cagicon-book-open-page-variant"></i>Published <?php echo $post_date; ?></h6>
                  </span>
                </div>
                <div class="card-content cag-single-main-content">
                <?php echo the_content(); ?>
                </div>

                <!-- <div class="card-action cag-singlepage-activities-comments">
                  <div id="fb-root"></div>
                  <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
                    fjs.parentNode.insertBefore(js, fjs);
                  }(document, 'script', 'facebook-jssdk'));</script>

                  <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="1" data-width="100%"></div>
                </div> -->

              </div>

            </div>


            <div class="col l4 m5 s12">

					<!-- This is the upcoming events -->
		              	
				      <div class="card hoverable cag-singlepage-activities-side cag-page-activities-upcoming">
                		<!-- Sidebar Title -->
                	<div class="cag-sidebar-title">
                  		<a href="!#"><i class="cagicon-calendar"></i> Upcoming Events</a>
                	</div> <!-- End Sidebar Title -->

	                <div class="card-content activities-upcoming">

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

              	<div class="card hoverable cag-singlepage-activities-side">
                
              	<?php
              		$related_articles = get_the_related_articles( get_the_ID() );
              		if ( count($related_articles) > 0 ){
              	?>
              			
                			<!-- Sidebar Title -->
                		<div class="cag-sidebar-title">
                  			<a href="#!"><i class="cagicon-flag"></i> Related Articles</a>
                		</div> <!-- End Sidebar Title -->

                		<div class="card-content">
                  			<ul>
			    <?php

			    			foreach ($related_articles as $related_articles_value):    				

			    ?>
								<li>
			                      	<a href="<?php echo $related_articles_value['permalink']; ?>" class="waves-effect waves-light">
			                        	<span class="activities-side-img valign-wrapper">
			                          		<img src="<?php echo $related_articles_value['thumbnail']; ?>" alt="<?php echo $related_articles_value['title']; ?>" class="z-depth-1 valign" />
			                        	</span>
			                        	<span class="activities-side-text">
			                          		<p><?php echo $related_articles_value['title']; ?></p>
			                        	</span>
			                      	</a>
			                    </li>
			    <?php				
			    			endforeach;	
			    ?>                
                  			</ul>
                		</div>

              	<?php		
              		}
              	?>

              	</div>

              	<div class="card hoverable cag-singlepage-activities-side">

              	<?php
              		$latest_articles = get_the_latest_posts( null, array(get_the_ID()) );
              		if ( count($latest_articles) > 0 ) {
              	?>		
		                <!-- Sidebar Title -->
		                <div class="cag-sidebar-title">
		                  	<a href="#!"><i class="cagicon-flag"></i> Latest Articles</a>
		                </div> <!-- End Sidebar Title -->

		                <div class="card-content">
		                  	<ul>

		        <?php
		        		foreach ($latest_articles as $latest_articles_value):
		        			$thumbnail = $latest_articles_value['thumbnail'];
		        			$thumbnail_url = !empty($thumbnail) ? $thumbnail : get_stylesheet_directory_uri() . "/images/others/no-thumbnail_100x100.png";
		        ?>
		        			<li>
		                      	<a href="<?php echo $latest_articles_value['permalink']; ?>" class="waves-effect waves-light">
		                        	<span class="activities-side-img valign-wrapper">
		                          		<img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $latest_articles_value['title']; ?>" class="z-depth-1 valign" />
		                        	</span>
		                        	<span class="activities-side-text">
		                          		<p><?php echo $latest_articles_value['title']; ?></p>
		                        	</span>
		                      	</a>
		                    </li>
		        <?php			
		        		endforeach;
		        ?>            	
	
		                  	</ul>
		                </div>
              	<?php
              		}
              	?>

              	</div>

              	<div class="card hoverable cag-singlepage-activities-side">
              	<?php
                
              		  $popular_posts_args = get_the_popular_posts();
              		
              	?>

              	</div>



            </div>
          </div>
        </div>

      </div>

</div><!-- END PAGE -->


<?php
$share_title = str_replace( ' ', '%20', get_the_title());
?>

<script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>

  <!-- FAB SHARE -->
<div class="cag-share">
  <div class="fixed-action-btn click-to-toggle">
    <a class="btn-floating waves-effect waves-light btn-large cag-share-btn">
      <i class="cagicon-share-variant"></i>
    </a>
    <ul>
      <li><a href="<?php echo $post_permalink; ?>" class="btn-floating waves-effect waves-light" id="cag-news-post-share-btn-fb"><i class="cagicon-facebook"></i></a></li>
      <li><a href="https://twitter.com/intent/tweet?text=<?php echo $share_title; ?>&amp;url=<?php echo $post_permalink; ?>&amp;via=cagayan.gov.ph" class="btn-floating waves-effect waves-light" target="_blank"><i class="cagicon-twitter"></i></a></li>
      <li><a href="<?php echo $post_permalink; ?>" class="btn-floating waves-effect waves-light" id="cag-news-post-share-btn-gglepls"><i class="cagicon-google-plus"></i></a></li>
      <li><a href="//www.youtube.com" class="btn-floating waves-effect waves-light" id="cag-news-post-share-btn-gglepls"><i class="cagicon-youtube-play"></i></a></li>
    </ul>
  </div>
</div><!-- END FAB SHARE -->

<!--- Social Media Share Integration -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/cag-social-media.js"></script>