<?php
/*
 * Template Name: Cagayan Governor's Corner Sub Page
 * The Governor's Corner Sub Page template file
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
$page_id = get_the_ID();
$parent_id = wp_get_post_parent_id( $page_id );
$primary_thumbnail = get_the_post_thumbnail_url(get_the_ID());
$secondary_thumb_args = $dynamic_featured_image->get_featured_images($page_id);
$secondary_image = $primary_thumbnail;
foreach ($secondary_thumb_args as $secondary_thumb_args_value) {
  $secondary_image = $secondary_thumb_args_value['full'];
}
// echo "<h1>". get_the_title($parent_id) ."</h1>";

  /** 
   * start setting variables
   */
  // Retrieving the popular posts / latest post
?> 
<!-- plyr html5 player -->
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-governors-corner.min.css" />

<!-- PAGE -->
<div class="cag-page-governorscorner cag-page-template">

  <div class="cag-governorscorner-feature">
    <div class="parallax-container">
      <div class="parallax-governors-corner-subpage animate-bg"><img src="<?php echo get_the_post_thumbnail_url($parent_id); ?>" /></div>
      <div class="cag-governorscorner-feature-heading">
        <h1 class="animated bounceIn"><?php echo get_the_title($parent_id); ?></h1>
        <p class="animated bounceInUp"><?php echo get_the_excerpt($parent_id); ?></p>
        <a href="#cag-page-governorscorner-single-content" class="waves-effect waves-light page-scroll">
          <i class="cagicon-chevron-double-down"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="cag-page-governorscorner-single-content" id="cag-page-governorscorner-single-content">

    <div class="cag-governorscorner-single-content">

      <div class="row">

        <div class="col s12 m8 l9">

          <div class="card hoverable cag-single-govcorner-card">

            <div class="card-image">
              <img class="materialboxed" src="<?php echo $primary_thumbnail; ?>" />
              <span class="card-title"><b><?php echo get_the_title(); ?></b></span>
            </div>

            <div class="card-content cag-single-govcorner"><?php echo the_content(); ?></div>

          </div>

        </div>

        <div class="col hide-on-small-only m4 l3">
          <ul class="section table-of-contents">
        <?php
          $parent_args = array(
            'child_of' => $parent_id,
            'sort_order' => 'asc',
            'sort_column' => 'menu_order',
            'post_type' => 'page',
            'post_status' => 'publish',
          );
          $subpages = get_pages( $parent_args );
          if ( count( $subpages ) > 0 ):
            foreach ($subpages as $subpage):
              $subpage_id = $subpage->ID;
        ?>
              <li><a href="<?php echo get_the_permalink($subpage_id); ?>"><?php echo get_the_title($subpage_id); ?></a></li>
        <?php
            endforeach;
            wp_reset_query();
          endif; 
        ?>    
          </ul>
        </div>

      </div>

    </div>

  </div>

</div><!-- END PAGE -->

<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-governors-corner.js"></script>
<?php get_footer(); ?>