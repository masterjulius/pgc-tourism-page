<?php
/*
 * Template Name: Cagayan QRT Page
 * The Quick Response Team Page page template file
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
$page_id = get_the_ID();
$page_thumbnail = get_the_post_thumbnail_url(get_the_ID());
?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-qrt.min.css" />
<!-- PAGE -->
    <div class="cag-page-qrt cag-page-template">

      	<div class="cag-qrt-header">

        	<div class="parallax-container">
          		<div class="parallax-qrt"><img src="<?php echo $page_thumbnail; ?>"></div>
        	</div>

        	<div class="cag-qrt-head valign-wrapper">

          		<div class="cag-qrt-head-text">

            		<h1>Quick Response Team</h1>
            		<p>24/7 free service in all types of emergency cases.</p>
            		<a href="#cag-qrt-contact" class="waves-effect waves-light btn green page-scroll">
              			<i class="cagicon-phone-classic left"></i>
              				Contact Numbers
            		</a>

          		</div>

        	</div>

      	</div>

      	<div class="cag-qrt-contact" id="cag-qrt-contact">

	        <div class="card">

	          	<div class="card-content">
	        <?php echo the_content(); ?>
	          	</div>

	        </div>


      	</div>


    </div><!-- END PAGE -->

    <script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-qrt.min.js"></script>
<?php get_footer(); ?>