<?php
/*
 * Template Name: Cagayan Social Page
 * The Social page template file under whats new or first 100 days
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
$page_id = get_the_ID();
$page_thumbnail = get_the_post_thumbnail_url(get_the_ID());
$secondary_thumb_args = $dynamic_featured_image->get_featured_images($page_id);
$secondary_image = "";
foreach ($secondary_thumb_args as $secondary_thumb_args_value) {
  $secondary_image = $secondary_thumb_args_value['full'];
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-100-days.min.css" />
  <!-- PAGE -->
  <div class="cag-page-100days cag-page-template">

    <div class="cag-100days-header">

      <div class="parallax-container">

        <div class="parallax-100days">

          <img src="<?php echo $secondary_image; ?>" />

        </div>

      </div>

    </div>

    <div class="cag-100days-content" id="cag-100days-content">
      <div class="container">
        <?php echo the_content(); ?>
      </div>
    </div>


  </div><!-- END PAGE -->

  <script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-100-days.min.js"></script>
<?php get_footer(); ?>