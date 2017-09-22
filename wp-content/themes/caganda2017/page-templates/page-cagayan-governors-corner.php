<?php
/*
 * Template Name: Cagayan Governor's Corner Page
 * The Governor's Corner page template file
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
$page_id = get_the_ID();
$primary_thumbnail = get_the_post_thumbnail_url(get_the_ID());
$secondary_thumb_args = $dynamic_featured_image->get_featured_images($page_id);
$secondary_image = "";
foreach ($secondary_thumb_args as $secondary_thumb_args_value) {
  $secondary_image = $secondary_thumb_args_value['full'];
}

$parent_args = array(
  'child_of' => $page_id,
  'sort_order' => 'asc',
  'sort_column' => 'menu_order',
  'post_type' => 'page',
  'post_status' => 'publish',
);
$subpages = get_pages( $parent_args );
  /** 
   * start setting variables
   */
  // Retrieving the popular posts / latest post
?> 
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/animate.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-governors-corner.min.css" />

<!-- PAGE -->
<div class="cag-page-governorscorner cag-page-template">

  <div class="cag-governorscorner-feature">
    <div class="parallax-container">
      <div class="parallax-governors-corner animate-bg"><img src="<?php echo $primary_thumbnail; ?>" /></div>

      <div class="cag-governorscorner-feature-heading">
        <h1 class="animated bounceIn"><?php echo strtoupper(get_the_title()); ?></h1>
        <p class="animated bounceInUp"><?php echo get_the_excerpt(); ?></p>
        <a href="#cag-page-governorscorner-content" class="waves-effect waves-light page-scroll">
          <i class="cagicon-chevron-double-down"></i>
        </a>
      </div>

    </div>
  </div>

  <div class="cag-page-governorscorner-content" id="cag-page-governorscorner-content">

    <div class="row">

      <div class="slider">

        <ul class="slides">
<?php
      if ( count($subpages) > 0 ):
        $i = 1;
        foreach ($subpages as $subpage):
          $subpage_id = $subpage->ID;
?>
          <li>
            <img src="<?php echo get_the_post_thumbnail_url($subpage_id); ?>" /> <!-- random image -->
            <div class="caption center-align">
              <h5 class="light grey-text text-lighten-3"><?php echo $subpage->post_title; ?></h5>
              <a href="<?php echo get_the_permalink($subpage_id); ?>" class="waves-effect waves-light btn blue lighten-1">View more</a>
            </div>
          </li>
<?php
        endforeach;
        wp_reset_query();
      endif;
?>            

        </ul>

      </div>

      <div class="card hoverable cag-mambatext">  

        <div class="cagtextAndpic valign-wrapper">

          <div class="s12 m8 l8">

            <div class="cag-title center">
              <!-- <img src="images/title.png" class="responsive-img" /> -->
            </div>

            <div class="card-content"><?php the_content(); ?></div>
          </div>

          <div class="s12 m4 l4 cag-mambapic">
            <img src="<?php echo $secondary_image; ?>" />
          </div>  

        </div>

      </div>

    </div>

  </div>

</div><!-- END PAGE -->

<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-governors-corner.js"></script>
<?php get_footer(); ?>