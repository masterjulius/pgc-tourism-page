<?php
/*
 * Template Name: Cagayan POPE Page
 * The Provincial Office for People Empowerment page template file
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
?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-pope.min.css" />
<!-- PAGE -->
    <div class="cag-page-pope cag-page-template">

      	<div class="cag-pope-header">

        	<div class="parallax-container">
          		<div class="parallax-pope"><img src="<?php echo $primary_thumbnail; ?>"></div>
        	</div>

        	<div class="cag-pope-head valign-wrapper">
          		<div class="cag-pope-head-logo">
            		<a href="#cag-pope-content" class="page-scroll">
              			<img src="<?php echo $secondary_image; ?>" alt="" />
              			<p>Provincial Office for People Empowerment</p>
            		</a>
          		</div>
        	</div>

      	</div>      

      	<div class="cag-pope-content" id="cag-pope-content">

        	<div class="container">

          		<div class="row">

            		<div class="col s12">

              			<div class="card">

                			<div class="card-content">
                  
                				<?php echo get_the_content(); ?>  

                  				<!-- <img src="images/chart.png" class="img-chart" alt=""> -->
					
								<!-- Static Element Temporary -->

				                  	<div class="cag-pope-chart">

					                    <h6>Office of the Provincial Governor</h6>
					                    <h4><i class="cagicon-arrow-down"></i></h4>

					                    <h6>Head/Provincial EO</h6>
					                    <h4><i class="cagicon-arrow-down"></i></h4>

					                    <h6>Validation</h6>
					                    <h6 class="dotted">- - -</h6>
					                    <h6>Community Organizing</h6>
					                    <h6 class="dotted">- - -</h6>
					                    <h6>Review and Impact <br> Monitoring</h6>
					                    <br>

					                    <h6 class="arrow"><i class="cagicon-arrow-down"></i></h6><h6 class="dotted">- - - - - - - - - - - -</h6>
					                    <h6>Office Personal</h6><br>

					                    <h6>Lead EO</h6>
					                    <h4><i class="cagicon-arrow-down"></i></h4>

					                    <h6>Municipal EO</h6>
					                    <h4><i class="cagicon-arrow-down"></i></h4>

					                    <h6>Empowermet Officer</h6>

				                  	</div>

                			</div>

              			</div>

            		</div>

          		</div>

        	</div>



      	</div>


    </div><!-- END PAGE -->
    <script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-pope.min.js"></script>
<?php get_footer(); ?>