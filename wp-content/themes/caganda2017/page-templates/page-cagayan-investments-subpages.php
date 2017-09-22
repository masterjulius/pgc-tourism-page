<?php
/*
 * Template Name: Cagayan Investments Sub-Pages Page
 * The Investments Sub-Pages page template file
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
// $page_id = get_the_ID();
// $primary_thumbnail = get_the_post_thumbnail_url(get_the_ID());
// $title = get_the_title($page_id);
// echo "<h1>{$title}</h1>";
  /** 
   * start setting variables
   */
  // Retrieving the popular posts / latest post
?> 
<!-- plyr html5 player -->
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-investments.min.css" />

<!-- PAGE -->
<!-- <pre> -->
<div class="cag-page-investments cag-page-template">

  <div class="row investments-body investments-container">

    <div class="col s12">
      <div class="container">
        <div class="card">
          <div class="card-content"><?php echo get_the_content(); ?></div>
        </div>
      </div>
    </div>

  </div>

</div><!-- END PAGE -->
<!-- </pre> -->

<?php get_footer(); ?>