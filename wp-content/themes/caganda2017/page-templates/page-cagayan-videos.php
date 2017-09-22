<?php
/*
 * Template Name: Cagayan Videos Page
 * The Videos page template file
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
$page_id = get_the_ID();
$primary_thumbnail = get_the_post_thumbnail_url(get_the_ID());

  /** 
   * start setting variables
   */
  // Retrieving the popular posts / latest post
?>
  
<!-- plyr html5 player -->
<link rel="stylesheet" type="text/css" href="//cdn.plyr.io/2.0.10/plyr.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-videos.min.css" />

<?php
  $featured_video_ret = get_posts(
    array(
      'post_type' => 'videos',
      'meta_query' => array(
        array(
          'key' => 'cag_videos_post_meta_box_featured_video_id',
          'compare' => '=',
          'value' => '1',
          'type' => 'BINARY'
        )
      ),
      'posts_per_page' => 1,
      'orderby' => 'date',
      'order' => 'DESC'
    )
  );
  if ( null != $featured_video_ret ) {
    $top_id = $featured_video_ret[0]->ID;
    $title = $featured_video_ret[0]->post_title;
    $content = $featured_video_ret[0]->post_content;
    $excerpt = $featured_video_ret[0]->post_excerpt;
    $thumbnail = get_the_post_thumbnail_url($top_id);
    $permalink = get_the_permalink($featured_video_ret[0]);
    $author_id = $featured_video_ret[0]->post_author;
    $author_avatar = get_author_img_url($author_id);
    $author = get_author_name_info($author_id);
    $post_date = get_the_date( 'h:i A, F j, Y',  $top_id);

    $post_content = apply_filters('the_content', $content);

    // check for thumbnail if empty
    $featured_video_url = '';
    if ( !empty(get_post_meta( $top_id, "cag_videos_post_meta_box_video_embed_id" ) && get_post_meta( $top_id, "cag_videos_post_meta_box_video_embed_id" )) ):
        $featured_video_url = get_post_meta( $top_id, 'cag_videos_post_meta_box_video_embed_id', true );
    endif;
            
    $split_embed_URL = explode("/", $featured_video_url);
    $cag_videos_embed_type = 'youtube';
    if ( $split_embed_URL[2] === 'vimeo.com' || $split_embed_URL[2] === 'vimeo' ) {
      $cag_videos_embed_type = 'vimeo';
    }

    $trimmed_content = wp_trim_words( $excerpt, 50, null );
    if ( empty($trimmed_content) ) {
      $trimmed_content = wp_trim_words( $content, 50, null );
    }

  } else {

    $latest_post_single_ret = get_posts(
      array(
        'post_type' => 'videos',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
      )
    );

    if ( null != $latest_post_single_ret ) {
      $top_id = $latest_post_single_ret[0]->ID;
      $title = $latest_post_single_ret[0]->post_title;
      $content = $latest_post_single_ret[0]->post_content;
      $excerpt = $latest_post_single_ret[0]->post_excerpt;
      $thumbnail = get_the_post_thumbnail_url($top_id);
      $permalink = get_the_permalink($latest_post_single_ret[0]);
      $author_id = $latest_post_single_ret[0]->post_author;
      $author = get_author_name_info($author_id);
      $author_avatar = get_author_img_url($author_id);
      $post_date = get_the_date( 'h:i A, F j, Y',  $top_id);

      $post_content = apply_filters('the_content', $content);

      // check for thumbnail if empty
      $featured_video_url = '';
      if ( !empty(get_post_meta( $top_id, "cag_videos_post_meta_box_video_embed_id" ) && get_post_meta( $top_id, "cag_videos_post_meta_box_video_embed_id" )) ):
        $featured_video_url = get_post_meta( $top_id, 'cag_videos_post_meta_box_video_embed_id', true );
      endif;
            
      $split_embed_URL = explode("/", $featured_video_url);
      $cag_videos_embed_type = 'youtube';
      if ( $split_embed_URL[2] === 'vimeo.com' || $split_embed_URL[2] === 'vimeo' ) {
        $cag_videos_embed_type = 'vimeo';
      }

      $trimmed_content = wp_trim_words( $excerpt, 50, null );
      if ( empty($trimmed_content) ) {
        $trimmed_content = wp_trim_words( $content, 50, null );
      }

    }

  }

?>

<!-- PAGE -->
<div class="cag-page-videos">

  <div class="videos-feature">

    <div class="row">

      <div class="col l9 m8 s12">

        <div class="videos-top">

          <div class="chip videos-chip">
            <span>Top Video</span>
          </div>

          <div data-type="<?php echo $cag_videos_embed_type; ?>" data-video-id="<?php echo $featured_video_url; ?>" class="video-wrapper z-depth-2"></div>

            <h4><?php echo $title; ?></h4>
            <?php echo $post_content; ?>

        </div>

      </div>

      <div class="col l3 m4 s12">

        <div class="videos-side">

          <div class="chip videos-chip">
            <span>Featured Videos</span>
          </div>

          <ul class="videos-side-items">

<?php
  $featured_video_list = new WP_Query(
    array(
      'post_type' => 'videos',
      'post__not_in' => array($top_id),
      'meta_query' => array(
        array(
          'key' => 'cag_videos_post_meta_box_featured_video_id',
          'compare' => '=',
          'value' => '1',
          'type' => 'BINARY'
        )
      ),
      'posts_per_page' => 4,
      'orderby' => 'date',
      'order' => 'DESC'
    )
  );

  if ( $featured_video_list->have_posts() ):
    while ( $featured_video_list->have_posts() ):
      $featured_video_list->the_post();
      $featured_video_list_id = get_the_ID();

      $feat_vid_list_thumb = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : $theme_dir . "/images/others/no-thumbnail_500x280.png";
?>

            <li>
              <a href="<?php echo get_the_permalink(); ?>" class="waves-effect waves-light">
                <span class="z-depth-1">
                  <button><i class="cagicon-play"></i></button>
                  <img src="<?php echo $feat_vid_list_thumb; ?>" alt="" />
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
  $other_vids_query = new WP_Query(
    array(
      'post_type' => 'videos',
      'meta_query' => array(
        array(
          'key' => 'cag_videos_post_meta_box_featured_video_id',
          'compare' => '=',
          'value' => '0',
          'type' => 'BINARY'
        )
      ),
      'orderby' => 'date',
      'order' => 'DESC'
    )
  );
  if ( $other_vids_query->have_posts() ):
    while ( $other_vids_query->have_posts() ):
      $other_vids_query->the_post();
      $other_vids_id = get_the_ID();
      $other_vids_thumb = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url($other_vids_id, array(500, 263)) : $theme_dir . "/images/others/no-thumbnail_500x280.png";
?>    

      <div class="col l3 m4 s6">
        <a href="<?php echo get_the_permalink(); ?>" class="waves-effect waves-light">
          <span class="z-depth-1">
            <button><i class="cagicon-play"></i></button>
            <img src="<?php echo $other_vids_thumb; ?>" alt="" />
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
<script type="text/javascript" src="//cdn.plyr.io/2.0.10/plyr.js"></script>
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-videos.js"></script>
<?php get_footer(); ?>