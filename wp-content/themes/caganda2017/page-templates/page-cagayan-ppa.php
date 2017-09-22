<?php 
/*
 * Template Name: Cagayan Programs, Projects, Activities Page
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-bids-and-awards.min.css" />

<!-- PAGE -->
<div class="cag-page-bids-and-awards cag-page-template">
  <div class="container-fluid">


      <div class="row cag-sticky-parent">


          	<div class="col l3 m3 s12 cag-bids-and-awards-toc cag-sticky-column">
            	<ul class="collapsible" data-collapsible="expandable">
              		<div class="bids-and-awards-collapsible-header"><h5>Bids and Awards</h5></div>
				
			<?php
				$args = array(
					'post_type' => 'bids-and-awards',
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
	              <div class="collapsible-header active" data-scroll-id="bids-and-awards-<?php echo $url_title; ?>"><i class="cagicon-briefcase"></i><?php echo $title; ?></div>
	              <div class="collapsible-body">
	                <ul class="collection">
			<?php
				$cag_meta_id = 'cag_bids_and_awards_widget_register_meta_box_bids_and_awards_id';
				$args = 'type=file';
				$cag_meta_files = rwmb_meta( $cag_meta_id, $args, get_the_ID() );

				if ( !empty( $cag_meta_files ) ) {
					
					echo "<li> <a href='#bids-and-awards-annual-{$url_title}' class='collection-item'><i class='cagicon-file-pdf'></i> Annual Documents</a> </li>";

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

          <div class="col l9 m9 s12 cag-bids-and-awards-content cag-sticky-column">

<?php
        $main_query = new WP_Query(
          array(
            'post_type' => 'bids-and-awards',
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
            $cag_meta_id = 'cag_bids_and_awards_widget_register_meta_box_bids_and_awards_id';
            $args = 'type=file';
            $cag_meta_files = rwmb_meta( $cag_meta_id, $args, get_the_ID() );
?>
            <div id="bids-and-awards-year-<?php echo $url_title; ?>">

              <h4 id="bids-and-awards-calendar-<?php echo $url_title; ?>"><?php echo $title; ?></h4>

                <!-- Start of annual documents -->
              <div id="bids-and-awards-annual-<?php echo $url_title; ?>" class="row scrollspy">

          <?php if ( !empty($cag_meta_files) ): ?>       
                <h5>Annual Documents</h5>
          <?php foreach ($cag_meta_files as $cag_meta_file): ?>
          <?php $pdf_annual_title = $cag_meta_file['title']; ?>

                <div class="col l3 m4 s6 cag-page-bids-and-awards-thumb">
                  <div class="card">
                    <div class="card-image">
                      <img src="<?php echo $thumbnail; ?>">
                    </div>
                    <div class="card-content">
                      <div class="fixed-action-btn vertical click-to-toggle bids-and-awards-btn-action">
                          <a class="btn-floating bids-and-awards-btn-dots">
                            <i class="cagicon-dots-vertical"></i>
                          </a>
                          <ul>
                            <li>
                              <a href="<?php echo $cag_meta_file['url']; ?>" class="btn-floating waves-effect waves-light red tooltipped" data-position="right" data-delay="50" data-tooltip="View File"><i class="cagicon-file-pdf"></i></a>
                            </li>
                            <li>
                              <a href="<?php echo $cag_meta_file['url']; ?>" download="<?php echo $pdf_annual_title; ?>" class="btn-floating waves-effect waves-light blue tooltipped" data-position="right" data-delay="50" data-tooltip="Download File"><i class="cagicon-download"></i></a>
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
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/init.min.js"></script>
<!-- Sticky Sidebar -->
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/sticky-kit-1.1.3.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/sticky-sidebar.min.js"></script>

<!-- Scroll Spy -->
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/sidebar-scroll.min.js"></script>

<?php

get_footer();

?>