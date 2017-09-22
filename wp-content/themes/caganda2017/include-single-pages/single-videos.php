<!-- plyr html5 player -->
<link rel="stylesheet" type="text/css" href="//cdn.plyr.io/2.0.10/plyr.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/single-videos.min.css" />
<?php
  /**
   * Variables
   */
$theme_dir = get_stylesheet_directory_uri();

$post_id = get_the_ID();
$post_title = get_the_title();
$thumbnail = get_the_post_thumbnail_url();
$post_permalink  = get_the_permalink();
$post_date = get_the_date( 'h:i A, F j, Y' );

$post_thumbnail = !empty($thumbnail) ? $thumbnail : $theme_dir . "/images/others/no-thumbnail_1366x800.png";

// video details
// check for thumbnail if empty
$featured_video_url = '';
if ( !empty(get_post_meta( $post_id, "cag_videos_post_meta_box_video_embed_id" ) && get_post_meta( $post_id, "cag_videos_post_meta_box_video_embed_id" )) ):
	$featured_video_url = get_post_meta( $post_id, 'cag_videos_post_meta_box_video_embed_id', true );
endif;

$split_embed_URL = explode("/", $featured_video_url);
$cag_videos_embed_type = 'youtube';
if ( $split_embed_URL[2] === 'vimeo.com' || $split_embed_URL[2] === 'vimeo' ) {
    $cag_videos_embed_type = 'vimeo';
}

?>
<!-- PAGE -->
<div class="cag-page-videos">

    <div class="videos-feature">

        <div class="row">

          	<div class="col l9 m8 s12">

            	<div class="videos-top">
	              	<div class="chip videos-chip">
	                	<span>Now Playing</span>
	              	</div>
	              	<div data-type="<?php echo $cag_videos_embed_type; ?>" data-video-id="<?php echo $featured_video_url; ?>" class="video-wrapper z-depth-2"></div>
	              	<h4><?php echo get_the_title(); ?></h4>
	              	<?php echo the_content(); ?>
            	</div>

        	</div>

          	<div class="col l3 m4 s12">

            	<div class="videos-side">

<?php
	$tags = wp_get_post_tags($post_id);
	$array_tags = array();

	if ( $tags ):

		for ($i=0; $i <= count($tags); $i++) { 
			array_push($array_tags, $tags[$i]->term_id);
		}

		$related_vids_query = new WP_Query(
			array(
				'post_type' => 'videos',
				'tag__in' => $array_tags,
				'post__not_in' => array($post_id),
				'caller_get_posts'=> 1,
				'orderby' => 'date',
				'order' => 'DESC'
			)
		);
		if ( $related_vids_query->have_posts() ):
?>
              		<div class="chip videos-chip">
                		<span>Related Videos</span>
              		</div>

              		<ul class="videos-side-items">
<?php
			while ( $related_vids_query->have_posts() ):
				$related_vids_query->the_post();
				$related_vids_id = get_the_ID();
				$related_vids_thumb = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url($related_vids_id, array(500, 263)) : $theme_dir . "/images/others/no-thumbnail_500x280.png";
?>
		                <li>
		                  	<a href="<?php echo get_the_permalink(); ?>" class="waves-effect waves-light">
		                    	<span class="z-depth-1">
		                      		<button><i class="cagicon-play"></i></button>
		                      		<img src="<?php echo $related_vids_thumb; ?>" alt="">
		                      		<p><?php echo get_the_title(); ?></p>
		                    	</span>
		                  	</a>
		                </li>
<?php
			endwhile;
			wp_reset_postdata();
?>
					</ul>
<?php
		else:
?>
			<div class="chip videos-chip">
                <span>No Related Videos</span>
            </div>
<?php			
		endif;
	else:
?>
		<div class="chip videos-chip">
            <span>No Related Videos</span>
        </div>
<?php		
	endif;
?>           		

            	</div>

          	</div>

        </div>
		

    </div>

    <div class="videos-body">

        <div class="row">

          	<div class="col s12">
            	<div class="chip videos-chip">
              		<span>More Videos</span>
            	</div>
          	</div>

        </div>

        <div class="row videos-body-more">
<?php
	$more_vids_query = new WP_Query(
		array(
			'post_type' => 'videos',
			'post__not_in' => array($post_id),
			'orderby' => 'date',
      		'order' => 'DESC'
		)
	);
	if ( $more_vids_query->have_posts() ):
		while ( $more_vids_query->have_posts() ):
			$more_vids_query->the_post();
			$more_vids_id = get_the_ID();
			$more_vids_thumb = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url($other_vids_id, array(500, 263)) : $theme_dir . "/images/others/no-thumbnail_500x280.png";
?>

          	<div class="col l3 m4 s6">
            	<a href="<?php echo get_the_permalink(); ?>" class="waves-effect waves-light">
              		<span class="z-depth-1">
                		<button><i class="cagicon-play"></i></button>
                		<img src="<?php echo $more_vids_thumb; ?>" alt="" />
                		<p><?php echo get_the_title(); ?></p>
              		</span>
            	</a>
          	</div>
<?php
		endwhile;
		wp_reset_postdata();
	endif;	
?>          	

        </div>
    </div>

</div><!-- END PAGE -->

<!-- plyr javascript CDN -->
<script src="//cdn.plyr.io/2.0.10/plyr.js"></script>
<script src="<?php echo $theme_dir; ?>/js/single-videos.js"></script>