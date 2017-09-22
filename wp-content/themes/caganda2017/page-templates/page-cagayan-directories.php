<?php 
/*
 * Template Name: Cagayan Directories Page
 * The Directories page template file
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
$page_id = get_the_ID();
$dir_prefix = 'cag_office_directories_register_meta_box_';
?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-directories.min.css" />

<!-- PAGE -->
    <div class="cag-page-directory cag-page-template">

      	<div class="parallax-container">
        	<div class="parallax-directory"><img src="<?php echo get_the_post_thumbnail_url($page_id); ?>"></div>
	        <div class="directory-header-title valign-wrapper">
	          	<a href="#directory-container" class="page-scroll"><h2>Directory</h2></a>
	        </div>
      	</div>

      	<div class="row directory-container cag-sticky-parent" id="directory-container">

	        <div class="col s12 cag-tabs-container cag-sticky-column">
	          	<ul class="tabs cag-tabs">
	            	<li class="tab col s4"><a href="#executive" class="active"><i class="cagicon-bank"></i> Executive</a></li>
	            	<li class="tab col s4"><a href="#legislative"><i class="cagicon-feather"></i> Legislative</a></li>
	            	<li class="tab col s4"><a href="#municipality"><i class="cagicon-castle"></i> Municipality</a></li>
	          	</ul>
	        </div>

			<div id="executive" class="col s12 directory-item-container">
				
				<!--- Start of the Governor Info -->
	          	<div class="row directory-item active-with-click">

	            	<h3>Office of the Governor</h3>
			<?php
				$gov_prefix = 'cag_office_directories_register_meta_box_';
	        	$gov_meta_single_id = 'directory_radio_directory_type_id';
	        	$gov_meta_full_id = $gov_prefix . $gov_meta_single_id;
	        	$gov_meta_postion_id = $gov_prefix . 'directory_radio_govt_position_id';

				$gov_query = new WP_Query(
					array(
	        			'post_type' => 'directories',
						'meta_query'=> array(
							'relation' => 'AND',
							array(
								'key' => $gov_meta_full_id, // this key will change!
								'compare' => '===',
								'value' => 'department',
								'type' => 'text'
							),
							array(
								'key' => $gov_meta_postion_id, // this key will change!
								'compare' => '===',
								'value' => 'gov',
								'type' => 'text'
							)
						),
						'meta_key' => $gov_meta_full_id,
						'orderby' => 'date',
						'order' => 'DESC'
	        		)
				);

				if ( $gov_query->have_posts() ):
					$gov_query->the_post();
					$gov_id = get_the_ID();

	        		// profile name
					$meta_gov_head_name_id = $gov_prefix . "directory_dept_name_id";

					$meta_gov_head_name = rwmb_meta( $meta_gov_head_name_id, "type=text", $gov_id );
					$gov_head_profile_name = !empty($meta_gov_head_name) ? $meta_gov_head_name : "Juan Dela Cruz";

					// profile image
					$gov_head_profile_image = $theme_dir . "/images/logo.png";
					$meta_gov_head_img_id = $gov_prefix . "directory_dept_image_id";
					$meta_gov_head_img = rwmb_meta( $meta_gov_head_img_id, "type=image", $gov_id );
					if ( !empty($meta_gov_head_img) ){

						foreach ($meta_gov_head_img as $meta_gov_head_img_value) {

							$gov_head_profile_image = wp_get_attachment_image_url($meta_gov_head_img_value['ID'], array(718,718));
						}
					}

					// contact informations
					$meta_gov_mobile_id = $gov_prefix . "dpt_mobile_id";
					$meta_gov_landline_id = $gov_prefix . "dpt_landline_id";
					$meta_gov_email_id = $gov_prefix . "dpt_email_id";

					$meta_gov_mobile = rwmb_meta( $meta_gov_mobile_id, "type=text", $gov_id );
					$gov_profile_mobile = !empty($meta_gov_mobile) ? $meta_gov_mobile : "N/A";

					$meta_gov_landline = rwmb_meta( $meta_gov_landline_id, "type=text", $gov_id );
					$gov_profile_landline = !empty($meta_gov_landline) ? $meta_gov_landline : "N/A";

					$meta_gov_email = rwmb_meta( $meta_gov_email_id, "type=text", $gov_id );
					$gov_profile_email = !empty($meta_gov_email) ? $meta_gov_email : "N/A";	

			?>		
	            	<div class="col l3 m4 s12 col-centered">
	              		<article class="material-card Green">
	                		<h2 class="z-depth-1">
	                  			<span><?php echo $meta_gov_head_name; ?></span>
	                  			<strong>Provincial Governor</strong>
	                		</h2>

	                		<div class="mc-content z-depth-1">
	                  			<div class="img-container">
	                    			<img class="img-responsive" src="<?php echo $gov_head_profile_image; ?>" />
	                  			</div>

	                  			<div class="mc-description">
	                    			<ul class="directory-contacts">

	                      				<li class="valign-wrapper">
	                        				<span class="icon ">
	                          					<i class="cagicon-phone"></i>
	                        				</span>
	                        				<span class="text">
	                          					<h5><?php echo $gov_profile_mobile; ?></h5>
	                          					<h6>Mobile</h6>
	                        				</span>
	                      				</li>

	                      				<li class="valign-wrapper">
	                        				<span class="icon ">
	                          					<i class="cagicon-phone-classic"></i>
	                        				</span>
	                        				<span class="text">
	                          					<h5><?php echo $gov_profile_landline; ?></h5>
	                          					<h6>Telephone</h6>
	                        				</span>
	                      				</li>

	                      				<li class="valign-wrapper">
	                        				<span class="icon">
	                          					<i class="cagicon-contact-mail"></i>
	                        				</span>
	                        				<span class="text">
	                          					<h5><?php echo $gov_profile_email; ?></h5>
	                          					<h6>Email</h6>
	                        				</span>
	                      				</li>

	                    			</ul>
	                  			</div>

	                		</div>

	                		<a class="mc-btn-action waves-effect waves-light">
	                  			<i class="cagicon cagicon-dots-vertical"></i>
	                		</a>
	                		<div class="mc-footer z-depth-1">Contacts</div>

	              		</article>
	            	</div>

	        <?php 
	        	endif;
	        	wp_reset_postdata();
	        ?>    	

	          	</div>
	          	<!--- End of the Governor Info -->

	<!-- =============================================================================================== -->

	          	<div class="row directory-item active-with-click">

	            	<h3>Department Heads</h3>

	            	<!-- Loop Here -->

<?php
	        	$dpt_prefix = 'cag_office_directories_register_meta_box_';
	        	$dpt_meta_single_id = 'directory_radio_directory_type_id';
	        	$dpt_meta_full_id = $dpt_prefix . $dpt_meta_single_id;

	        	$dpt_meta_position_id = $dpt_prefix . 'directory_radio_govt_position_id';

	        	$dept_query = new WP_Query(
	        		array(
	        			'post_type' => 'directories',
						'meta_query'=> array(
							'relation' => 'AND',
							array(
								'key' => $dpt_meta_full_id, // this key will change!
								'compare' => '===',
								'value' => 'department',
								'type' => 'text'
							),
							array(
								'key' => $dpt_meta_position_id, // this key will change!
								'compare' => 'NOT IN',
								'value' => array('gov', 'vgov', 'sp'),
								'type' => 'text'
							)
						),
						'posts_per_page' => -1,
						'meta_key' => $dpt_meta_full_id,
						'orderby' => 'post_title',
						'order' => 'ASC'
	        		)
	        	);
	        	if ( $dept_query->have_posts() ):
// $count = $dept_query->post_count;
// $found = $dept_query->found_posts;
// echo "<h1>{$found}</h1>";
	        		while ( $dept_query->have_posts() ): $dept_query->the_post();
	        			$dept_id = get_the_ID();
	        			// profile name
						$meta_dept_head_name_id = $dpt_prefix . "directory_dept_name_id";

						$meta_dept_head_name = rwmb_meta( $meta_dept_head_name_id, "type=text", $dept_id );
						$dept_head_profile_name = !empty($meta_dept_head_name) ? $meta_dept_head_name : "Juan Dela Cruz";

						// profile image
						$dept_head_profile_image = $theme_dir . "/images/logo.png";
						$meta_dept_head_img_id = $dpt_prefix . "directory_dept_image_id";
						$meta_dept_head_img = rwmb_meta( $meta_dept_head_img_id, "type=image", $dept_id );
						if ( !empty($meta_dept_head_img) ){

							foreach ($meta_dept_head_img as $meta_dept_head_img_value) {

								$dept_head_profile_image = wp_get_attachment_image_url($meta_dept_head_img_value['ID'], array(718,718));
							}
						}

						// contact informations
						$meta_dpt_mobile_id = $dpt_prefix . "dpt_mobile_id";
						$meta_dpt_landline_id = $dpt_prefix . "dpt_landline_id";
						$meta_dpt_email_id = $dpt_prefix . "dpt_email_id";

						$meta_dpt_mobile = rwmb_meta( $meta_dpt_mobile_id, "type=text", $dept_id );
						$dpt_profile_mobile = !empty($meta_dpt_mobile) ? $meta_dpt_mobile : "N/A";

						$meta_dpt_landline = rwmb_meta( $meta_dpt_landline_id, "type=text", $dept_id );
						$dpt_profile_landline = !empty($meta_dpt_landline) ? $meta_dpt_landline : "N/A";

						$meta_dpt_email = rwmb_meta( $meta_dpt_email_id, "type=text", $dept_id );
						$dpt_profile_email = !empty($meta_dpt_email) ? $meta_dpt_email : "N/A";

?>
			
						<div class="col l3 m4 s12">

		              		<article class="material-card Green">

		                		<h2 class="z-depth-1">
		                  			<span><?php echo $dept_head_profile_name; ?></span>
		                  			<strong><?php echo get_the_title(); ?></strong>
		                		</h2>

		                		<div class="mc-content z-depth-1">

		                  			<div class="img-container">
		                    			<img class="img-responsive" src="<?php echo $dept_head_profile_image; ?>">
		                  			</div>

		                  			<div class="mc-description">

		                    			<ul class="directory-contacts">

		                      				<li class="valign-wrapper">

		                        				<span class="icon ">
		                          					<i class="cagicon-phone"></i>
		                        				</span>

		                        				<span class="text">
		                          					<h5><?php echo $dpt_profile_mobile; ?></h5>
		                          					<h6>Mobile</h6>
		                        				</span>

		                      				</li>

		                      				<li class="valign-wrapper">

		                        				<span class="icon ">
		                          					<i class="cagicon-phone-classic"></i>
		                        				</span>
		                        				<span class="text">
		                          					<h5><?php echo $dpt_profile_landline; ?></h5>
		                          					<h6>Telephone</h6>
		                        				</span>

		                      				</li>

		                      				<li class="valign-wrapper">

		                        				<span class="icon">
		                          					<i class="cagicon-contact-mail"></i>
		                        				</span>
		                        				<span class="text">
		                          					<h5><?php echo $dpt_profile_email; ?></h5>
		                          					<h6>Email</h6>
		                        				</span>

		                      				</li>

		                    			</ul>

		                  			</div>

		                		</div>

		                		<a class="mc-btn-action waves-effect waves-light">
		                  			<i class="cagicon cagicon-dots-vertical"></i>
		                		</a>

		                		<div class="mc-footer z-depth-1">Contacts</div>

		              		</article>

		            	</div>	        		


	        <?php		
	        		endwhile;
	        		wp_reset_postdata();
	        	endif;
	        ?>
	            	<!-- End Loop Here -->

	          	</div>

	<!-- ===================================================================================== -->

					<!-- District Hostpitals -->
	          	<div class="row directory-item active-with-click">

	            	<h3>District Hospitals</h3>

	            	<!-- Loop Here -->

	        <?php
	        	$hsptl_prefix = 'cag_office_directories_register_meta_box_';
	        	$hsptl_meta_single_id = 'directory_radio_directory_type_id';
	        	$hsptl_meta_full_id = $hsptl_prefix . $hsptl_meta_single_id;

	        	$hospital_query = new WP_Query(
	        		array(
	        			'post_type' => 'directories',
						'meta_query'=> array(
							array(
								'key' => $hsptl_meta_full_id, // this key will change!
								'compare' => '===',
								'value' => 'hospital',
								'type' => 'text'
							)
						),
						'posts_per_page' => -1,
						'meta_key' => $hsptl_meta_full_id,
						'orderby' => 'post_title',
						'order' => 'ASC'
	        		)
	        	);

	        	if ( $hospital_query->have_posts() ):
	        		while ( $hospital_query->have_posts() ): $hospital_query->the_post();
	        			$hsptl_id = get_the_ID();

	        			// profile name
						$meta_hsptl_head_name_id = $hsptl_prefix . "directory_dept_name_id";

						$meta_hsptl_head_name = rwmb_meta( $meta_hsptl_head_name_id, "type=text", $hsptl_id );
						$hsptl_head_profile_name = !empty($meta_hsptl_head_name) ? $meta_hsptl_head_name : "Juan Dela Cruz";

						// profile image
						$hsptl_head_profile_image = $theme_dir . "/images/logo.png";
						$meta_hsptl_head_img_id = $hsptl_prefix . "directory_dept_image_id";
						$meta_hsptl_head_img = rwmb_meta( $meta_hsptl_head_img_id, "type=image", $hsptl_id );
						if ( !empty($meta_hsptl_head_img) ){

							foreach ($meta_hsptl_head_img as $meta_hsptl_head_img_value) {

								$hsptl_head_profile_image = wp_get_attachment_image_url($meta_hsptl_head_img_value['ID'], array(718,718));
							}
						}

						// contact informations
						$meta_hsptl_mobile_id = $hsptl_prefix . "dpt_mobile_id";
						$meta_hsptl_landline_id = $hsptl_prefix . "dpt_landline_id";
						$meta_hsptl_email_id = $hsptl_prefix . "dpt_email_id";

						$meta_hsptl_mobile = rwmb_meta( $meta_hsptl_mobile_id, "type=text", $hsptl_id );
						$hsptl_profile_mobile = !empty($meta_hsptl_mobile) ? $meta_hsptl_mobile : "N/A";

						$meta_hsptl_landline = rwmb_meta( $meta_hsptl_landline_id, "type=text", $hsptl_id );
						$hsptl_profile_landline = !empty($meta_hsptl_landline) ? $meta_hsptl_landline : "N/A";

						$meta_hsptl_email = rwmb_meta( $meta_hsptl_email_id, "type=text", $hsptl_id );
						$hsptl_profile_email = !empty($meta_hsptl_email) ? $meta_hsptl_email : "N/A";
?>
						
						<div class="col l3 m4 s12">

		              		<article class="material-card Green">

		                		<h2 class="z-depth-1">
		                  			<span><?php echo $hsptl_head_profile_name; ?></span>
		                  			<strong><?php echo get_the_title(); ?></strong>
		                		</h2>

		                		<div class="mc-content z-depth-1">

		                  			<div class="img-container">
		                    			<img class="img-responsive" src="<?php echo $hsptl_head_profile_image; ?>">
		                  			</div>

		                  			<div class="mc-description">

		                    			<ul class="directory-contacts">

				                      		<li class="valign-wrapper">

				                        		<span class="icon ">
				                          			<i class="cagicon-phone"></i>
				                        		</span>

				                        		<span class="text">
				                          			<h5><?php echo $hsptl_profile_mobile; ?></h5>
				                          			<h6>Mobile</h6>
				                        		</span>

				                      		</li>

		                      				<li class="valign-wrapper">

		                        				<span class="icon ">
		                          					<i class="cagicon-phone-classic"></i>
		                        				</span>

		                        				<span class="text">
		                          					<h5><?php echo $hsptl_profile_landline; ?></h5>
		                          					<h6>Telephone</h6>
		                        				</span>

		                      				</li>

		                      				<li class="valign-wrapper">

		                        				<span class="icon">
		                          					<i class="cagicon-contact-mail"></i>
		                        				</span>

		                        				<span class="text">
		                          					<h5><?php echo $hsptl_profile_email; ?></h5>
		                          					<h6>Email</h6>
		                        				</span>

		                      				</li>

		                    			</ul>

		                  			</div>

		                		</div>

		                		<a class="mc-btn-action waves-effect waves-light">
		                  			<i class="cagicon cagicon-dots-vertical"></i>
		                		</a>

		                		<div class="mc-footer z-depth-1">Contacts</div>
		              		</article>

		            	</div>

<?php
	        		endwhile;
	        		wp_reset_postdata();
	        	endif;	
?>
	            	<!-- End Loop Here -->

	          	</div>
	          		<!-- End of Hospitals -->

	        </div>
			
			<!--- End of Executive -->
			<!--- ======================================================================================= -->
			
			<!--- Start of Legislative -->			
			
			<div id="legislative" class="col s12 directory-item-container">

          		<div class="row directory-item">

            		<h3>Office of the Vice Governor</h3>

<?php
	        	$vgov_prefix = 'cag_office_directories_register_meta_box_';
	        	$vgov_meta_single_id = 'directory_radio_directory_type_id';
	        	$vgov_meta_full_id = $vgov_prefix . $vgov_meta_single_id;
	        	$vgov_meta_postion_id = $vgov_prefix . 'directory_radio_govt_position_id';

	        	$vgov_query = new WP_Query(
	        		array(
	        			'post_type' => 'directories',
						'meta_query'=> array(
							'relation' => 'AND',
							array(
								'key' => $vgov_meta_full_id, // this key will change!
								'compare' => '===',
								'value' => 'department',
								'type' => 'text'
							),
							array(
								'key' => $vgov_meta_postion_id, // this key will change!
								'compare' => '===',
								'value' => 'vgov',
								'type' => 'text'
							)
						),
						'meta_key' => $vgov_meta_full_id,
						'orderby' => 'date',
						'order' => 'DESC'
	        		)
	        	);

	        	if ( $vgov_query->have_posts() ):
	        		while ( $vgov_query->have_posts() ): $vgov_query->the_post();
	        			$vgov_id = get_the_ID();

	        			// profile name
						$meta_vgov_head_name_id = $vgov_prefix . "directory_dept_name_id";

						$meta_vgov_head_name = rwmb_meta( $meta_vgov_head_name_id, "type=text", $vgov_id );
						$vgov_head_profile_name = !empty($meta_vgov_head_name) ? $meta_vgov_head_name : "Juan Dela Cruz";

						// profile image
						$vgov_head_profile_image = $theme_dir . "/images/logo.png";
						$meta_vgov_head_img_id = $vgov_prefix . "directory_dept_image_id";
						$meta_vgov_head_img = rwmb_meta( $meta_vgov_head_img_id, "type=image", $vgov_id );
						if ( !empty($meta_vgov_head_img) ){

							foreach ($meta_vgov_head_img as $meta_vgov_head_img_value) {

								$vgov_head_profile_image = wp_get_attachment_image_url($meta_vgov_head_img_value['ID'], array(718,718));
							}
						}

						// contact informations
						$meta_vgov_mobile_id = $vgov_prefix . "dpt_mobile_id";
						$meta_vgov_landline_id = $vgov_prefix . "dpt_landline_id";
						$meta_vgov_email_id = $vgov_prefix . "dpt_email_id";

						$meta_vgov_mobile = rwmb_meta( $meta_vgov_mobile_id, "type=text", $vgov_id );
						$vgov_profile_mobile = !empty($meta_vgov_mobile) ? $meta_vgov_mobile : "N/A";

						$meta_vgov_landline = rwmb_meta( $meta_vgov_landline_id, "type=text", $vgov_id );
						$vgov_profile_landline = !empty($meta_vgov_landline) ? $meta_vgov_landline : "N/A";

						$meta_vgov_email = rwmb_meta( $meta_vgov_email_id, "type=text", $vgov_id );
						$vgov_profile_email = !empty($meta_vgov_email) ? $meta_vgov_email : "N/A";

?>
						<div class="col l3 m4 s12 col-centered">

              				<article class="material-card Green">

                				<h2 class="z-depth-1">
                  					<span><?php echo $vgov_head_profile_name; ?></span>
                  					<strong><?php echo get_the_title(); ?></strong>
                				</h2>

	                			<div class="mc-content z-depth-1">

	                  				<div class="img-container">
	                    				<img class="img-responsive" src="<?php echo $vgov_head_profile_image; ?>">
	                  				</div>

	                  				<div class="mc-description">

	                    				<ul class="directory-contacts">

					                      	<li class="valign-wrapper">

					                        	<span class="icon ">
					                          		<i class="cagicon-phone"></i>
					                        	</span>

					                        	<span class="text">
					                          		<h5><?php echo $vgov_profile_mobile; ?></h5>
					                          		<h6>Mobile</h6>
					                        	</span>

					                      	</li>

	                      					<li class="valign-wrapper">

	                        					<span class="icon ">
	                          						<i class="cagicon-phone-classic"></i>
	                        					</span>

	                        					<span class="text">
	                          						<h5><?php echo $vgov_profile_landline; ?></h5>
	                          						<h6>Telephone</h6>
	                        					</span>

	                      					</li>

	                      					<li class="valign-wrapper">
	                        					<span class="icon">
	                          						<i class="cagicon-contact-mail"></i>
	                        					</span>
	                        					<span class="text">
	                          						<h5><?php echo $vgov_profile_email; ?></h5>
	                          					<h6>Email</h6>
	                        					</span>
	                      					</li>

	                    				</ul>

	                  				</div>

	                			</div>

	                			<a class="mc-btn-action waves-effect waves-light">
	                  				<i class="cagicon cagicon-dots-vertical"></i>
	                			</a>

	                			<div class="mc-footer z-depth-1">Contacts</div>

	              			</article>

            			</div>	
<?php					

					endwhile;
					wp_reset_postdata();
				endif;		
?>

          		</div>

					<!--- SP -->	
          		<div class="row directory-item">

            		<h3>Sangguniang Panlalawigan Members</h3>

          		</div>

	<!-- =================================================================================================== -->

					<!-- First District -->
          		<div class="row directory-item">

            		<h3>1st District</h3>

<?php
			$sp_one_prefix = 'cag_office_directories_register_meta_box_';
			$sp_one_meta_full_id = $sp_one_prefix . 'directory_radio_directory_type_id';
			$sp_one_meta_district_full_id = $sp_one_prefix . 'district_id';

			$sp_one_meta_position_id = $sp_one_prefix . 'directory_radio_govt_position_id';

			$sp_one_meta_rank_id = $sp_one_prefix . 'directory_sp_rank_id';

			$sp_one_query = new WP_Query(
	        	array(
	        		'post_type' => 'directories',
					'meta_query'=> array(
						'relation' => 'AND',
						array(
							'key' => $sp_one_meta_position_id, // this key will change!
							'compare' => 'IN',
							'value' => array('sp'),
							'type' => 'text'
						),
						array(
							'key' => $sp_one_meta_district_full_id, // this key will change!
							'compare' => '===',
							'value' => '01',
							'type' => 'text'
						)
					),
					'posts_per_page' => 3,
					'meta_key' => $sp_one_meta_rank_id,
					'orderby' => array('meta_value', 'post_title'),
					'order' => 'ASC'
	        	)
	        );

	        if ( $sp_one_query->have_posts() ):
	        	$index = 0;
	        	while ( $sp_one_query->have_posts() ):
	        		$sp_one_query->the_post();
	        		$sp_one_id = get_the_ID();

	        		// profile name
					$meta_sp_one_head_name_id = $sp_one_prefix . "directory_dept_name_id";

					$meta_sp_one_head_name = rwmb_meta( $meta_sp_one_head_name_id, "type=text", $sp_one_id );
					$sp_one_head_profile_name = !empty($meta_sp_one_head_name) ? $meta_sp_one_head_name : "Juan Dela Cruz";

					// profile image
					$sp_one_head_profile_image = $theme_dir . "/images/logo.png";
					$meta_sp_one_head_img_id = $sp_one_prefix . "directory_dept_image_id";
					$meta_sp_one_head_img = rwmb_meta( $meta_sp_one_head_img_id, "type=image", $sp_one_id );
					if ( !empty($meta_sp_one_head_img) ){
						
						foreach ($meta_sp_one_head_img as $meta_sp_one_head_img_value) {

							$sp_one_head_profile_image = wp_get_attachment_image_url($meta_sp_one_head_img_value['ID'], array(718,718));
						}
					}

					// contact informations
					$meta_sp_one_mobile_id = $sp_one_prefix . "dpt_mobile_id";
					$meta_sp_one_landline_id = $sp_one_prefix . "dpt_landline_id";
					$meta_sp_one_email_id = $sp_one_prefix . "dpt_email_id";

					$meta_sp_one_mobile = rwmb_meta( $meta_sp_one_mobile_id, "type=text", $sp_one_id );
					$sp_one_profile_mobile = !empty($meta_sp_one_mobile) ? $meta_sp_one_mobile : "N/A";

					$meta_sp_one_landline = rwmb_meta( $meta_sp_one_landline_id, "type=text", $sp_one_id );
					$sp_one_profile_landline = !empty($meta_sp_one_landline) ? $meta_sp_one_landline : "N/A";

					$meta_sp_one_email = rwmb_meta( $meta_sp_one_email_id, "type=text", $sp_one_id );
					$sp_one_profile_email = !empty($meta_sp_one_email) ? $meta_sp_one_email : "N/A";

					// extra attributes
					$col_extra_attr = $index === 0 ? "offset-l1-half" : "";
?>            		

            		<div class="col l3 m4 s12 <?php echo $col_extra_attr; ?>">

              			<article class="material-card Green">

                			<h2 class="z-depth-1">
                  				<span><?php echo $sp_one_head_profile_name; ?></span>
                  				<strong><?php echo get_the_title(); ?></strong>
                			</h2>

                			<div class="mc-content z-depth-1">

			                  	<div class="img-container">
			                    	<img class="img-responsive" src="<?php echo $sp_one_head_profile_image; ?>">
			                  	</div>

                  				<div class="mc-description">

                    				<ul class="directory-contacts">

				                      	<li class="valign-wrapper">
				                        	<span class="icon ">
				                          		<i class="cagicon-phone"></i>
				                        	</span>
				                        	<span class="text">
				                          		<h5><?php echo $sp_one_profile_mobile; ?></h5>
				                          		<h6>Mobile</h6>
				                        	</span>
				                      	</li>

                      					<li class="valign-wrapper">
					                        <span class="icon ">
					                          	<i class="cagicon-phone-classic"></i>
					                        </span>
					                        <span class="text">
					                          	<h5><?php echo $sp_one_profile_landline; ?></h5>
					                          	<h6>Telephone</h6>
					                        </span>
                      					</li>

                      					<li class="valign-wrapper">
                        					<span class="icon">
                          						<i class="cagicon-contact-mail"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $sp_one_profile_email; ?></h5>
                          						<h6>Email</h6>
                        					</span>
                      					</li>

                    				</ul>

                  				</div>

                			</div>

                			<a class="mc-btn-action waves-effect waves-light">
                  				<i class="cagicon cagicon-dots-vertical"></i>
                			</a>

                			<div class="mc-footer z-depth-1">Contacts</div>

              			</article>
						
            		</div>

<?php
					$index++;
				endwhile;
				wp_reset_postdata();
			endif;	
?>            		

          		</div>

    <!-- ================================================================================================ -->

					<!-- Second District -->
          		<div class="row directory-item">

            		<h3>2nd District</h3>

<?php
			$sp_two_prefix = 'cag_office_directories_register_meta_box_';
			$sp_two_meta_full_id = $sp_two_prefix . 'directory_radio_directory_type_id';
			$sp_two_meta_district_full_id = $sp_two_prefix . 'district_id';

			$sp_two_meta_position_id = $sp_two_prefix . 'directory_radio_govt_position_id';

			$sp_two_meta_rank_id = $sp_two_prefix . 'directory_sp_rank_id';

			$sp_two_query = new WP_Query(
	        	array(
	        		'post_type' => 'directories',
					'meta_query'=> array(
						'relation' => 'AND',
						array(
							'key' => $sp_two_meta_position_id, // this key will change!
							'compare' => 'IN',
							'value' => array('sp'),
							'type' => 'text'
						),
						array(
							'key' => $sp_two_meta_district_full_id, // this key will change!
							'compare' => '===',
							'value' => '02',
							'type' => 'text'
						)
					),
					'posts_per_page' => 3,
					'meta_key' => $sp_two_meta_rank_id,
					'orderby' => array('meta_value' ,'post_title'),
					'order' => 'ASC'
	        	)
	        );

	        if ( $sp_two_query->have_posts() ):
	        	$index = 0;
	        	while ( $sp_two_query->have_posts() ):
	        		$sp_two_query->the_post();
	        		$sp_two_id = get_the_ID();

	        		// profile name
					$meta_sp_two_head_name_id = $sp_two_prefix . "directory_dept_name_id";

					$meta_sp_two_head_name = rwmb_meta( $meta_sp_two_head_name_id, "type=text", $sp_two_id );
					$sp_two_head_profile_name = !empty($meta_sp_two_head_name) ? $meta_sp_two_head_name : "Juan Dela Cruz";

					// profile image
					$sp_two_head_profile_image = $theme_dir . "/images/logo.png";
					$meta_sp_two_head_img_id = $sp_two_prefix . "directory_dept_image_id";
					$meta_sp_two_head_img = rwmb_meta( $meta_sp_two_head_img_id, "type=image", $sp_two_id );
					if ( !empty($meta_sp_two_head_img) ){
						
						foreach ($meta_sp_two_head_img as $meta_sp_two_head_img_value) {

							$sp_two_head_profile_image = wp_get_attachment_image_url($meta_sp_two_head_img_value['ID'], array(718,718));
						}
					}

					// contact informations
					$meta_sp_two_mobile_id = $sp_two_prefix . "dpt_mobile_id";
					$meta_sp_two_landline_id = $sp_two_prefix . "dpt_landline_id";
					$meta_sp_two_email_id = $sp_two_prefix . "dpt_email_id";

					$meta_sp_two_mobile = rwmb_meta( $meta_sp_two_mobile_id, "type=text", $sp_two_id );
					$sp_two_profile_mobile = !empty($meta_sp_two_mobile) ? $meta_sp_two_mobile : "N/A";

					$meta_sp_two_landline = rwmb_meta( $meta_sp_two_landline_id, "type=text", $sp_two_id );
					$sp_two_profile_landline = !empty($meta_sp_two_landline) ? $meta_sp_two_landline : "N/A";

					$meta_sp_two_email = rwmb_meta( $meta_sp_two_email_id, "type=text", $sp_two_id );
					$sp_two_profile_email = !empty($meta_sp_two_email) ? $meta_sp_two_email : "N/A";

					// extra attributes
					$col_extra_attr = $index === 0 ? "offset-l1-half" : "";
?>            		

            		<div class="col l3 m4 s12 <?php echo $col_extra_attr; ?>">

              			<article class="material-card Green">

                			<h2 class="z-depth-1">
                  				<span><?php echo $sp_two_head_profile_name; ?></span>
                  				<strong><?php echo get_the_title(); ?></strong>
                			</h2>

                			<div class="mc-content z-depth-1">

			                  	<div class="img-container">
			                    	<img class="img-responsive" src="<?php echo $sp_two_head_profile_image; ?>">
			                  	</div>

                  				<div class="mc-description">

                    				<ul class="directory-contacts">

				                      	<li class="valign-wrapper">
				                        	<span class="icon ">
				                          		<i class="cagicon-phone"></i>
				                        	</span>
				                        	<span class="text">
				                          		<h5><?php echo $sp_two_profile_mobile; ?></h5>
				                          		<h6>Mobile</h6>
				                        	</span>
				                      	</li>

                      					<li class="valign-wrapper">
					                        <span class="icon ">
					                          	<i class="cagicon-phone-classic"></i>
					                        </span>
					                        <span class="text">
					                          	<h5><?php echo $sp_two_profile_landline; ?></h5>
					                          	<h6>Telephone</h6>
					                        </span>
                      					</li>

                      					<li class="valign-wrapper">
                        					<span class="icon">
                          						<i class="cagicon-contact-mail"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $sp_two_profile_email; ?></h5>
                          						<h6>Email</h6>
                        					</span>
                      					</li>

                    				</ul>

                  				</div>

                			</div>

                			<a class="mc-btn-action waves-effect waves-light">
                  				<i class="cagicon cagicon-dots-vertical"></i>
                			</a>

                			<div class="mc-footer z-depth-1">Contacts</div>

              			</article>
						
            		</div>

<?php
					$index++;
				endwhile;
				wp_reset_postdata();
			endif;	
?>

          		</div>

    <!-- ================================================================================================= -->

					<!-- Third District -->
          		<div class="row directory-item">

            		<h3>3rd District</h3>

<?php
			$sp_three_prefix = 'cag_office_directories_register_meta_box_';
			$sp_three_meta_full_id = $sp_three_prefix . 'directory_radio_directory_type_id';
			$sp_three_meta_district_full_id = $sp_three_prefix . 'district_id';

			$sp_three_meta_position_id = $sp_three_prefix . 'directory_radio_govt_position_id';

			$sp_three_meta_rank_id = $sp_three_prefix . 'directory_sp_rank_id';

			$sp_three_query = new WP_Query(
	        	array(
	        		'post_type' => 'directories',
					'meta_query'=> array(
						'relation' => 'AND',
						array(
							'key' => $sp_three_meta_position_id, // this key will change!
							'compare' => 'IN',
							'value' => array('sp'),
							'type' => 'text'
						),
						array(
							'key' => $sp_three_meta_district_full_id, // this key will change!
							'compare' => '===',
							'value' => '03',
							'type' => 'text'
						)
					),
					'posts_per_page' => 3,
					'meta_key' => $sp_three_meta_rank_id,
					'orderby' => array('meta_value', 'post_title'),
					'order' => 'ASC'
	        	)
	        );

	        if ( $sp_three_query->have_posts() ):
	        	$index = 0;
	        	while ( $sp_three_query->have_posts() ):
	        		$sp_three_query->the_post();
	        		$sp_three_id = get_the_ID();

	        		// profile name
					$meta_sp_three_head_name_id = $sp_three_prefix . "directory_dept_name_id";

					$meta_sp_three_head_name = rwmb_meta( $meta_sp_three_head_name_id, "type=text", $sp_three_id );
					$sp_three_head_profile_name = !empty($meta_sp_three_head_name) ? $meta_sp_three_head_name : "Juan Dela Cruz";

					// profile image
					$sp_three_head_profile_image = $theme_dir . "/images/logo.png";
					$meta_sp_three_head_img_id = $sp_three_prefix . "directory_dept_image_id";
					$meta_sp_three_head_img = rwmb_meta( $meta_sp_three_head_img_id, "type=image", $sp_three_id );
					if ( !empty($meta_sp_three_head_img) ){
						
						foreach ($meta_sp_three_head_img as $meta_sp_three_head_img_value) {

							$sp_three_head_profile_image = wp_get_attachment_image_url($meta_sp_three_head_img_value['ID'], array(718,718));
						}
					}

					// contact informations
					$meta_sp_three_mobile_id = $sp_three_prefix . "dpt_mobile_id";
					$meta_sp_three_landline_id = $sp_three_prefix . "dpt_landline_id";
					$meta_sp_three_email_id = $sp_three_prefix . "dpt_email_id";

					$meta_sp_three_mobile = rwmb_meta( $meta_sp_three_mobile_id, "type=text", $sp_three_id );
					$sp_three_profile_mobile = !empty($meta_sp_three_mobile) ? $meta_sp_three_mobile : "N/A";

					$meta_sp_three_landline = rwmb_meta( $meta_sp_three_landline_id, "type=text", $sp_three_id );
					$sp_three_profile_landline = !empty($meta_sp_three_landline) ? $meta_sp_three_landline : "N/A";

					$meta_sp_three_email = rwmb_meta( $meta_sp_three_email_id, "type=text", $sp_three_id );
					$sp_three_profile_email = !empty($meta_sp_three_email) ? $meta_sp_three_email : "N/A";

					// extra attributes
					$col_extra_attr = $index === 0 ? "offset-l1-half" : "";	
?>            		

            		<div class="col l3 m4 s12 <?php echo $col_extra_attr; ?>">

              			<article class="material-card Green">

	                		<h2 class="z-depth-1">
	                  			<span><?php echo $sp_three_head_profile_name; ?></span>
	                  			<strong><?php echo get_the_title(); ?></strong>
	                		</h2>

                			<div class="mc-content z-depth-1">
                  				<div class="img-container">
                    				<img class="img-responsive" src="<?php echo $sp_three_head_profile_image; ?>" />
                  				</div>
                  				<div class="mc-description">

                    				<ul class="directory-contacts">

                      					<li class="valign-wrapper">
                        					<span class="icon ">
                          						<i class="cagicon-phone"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $sp_three_profile_mobile; ?></h5>
                          						<h6>Mobile</h6>
                        					</span>
                      					</li>

                      					<li class="valign-wrapper">
                        					<span class="icon ">
                          						<i class="cagicon-phone-classic"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $sp_three_profile_landline; ?></h5>
                          						<h6>Telephone</h6>
                        					</span>
                      					</li>

                      					<li class="valign-wrapper">
                        					<span class="icon">
                          						<i class="cagicon-contact-mail"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $sp_three_profile_email; ?></h5>
                          						<h6>Email</h6>
                        					</span>
                      					</li>

                    				</ul>

                  				</div>

                			</div>

                			<a class="mc-btn-action waves-effect waves-light">
                  				<i class="cagicon cagicon-dots-vertical"></i>
                			</a>

                			<div class="mc-footer z-depth-1">Contacts</div>

              			</article>

            		</div>

<?php
					$index++;
				endwhile;
				wp_reset_postdata();
			endif;	
?>            		

          		</div>

        </div>

			<!--- ======================================================================================= -->
			<!--- End of Legislative -->


			<!--- Start of Municipalities -->

			<div id="municipality" class="col s12 directory-item-container">

          		<div class="row directory-item">

            		<h3>Municipal Mayors</h3>

          		</div>

          		<div class="row directory-item">

            		<h3>1st District</h3>
		<?php
			$mncplty_prefix = 'cag_office_directories_register_meta_box_';
			$mncplty_meta_full_id = $mncplty_prefix . 'directory_radio_directory_type_id';
			$mncplty_meta_district_full_id = $mncplty_prefix . 'district_id';
			$mncplty_query = new WP_Query(
	        	array(
	        		'post_type' => 'directories',
					'meta_query'=> array(
						array(
							'key' => $mncplty_meta_full_id, // this key will change!
							'compare' => '===',
							'value' => 'municipality',
							'type' => 'text'
						),
						array(
							'key' => $mncplty_meta_district_full_id, // this key will change!
							'compare' => '===',
							'value' => '01',
							'type' => 'text'
						)
					),
					'posts_per_page' => -1,
					'meta_key' => $mncplty_meta_full_id,
					'orderby' => 'post_title',
					'order' => 'ASC'
	        	)
	        );

	        if ( $mncplty_query->have_posts() ):
	        	while ( $mncplty_query->have_posts() ):
	        		$mncplty_query->the_post();
	        		$mncplty_id = get_the_ID();

	        		// profile name
					$meta_mncplty_head_name_id = $mncplty_prefix . "directory_dept_name_id";

					$meta_mncplty_head_name = rwmb_meta( $meta_mncplty_head_name_id, "type=text", $mncplty_id );
					$mncplty_head_profile_name = !empty($meta_mncplty_head_name) ? $meta_mncplty_head_name : "Juan Dela Cruz";

					// profile image
					$mncplty_head_profile_image = $theme_dir . "/images/logo.png";
					$meta_mncplty_head_img_id = $mncplty_prefix . "directory_dept_image_id";
					$meta_mncplty_head_img = rwmb_meta( $meta_mncplty_head_img_id, "type=image", $mncplty_id );
					if ( !empty($meta_mncplty_head_img) ){
						
						foreach ($meta_mncplty_head_img as $meta_mncplty_head_img_value) {

							$mncplty_head_profile_image = wp_get_attachment_image_url($meta_mncplty_head_img_value['ID'], array(718,718));
						}
					}

					// contact informations
					$meta_mncplty_mobile_id = $mncplty_prefix . "dpt_mobile_id";
					$meta_mncplty_landline_id = $mncplty_prefix . "dpt_landline_id";
					$meta_mncplty_email_id = $mncplty_prefix . "dpt_email_id";

					$meta_mncplty_mobile = rwmb_meta( $meta_mncplty_mobile_id, "type=text", $mncplty_id );
					$mncplty_profile_mobile = !empty($meta_mncplty_mobile) ? $meta_mncplty_mobile : "N/A";

					$meta_mncplty_landline = rwmb_meta( $meta_mncplty_landline_id, "type=text", $mncplty_id );
					$mncplty_profile_landline = !empty($meta_mncplty_landline) ? $meta_mncplty_landline : "N/A";

					$meta_mncplty_email = rwmb_meta( $meta_mncplty_email_id, "type=text", $mncplty_id );
					$mncplty_profile_email = !empty($meta_mncplty_email) ? $meta_mncplty_email : "N/A";

	    ?>
	    		
					<div class="col l3 m4 s12">

              			<article class="material-card Green">

                			<h2 class="z-depth-1">
                  				<span><?php echo $meta_mncplty_head_name; ?></span>
                  				<strong><?php echo get_the_title(); ?></strong>
                			</h2>

                			<div class="mc-content z-depth-1">

                  				<div class="img-container">
                    				<img class="img-responsive" src="<?php echo $mncplty_head_profile_image; ?>">
                  				</div>

                  				<div class="mc-description">

                    				<ul class="directory-contacts">

                      					<li class="valign-wrapper">
                        					<span class="icon ">
                          						<i class="cagicon-phone"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $mncplty_profile_mobile; ?></h5>
                          						<h6>Mobile</h6>
                        					</span>
                      					</li>

                      					<li class="valign-wrapper">
                        					<span class="icon ">
                          						<i class="cagicon-phone-classic"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $mncplty_profile_landline; ?></h5>
                          						<h6>Telephone</h6>
                        					</span>
                      					</li>

                      					<li class="valign-wrapper">
                        					<span class="icon">
                          						<i class="cagicon-contact-mail"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $mncplty_profile_email; ?></h5>
                          						<h6>Email</h6>
                        					</span>
                      					</li>

                    				</ul>

                  				</div>

                			</div>

                			<a class="mc-btn-action waves-effect waves-light">
                  				<i class="cagicon cagicon-dots-vertical"></i>
                			</a>

                			<div class="mc-footer z-depth-1">Contacts</div>

              			</article>
            		</div>	

	    <?php    	
	        	endwhile;
	        	wp_reset_postdata();
	        endif;
		?>

          		</div>

          		<div class="row directory-item">

            		<h3>2nd District</h3>

<?php
			$mncplty_prefix = 'cag_office_directories_register_meta_box_';
			$mncplty_meta_full_id = $mncplty_prefix . 'directory_radio_directory_type_id';
			$mncplty_meta_district_full_id = $mncplty_prefix . 'district_id';
			$mncplty_query = new WP_Query(
	        	array(
	        		'post_type' => 'directories',
					'meta_query'=> array(
						array(
							'key' => $mncplty_meta_full_id, // this key will change!
							'compare' => '===',
							'value' => 'municipality',
							'type' => 'text'
						),
						array(
							'key' => $mncplty_meta_district_full_id, // this key will change!
							'compare' => '===',
							'value' => '02',
							'type' => 'text'
						)
					),
					'posts_per_page' => 3,
					'meta_key' => $mncplty_meta_full_id,
					'orderby' => 'post_title',
					'order' => 'ASC'
	        	)
	        );

	        if ( $mncplty_query->have_posts() ):
	        	while ( $mncplty_query->have_posts() ):
	        		$mncplty_query->the_post();
	        		$mncplty_id = get_the_ID();

	        		// profile name
					$meta_mncplty_head_name_id = $mncplty_prefix . "directory_dept_name_id";

					$meta_mncplty_head_name = rwmb_meta( $meta_mncplty_head_name_id, "type=text", $mncplty_id );
					$mncplty_head_profile_name = !empty($meta_mncplty_head_name) ? $meta_mncplty_head_name : "Juan Dela Cruz";

					// profile image
					$mncplty_head_profile_image = $theme_dir . "/images/logo.png";
					$meta_mncplty_head_img_id = $mncplty_prefix . "directory_dept_image_id";
					$meta_mncplty_head_img = rwmb_meta( $meta_mncplty_head_img_id, "type=image", $mncplty_id );
					if ( !empty($meta_mncplty_head_img) ){
						
						foreach ($meta_mncplty_head_img as $meta_mncplty_head_img_value) {

							$mncplty_head_profile_image = wp_get_attachment_image_url($meta_mncplty_head_img_value['ID'], array(718,718));
						}
					}

					// contact informations
					$meta_mncplty_mobile_id = $mncplty_prefix . "dpt_mobile_id";
					$meta_mncplty_landline_id = $mncplty_prefix . "dpt_landline_id";
					$meta_mncplty_email_id = $mncplty_prefix . "dpt_email_id";

					$meta_mncplty_mobile = rwmb_meta( $meta_mncplty_mobile_id, "type=text", $mncplty_id );
					$mncplty_profile_mobile = !empty($meta_mncplty_mobile) ? $meta_mncplty_mobile : "N/A";

					$meta_mncplty_landline = rwmb_meta( $meta_mncplty_landline_id, "type=text", $mncplty_id );
					$mncplty_profile_landline = !empty($meta_mncplty_landline) ? $meta_mncplty_landline : "N/A";

					$meta_mncplty_email = rwmb_meta( $meta_mncplty_email_id, "type=text", $mncplty_id );
					$mncplty_profile_email = !empty($meta_mncplty_email) ? $meta_mncplty_email : "N/A";

?>
	    		
					<div class="col l3 m4 s12">

              			<article class="material-card Green">

                			<h2 class="z-depth-1">
                  				<span><?php echo $meta_mncplty_head_name; ?></span>
                  				<strong><?php echo get_the_title(); ?></strong>
                			</h2>

                			<div class="mc-content z-depth-1">

                  				<div class="img-container">
                    				<img class="img-responsive" src="<?php echo $mncplty_head_profile_image; ?>">
                  				</div>

                  				<div class="mc-description">

                    				<ul class="directory-contacts">

                      					<li class="valign-wrapper">
                        					<span class="icon ">
                          						<i class="cagicon-phone"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $mncplty_profile_mobile; ?></h5>
                          						<h6>Mobile</h6>
                        					</span>
                      					</li>

                      					<li class="valign-wrapper">
                        					<span class="icon ">
                          						<i class="cagicon-phone-classic"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $mncplty_profile_landline; ?></h5>
                          						<h6>Telephone</h6>
                        					</span>
                      					</li>

                      					<li class="valign-wrapper">
                        					<span class="icon">
                          						<i class="cagicon-contact-mail"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $mncplty_profile_email; ?></h5>
                          						<h6>Email</h6>
                        					</span>
                      					</li>

                    				</ul>

                  				</div>

                			</div>

                			<a class="mc-btn-action waves-effect waves-light">
                  				<i class="cagicon cagicon-dots-vertical"></i>
                			</a>

                			<div class="mc-footer z-depth-1">Contacts</div>

              			</article>
            		</div>	

	    <?php    	
	        	endwhile;
	        	wp_reset_postdata();
	        endif;
		?>

          		</div>

          		<div class="row directory-item">

            		<h3>3rd District</h3>

        <?php
			$mncplty_prefix = 'cag_office_directories_register_meta_box_';
			$mncplty_meta_full_id = $mncplty_prefix . 'directory_radio_directory_type_id';
			$mncplty_meta_district_full_id = $mncplty_prefix . 'district_id';
			$mncplty_query = new WP_Query(
	        	array(
	        		'post_type' => 'directories',
					'meta_query'=> array(
						array(
							'key' => $mncplty_meta_full_id, // this key will change!
							'compare' => '===',
							'value' => 'municipality',
							'type' => 'text'
						),
						array(
							'key' => $mncplty_meta_district_full_id, // this key will change!
							'compare' => '===',
							'value' => '03',
							'type' => 'text'
						)
					),
					'posts_per_page' => 3,
					'meta_key' => $mncplty_meta_full_id,
					'orderby' => 'post_title',
					'order' => 'ASC'
	        	)
	        );

	        if ( $mncplty_query->have_posts() ):
	        	while ( $mncplty_query->have_posts() ):
	        		$mncplty_query->the_post();
	        		$mncplty_id = get_the_ID();

	        		// profile name
					$meta_mncplty_head_name_id = $mncplty_prefix . "directory_dept_name_id";

					$meta_mncplty_head_name = rwmb_meta( $meta_mncplty_head_name_id, "type=text", $mncplty_id );
					$mncplty_head_profile_name = !empty($meta_mncplty_head_name) ? $meta_mncplty_head_name : "Juan Dela Cruz";

					// profile image
					$mncplty_head_profile_image = $theme_dir . "/images/logo.png";
					$meta_mncplty_head_img_id = $mncplty_prefix . "directory_dept_image_id";
					$meta_mncplty_head_img = rwmb_meta( $meta_mncplty_head_img_id, "type=image", $mncplty_id );
					if ( !empty($meta_mncplty_head_img) ){
						
						foreach ($meta_mncplty_head_img as $meta_mncplty_head_img_value) {

							$mncplty_head_profile_image = wp_get_attachment_image_url($meta_mncplty_head_img_value['ID'], array(718,718));
						}
					}

					// contact informations
					$meta_mncplty_mobile_id = $mncplty_prefix . "dpt_mobile_id";
					$meta_mncplty_landline_id = $mncplty_prefix . "dpt_landline_id";
					$meta_mncplty_email_id = $mncplty_prefix . "dpt_email_id";

					$meta_mncplty_mobile = rwmb_meta( $meta_mncplty_mobile_id, "type=text", $mncplty_id );
					$mncplty_profile_mobile = !empty($meta_mncplty_mobile) ? $meta_mncplty_mobile : "N/A";

					$meta_mncplty_landline = rwmb_meta( $meta_mncplty_landline_id, "type=text", $mncplty_id );
					$mncplty_profile_landline = !empty($meta_mncplty_landline) ? $meta_mncplty_landline : "N/A";

					$meta_mncplty_email = rwmb_meta( $meta_mncplty_email_id, "type=text", $mncplty_id );
					$mncplty_profile_email = !empty($meta_mncplty_email) ? $meta_mncplty_email : "N/A";

	    ?>
	    		
					<div class="col l3 m4 s12">

              			<article class="material-card Green">

                			<h2 class="z-depth-1">
                  				<span><?php echo $meta_mncplty_head_name; ?></span>
                  				<strong><?php echo get_the_title(); ?></strong>
                			</h2>

                			<div class="mc-content z-depth-1">

                  				<div class="img-container">
                    				<img class="img-responsive" src="<?php echo $mncplty_head_profile_image; ?>">
                  				</div>

                  				<div class="mc-description">

                    				<ul class="directory-contacts">

                      					<li class="valign-wrapper">
                        					<span class="icon ">
                          						<i class="cagicon-phone"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $mncplty_profile_mobile; ?></h5>
                          						<h6>Mobile</h6>
                        					</span>
                      					</li>

                      					<li class="valign-wrapper">
                        					<span class="icon ">
                          						<i class="cagicon-phone-classic"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $mncplty_profile_landline; ?></h5>
                          						<h6>Telephone</h6>
                        					</span>
                      					</li>

                      					<li class="valign-wrapper">
                        					<span class="icon">
                          						<i class="cagicon-contact-mail"></i>
                        					</span>
                        					<span class="text">
                          						<h5><?php echo $mncplty_profile_email; ?></h5>
                          						<h6>Email</h6>
                        					</span>
                      					</li>

                    				</ul>

                  				</div>

                			</div>

                			<a class="mc-btn-action waves-effect waves-light">
                  				<i class="cagicon cagicon-dots-vertical"></i>
                			</a>

                			<div class="mc-footer z-depth-1">Contacts</div>

              			</article>
            		</div>	

	    <?php    	
	        	endwhile;
	        	wp_reset_postdata();
	        endif;
		?>

          		</div>

        	</div>

			<!--- ======================================================================================= -->
			<!--- End of Municipalities -->
		
		</div>

    </div>
	

	<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/sticky-kit-1.1.3.min.js"></script>	
    <script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-directories.min.js"></script>

<?php
	function _get_sp_members($args){

	}
?>    

<?php get_footer(); ?>