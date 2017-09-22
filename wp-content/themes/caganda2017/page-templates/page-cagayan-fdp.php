<?php 
/*
 * Template Name: Cagayan FDP Page
 */
get_header();
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/page-fdp.min.css" />

<!-- PAGE -->
<div class="cag-page-fdp cag-page-template">
  <div class="container-fluid">


      <div class="row cag-sticky-parent">


          	<div class="col l3 m3 s12 cag-fdp-toc cag-sticky-column">
            	<ul class="collapsible" data-collapsible="expandable">
              		<div class="fdp-collapsible-header"><h5>Full Dislosure Policy</h5></div>
				
			<?php
				$args = array(
					'post_type' => 'fdp-files',
					'orderby' => 'date',
					'order' => 'DESC',
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ):
					while ( $query->have_posts() ):
						$query->the_post();
						$title = get_the_title();
						$url_title = str_replace(" ", "-", $title);
			?>
						<li>
	              <div class="collapsible-header active" data-scroll-id="fdp-<?php echo $url_title; ?>"><i class="cagicon-briefcase"></i><?php echo $title; ?></div>
	              <div class="collapsible-body">
	                <ul class="collection">
			<?php
				$cag_meta_id_annual = 'cag_fdp_files_widget_register_meta_box_fdp_files_id_annual';
				$cag_meta_id_quarterly = 'cag_fdp_files_widget_register_meta_box_fdp_files_id_quarterly';
				$args = 'type=file';
				$cag_meta_annual = rwmb_meta( $cag_meta_id_annual, $args, get_the_ID() );
				$cag_meta_quarterly = rwmb_meta( $cag_meta_id_quarterly, $args, get_the_ID() );

				if ( !empty( $cag_meta_annual ) ) {
					
					echo "<li> <a href='#fdp-annual-{$url_title}' class='collection-item'><i class='cagicon-file-pdf'></i> Annual Documents</a> </li>";

				}

				if ( !empty( $cag_meta_quarterly ) ) {
					
					echo "<li> <a href='#fdp-quarter-{$url_title}' class='collection-item'><i class='cagicon-file-pdf'></i> Quarterly Documents</a> </li>";

				}
			?>
      		
	                </ul>
	              </div>
	          </li>
			<?php			
					endwhile;
					wp_reset_postdata();
				endif;	
			?>		

            	</ul>

          	</div> <!-- End of sticky sidebar column -->
          
          <!-- Start of the Main Contents -->         

          <div class="col l9 m9 s12 cag-fdp-content cag-sticky-column">

<?php
        $main_query = new WP_Query(
          array(
            'post_type' => 'fdp-files',
            'orderby' => 'date',
            'order' => 'DESC',
          )
        );
        if ( $main_query->have_posts() ):
          while ( $main_query->have_posts() ):
            $main_query->the_post();
            $title = get_the_title();
            $url_title = str_replace(" ", "-", $title);
            $thumbnail = get_the_post_thumbnail_url();

            // metabox details
            $cag_meta_id_annual = 'cag_fdp_files_widget_register_meta_box_fdp_files_id_annual';
            $cag_meta_id_quarterly = 'cag_fdp_files_widget_register_meta_box_fdp_files_id_quarterly';
            $args = 'type=file';
            $cag_meta_annual = rwmb_meta( $cag_meta_id_annual, $args, get_the_ID() );
            $cag_meta_quarterly = rwmb_meta( $cag_meta_id_quarterly, $args, get_the_ID() );
?>
            <div id="fdp-year-<?php echo $url_title; ?>">

              <h4 id="fdp-calendar-<?php echo $url_title; ?>"><?php echo $title; ?></h4>

                <!-- Start of annual documents -->
              <div id="fdp-annual-<?php echo $url_title; ?>" class="row scrollspy">

          <?php if ( !empty($cag_meta_annual) ): ?>       
                <h5>Annual Documents</h5>
          <?php foreach ($cag_meta_annual as $annual_value): ?>
          <?php $pdf_annual_title = $annual_value['title']; ?>

                <div class="col l3 m4 s6 cag-page-fdp-thumb">
                  <div class="card">
                    <div class="card-image">
                      <img src="<?php echo $thumbnail; ?>">
                    </div>
                    <div class="card-content">
                      <div class="fixed-action-btn vertical click-to-toggle fdp-btn-action">
                          <a class="btn-floating fdp-btn-dots">
                            <i class="cagicon-dots-vertical"></i>
                          </a>
                          <ul>
                            <li>
                              <a href="<?php echo $annual_value['url']; ?>" class="btn-floating waves-effect waves-light red tooltipped" data-position="right" data-delay="50" data-tooltip="View File"><i class="cagicon-file-pdf"></i></a>
                            </li>
                            <li>
                              <a href="<?php echo $annual_value['url']; ?>" download="<?php echo $pdf_annual_title; ?>" class="btn-floating waves-effect waves-light blue tooltipped" data-position="right" data-delay="50" data-tooltip="Download File"><i class="cagicon-download"></i></a>
                            </li>
                          </ul>
                        </div>
                      <span class="card-title"><i class="cagicon-file-pdf"></i> <?php echo ucwords($pdf_annual_title); ?></span>
                    </div>
                  </div>
                </div>
          <?php endforeach; ?>      

          <?php endif; ?>      
                
              </div>
                <!-- End of Annual Documents -->


              <div id="fdp-quarter-<?php echo $url_title; ?>" class="row scrollspy">
                <h5>Quarterly Documents</h5>
          <?php if ( !empty($cag_meta_annual) ): ?>
          <?php foreach ($cag_meta_quarterly as $quarterly_value): ?>
          <?php $pdf_quarterly_title = $quarterly_value['title']; ?>
                <div class="col l3 m4 s6 cag-page-fdp-thumb">
                  <div class="card">
                    <div class="card-image">
                      <img src="<?php echo $thumbnail; ?>">
                    </div>
                    <div class="card-content">
                      <div class="fixed-action-btn vertical click-to-toggle fdp-btn-action">
                          <a class="btn-floating fdp-btn-dots">
                            <i class="cagicon-dots-vertical"></i>
                          </a>
                          <ul>
                            <li>
                              <a href="<?php echo $quarterly_value['url']; ?>" class="btn-floating waves-effect waves-light red"><i class="cagicon-file-pdf"></i></a>
                            </li>
                            <li>
                              <a href="<?php echo $quarterly_value['url']; ?>" download="<?php echo $pdf_quarterly_title; ?>" class="btn-floating waves-effect waves-light blue"><i class="cagicon-download"></i></a>
                            </li>
                          </ul>
                        </div>
                      <span class="card-title"><i class="cagicon-file-pdf"></i> <?php echo ucwords($pdf_quarterly_title); ?></span>
                    </div>
                  </div>
                </div>
          <?php endforeach; ?>      
          <?php endif; ?>      

              </div>


            </div>
<?php            
          endwhile;
          wp_reset_postdata(); 
        endif; 
?>

          </div>


    </div>

  </div>

</div><!-- END PAGE -->

<!-- The transparent navbar becomes opaque when scrolled -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/init.min.js"></script>
<!-- Sticky Sidebar -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sticky-kit-1.1.3.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sticky-sidebar.min.js"></script>

<!-- Scroll Spy -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sidebar-scroll.min.js"></script>

<?php

get_footer();

?>