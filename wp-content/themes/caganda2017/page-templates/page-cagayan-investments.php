<?php
/*
 * Template Name: Cagayan Investments Page
 * The Investments page template file
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
  /** 
   * start setting variables
   */
  // Retrieving the popular posts / latest post
?> 
<!-- plyr html5 player -->
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-investments.min.css" />

<!-- PAGE -->
<div class="cag-page-investments cag-page-template">

  <div class="parallax-container">
    <div class="parallax-investments"><img src="<?php echo $secondary_image; ?>" /></div>
    <div class="investments-header-title valign-wrapper">
      <a href="#investments-container" class="page-scroll"><h2>Looking for opportunities?</h2></a>
    </div>
  </div>

  <div class="row investments-container" id="investments-container">

    <div class="col s12">
      <div class="container">
            <div class="card">
              <div class="card-content"><?php the_content(); ?></div>
            </div>
      </div>
    </div>

  </div>

</div><!-- END PAGE -->

<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-investments.js"></script>
<?php get_footer(); ?>