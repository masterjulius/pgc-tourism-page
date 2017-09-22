<?php 
/*
 * Template Name: Cagayan Tourism Page
 * The Tourism page template file
 */
	get_header();
	$theme_dir = get_stylesheet_directory_uri();
	$__tp_tour = $theme_dir . '/tourism-third-party';
	$__mbox_prefix = "tourism_meta_box_";

	/** Custom function **/
	function extract_image_attrs($image_id) {
		$returnDatas = array();
		$returnDatas['alt'] = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
		return (object)$returnDatas;
	}

?>
<link rel="stylesheet" href="<?php echo $__tp_tour; ?>/css/material-cards-auto-height.css" />

<link rel="stylesheet" href="<?php echo $__tp_tour; ?>/css/lightslider.min.css" />

<link rel="stylesheet" href="<?php echo $__tp_tour; ?>/css/magnific-popup.css" />

<link rel="stylesheet" href="<?php echo $theme_dir; ?>/lightgallery/css/lightgallery.min.css" />

<link rel="stylesheet" href="<?php echo $__tp_tour; ?>/plyr/plyr.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $__tp_tour; ?>/css/justifiedGallery.min.css" />

<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-tourism.min.css" />

		<!-- PAGE -->
<div class="cag-page-tourism-main">
	
	<div class="keyart" id="nonparallax"></div>
	<div class="cag-tourism-body">
		<div class="keyart" id="parallax">
			<div class="keyart-layer parallax" id="keyart-0" data-speed="2"></div>    <!-- 00.0 -->
			<div class="keyart-layer parallax" id="keyart-1" data-speed="5"></div>  <!-- 12.5 -->
			<div class="keyart-layer parallax" id="keyart-2" data-speed="11"></div>   <!-- 25.0 -->
			<div class="keyart-layer parallax" id="keyart-3" data-speed="16"></div> <!-- 37.5 -->
			<div class="keyart-layer parallax" id="keyart-4" data-speed="26"></div>   <!-- 50.0 -->
			<div class="keyart-layer parallax" id="keyart-5" data-speed="36"></div> <!-- 62.5 -->
			<div class="keyart-layer parallax" id="keyart-6" data-speed="49"></div>   <!-- 75.0 -->
			<div class="keyart-layer" id="keyart-scrim"></div>
			<div class="keyart-layer parallax" id="keyart-7" data-speed="69"></div>   <!-- 87.5 -->
			<div class="keyart-layer" id="keyart-8" data-speed="100"></div>   <!-- 100. -->
		</div>
		<div class="cag-tourism-img-white hide-on-small-only container-fluid">
			<img src="<?php echo $__tp_tour; ?>/images/edge/white.png" />
		</div>
	</div>
	  <!-- PAGE -->

	<div class="cag-page-tourism">
		<div class="container-fluid">
			<div class="row cag-tag">
				<div class="col s12">
					<span>Top Visited</span>
				</div>
			</div>
			<div class="cag-tourism-topvisited">
				<div class="cag-tourism-map hide-on-small-only">
					<div class="container-fluid">
						<div class="row">
							<div class="col s12 m12 l12">
								<div class="demo">
									<div class="item">
										<ul id="content-slider" class="content-slider">

								<?php
									$top_visited_args = array(
										'post_type'		=>	'tourism-top-visited',
										'posts_per_page'=>	16
									);
									$top_visited_query = new WP_Query($top_visited_args);
									if ($top_visited_query->have_posts()):
										while($top_visited_query->have_posts()):
											$top_visited_query->the_post();
											$top_visited_ID = get_the_ID();
											$top_visited_thumb_ID = get_post_thumbnail_id($top_visited_ID);
								?>

											<li>
												<div class="row">
													<div class="card hoverable">
														<div class="card-image">
															<a href="<?php echo get_the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo extract_image_attrs( $top_visited_thumb_ID )->alt; ?>" /></a>
														</div>
														<div class="card-content">
															<span><?php echo get_the_title(); ?></span>
															<p><?php echo get_the_excerpt(); ?></p>
														</div>
													</div>
												</div>
											</li>

								<?php
										endwhile;
										wp_reset_postdata();
									endif;
								?>		

										</ul>
									</div>
								</div>    
							</div>
						</div>
					</div>
				</div>
			</div>
				<!-- ============================================================================================================= -->
				<!-- MAP GROUP -->

				<!-- Featured Content of the Map Group -->
			<div class="cag-map-post">
				<div class="col s12">
					<div class="card-panel z-depth-1 hoverable">
			<?php
				$featured_args = array(
					'post_type'		=>	'tourism-feat-artcle',
					'posts_per_page'=>	1
				);
				$featured_query = new WP_Query($featured_args);
				if ($featured_query->have_posts()):
					while($featured_query->have_posts()):
						$featured_query->the_post();
						$featured_ID = get_the_ID();
						$featured_thumb_ID = get_post_thumbnail_id($featured_ID);
			?>
						<div class="row">
							<div class="col s12 valign-wrapper">
								<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo extract_image_attrs( $featured_thumb_ID )->alt; ?>" class="circle responsive-img"> <!-- notice the "circle" class -->
								<p><?php echo get_the_content(); ?></p>
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

				<!-- The Map Area -->
			<div class="row cag-tourism-map-group">
				<div class="col s12 m9 l9">
					<div class="card hoverable">
						<div class="cag-tourism-mapContainer">
							<input id="origin-input" class="controls" type="text"
							placeholder="Enter an origin location">

							<input id="destination-input" class="controls" type="text"
							placeholder="Enter a destination location">

							<div id="mode-selector" class="controls">
								<input type="radio" name="type" id="changemode-walking" checked="checked">
								<label for="changemode-walking">Walking</label>

								<input type="radio" name="type" id="changemode-transit">
								<label for="changemode-transit">Transit</label>

								<input type="radio" name="type" id="changemode-driving">
								<label for="changemode-driving">Driving</label>
							</div>
							<div id="map"></div>
						</div>
					</div>
				</div>
			</div>

				<!-- Gallery Group -->
			<div class="cag-tourism-separator">
				<div class="container-fluid">
					<div class="row">
						<div class="col s12">
							<div class="demo">
								<div class="item">
									<ul id="separator-slider" class="content-slider">
					<?php
						$gallery_args = array(
							'post_type'		=>	'tourism-img-gallery',
							'posts_per_page'=>	1
						);
						$gallery_query = new WP_Query($gallery_args);
						if ($gallery_query->have_posts()):
							while($gallery_query->have_posts()):
								$gallery_query->the_post();
								$galley_ID = get_the_ID();
								// extract the gallery images
								$gallery_meta_box_ID = $_tourism_mbox_prefix . "gallery_images_id";
								$args = "type=image";
								$gallery_meta_box_images = rwmb_meta( $gallery_meta_box_ID, "type=image", $galley_ID );

								if ( !empty( $gallery_meta_box_images ) ) :
									foreach ($gallery_meta_box_images as $gallery_meta_box_images_value):
										$gallery_img_ID			=	$gallery_meta_box_images_value["ID"]; // ID
										$gallery_img_title		=	$gallery_meta_box_images_value["title"]; // title/name
										$gallery_img_full_url	=	$gallery_meta_box_images_value["full_url"]; // full url without size/original image
										$gallery_img_url		=	$gallery_meta_box_images_value["url"]; // full url with size
										$gallery_img_alt		=	$gallery_meta_box_images_value["alt"]; // image alt
										$gallery_img_desc		=	$gallery_meta_box_images_value["description"]; // description
					?>
										<li>
											<div class="row">
												<img class="circle responsive-img hoverable" src="<?php echo $gallery_img_full_url; ?>" alt="<?php echo $gallery_img_alt; ?>" id="tourism-gallery-img-<?php echo $gallery_img_ID; ?>" />
											</div>
										</li>

					<?php
									endforeach;
								endif;
							endwhile;
							wp_reset_postdata();
						endif;
					?>			

									</ul>
								</div>
							</div>    
						</div>
					</div>
				</div>
			</div>

				<!-- ========================================================================================================== -->

				<!-- TOURISM MAIN BODY -->
			<div class="row cag-sticky-parent">

				<!-- 
				/**
				 * SIDEBAR
				 * This is the sidebar of the main body.
				 */
				 -->
        		<div class="col l2 m2 s12 cag-tourism-sidenav cag-sticky-column animated">
        			<ul class="collapsible hoverable" data-collapsible="expandable">
        				<li>
        					<div class="collapsible-header active" data-scroll-id="Tourismcontent"><i class="cagicon-forest">
        					</i>Tourism Content</div>
        					<div class="collapsible-body">
        						<ul class="collection">
        							<li>
        								<a href="#fastfacts" class="collection-item"><i class="cagicon-church"></i>Fast Facts</a>
        							</li>
        							<li>
        								<a href="#travel" class="collection-item"><i class="cagicon-map-marker"></i>Travel & Tours Agencies</a>
        							</li>
        							<li>
        								<a href="#accomodation" class="collection-item"><i class=" cagicon-city"></i>Accomodation Establishments</a>
        							</li>
        							<li>
        								<a href="#nativedialect" class="collection-item"><i class="cagicon-food"></i>Native Dialect</a>
        							</li>
        							<li>
        								<a href="#nativedelicacies" class="collection-item"><i class="cagicon-food"></i>Native Delicacies</a>
        							</li>
        							<li>
        								<a href="#touratt" class="collection-item"><i class="cagicon-tourism"></i>Tourist Attractions</a>
        							</li>
        							<li>
        								<a href="#accomresto" class="collection-item"><i class="cagicon-city"></i>Accomodation & Restaurant</a>
        							</li>
        							<li>
        								<a href="#howtogetthere" class="collection-item"><i class="cagicon-routes"></i>How to get there</a>
        							</li>
        							<li>
        								<a href="#howtogetaround" class="collection-item"><i class="cagicon-cave"></i>How  to get around</a>
        							</li>
        							<li>
        								<a href="#activities" class="collection-item"><i class="cagicon-gallery"></i>Activities</a>
        							</li>
        							<li>
        								<a href="#Videos" class="collection-item"><i class="cagicon-play"></i>Video</a>
        							</li>
        						</ul>
        					</div>
        				</li>
        			</ul>

				</div>

				<!--...............................................................................................-->
				<!-- 	
				/**
				 * STICKY CONTENT
				 * This is the sticky content that is controlled by the sticky sidebar.
				 */
 				-->
				
        		<div class="col l10 m10 s12 cag-tourism-content cag-sticky-column">
          			<div id="Tourismcontent">
          				
						<!-- [#=== FAST FACTS ===#] -->
						<div id="fastfacts" class="row scrollspy">
							<div class="row cag-tag">
								<div class="col s12">
									<span>Fast Facts</span>
								</div>
							</div>
							<div class="cag-tourism-fastfacts">
								<div class="container-fluid">
									<div class="row">
										<div class="col s12">
											<ul class="collapsible hoverable" data-collapsible="accordion">
								<?php
									$fast_facts_args = array(
										'post_type'	=>	'tourism-fast-fact',
										'orderby'	=>	'menu_order',
										'order'		=>	'ASC'
									);
									$fast_facts_query = new WP_Query($fast_facts_args);
									if ($fast_facts_query->have_posts()):
										while($fast_facts_query->have_posts()):
											$fast_facts_query->the_post();
												$fast_facts_ID = get_the_ID();
								?>			
												<li>
													<div class="collapsible-header"><i class="cagicon-map"></i><?php echo strtoupper(get_the_title()); ?></div>
													<div class="collapsible-body"><?php the_content(); ?></div>
												</li>

								<?php
										endwhile;
										wp_reset_postdata();
									endif;
								?>				
												
											</ul>
										</div>
									</div>

								</div>  
							</div>

						</div>	
						<!-- [#=== END OF FAST FACTS ===#] -->

						<!-- [#=== START OF TRAVEL AND TOURS ===#] -->
						<div id="travel" class="row scrollspy">
							<div class="row cag-tag">
								<div class="col s12">
									<span>Travel & Tours Agencies</span>
								</div>	
							</div>
							<div class="cag-tourism-travelToursAgencies">
								<div class="container-fluid">
									<div class="row">
										<div class="col s12">
											<table class="highlight responsive-table centered striped">
												<thead>
													<tr>
														<th data-field="agency">AGENCY</th>
														<th data-field="location">LOCATION</th>
														<th data-field="contact">CONTACT</th>
														<th data-field="more">MORE</th>
													</tr>
												</thead>

												<tbody>
							<?php
								$travel_and_tours_args = array(
									'post_type'	=>	'tourism-trvl-tours',
									'orderby'	=>	'title',
									'order'		=>	'ASC'
								);
								$travel_and_tours_query = new WP_Query($travel_and_tours_args);
								if ($travel_and_tours_query->have_posts()):
									while($travel_and_tours_query->have_posts()):
										$travel_and_tours_query->the_post();
										$travel_and_tours_ID = get_the_ID();

										// Meta Datas
										$travel_and_tours_location = rwmb_meta( $__mbox_prefix . "travel_n_tours_location_id", "type=text", $travel_and_tours_ID );
										$travel_and_tours_phone = rwmb_meta( $__mbox_prefix . "travel_n_tours_telephone_id", "type=text", $travel_and_tours_ID );
							?>			
												<tr>
													<td><?php echo get_the_title(); ?></td>
													<td><?php echo !empty($travel_and_tours_location) ? $travel_and_tours_location : 'N/A'; ?></td>
													<td><?php echo !empty($travel_and_tours_phone) ? $travel_and_tours_phone : 'N/A'; ?></td>
													<td><a href="<?php echo get_the_permalink(); ?>" class="red-text">Read Full Details...</a></td>
												</tr>
							<?php
									endwhile;
									wp_reset_postdata();
									else:
							?>
												<tr>
													<td>No Available Datas</td>
													<td>No Available Datas</td>
													<td>No Available Datas</td>
													<td>No Available Datas</td>
												</tr>
							<?php				
								endif;
							?>					
												
												</tbody>
											</table>
										</div>	
									</div>
								</div>
							</div>  
						</div>
						<!-- [#=== END OF TRAVEL AND TOURS ===#] -->

						<!-- [#=== START OF ACCOM ESTABLISHMENTS ===#] -->
						<div id="accomodation" class="row scrollspy">
							<div class="row cag-tag">
								<div class="col s12">
									<span>Accom Establishments</span>
								</div>	
							</div>
							<div class="cag-tourism-accomodation">
								<div class="container-fluid">
									<div class="row">

										<div class="col s12">
											<table class="highlight responsive-table centered striped">
												<thead>
													<tr>
														<th data-field="id">NAME OF HOTEL/RESORTS</th>
														<th data-field="add">ADDRESS</th>
														<th data-field="class">CLASSIFICATION</th>
														<th data-field="contact">CONTACT NUMBERS</th>
														<th data-field="more">MORE</th>
													</tr>
												</thead>

												<tbody>
										<?php
											$accom_establishment_args = array(
												'post_type'	=>	'tourism-accm-stblsm',
												'orderby'	=>	'title',
												'order'		=>	'ASC'
											);
											$accom_establishment_query = new WP_Query($accom_establishment_args);
											if ($accom_establishment_query->have_posts()):
												while($accom_establishment_query->have_posts()):
													$accom_establishment_query->the_post();
													$accom_establishment_ID = get_the_ID();

													// Meta Datas
													$accom_establishment_location = rwmb_meta( $__mbox_prefix . "accom_location_id", "type=text", $accom_establishment_ID );
													$accom_establishment_classification = rwmb_meta( $__mbox_prefix . "accom_classification_id", "type=text", $accom_establishment_ID );
													$accom_establishment_phone = rwmb_meta( $__mbox_prefix . "accom_telephone_id", "type=text", $accom_establishment_ID );
										?>	
													<tr>
														<td><?php echo get_the_title(); ?></td>
														<td><?php echo !empty($accom_establishment_location) ? $accom_establishment_location : 'N/A'; ?></td>
														<td><?php echo !empty($accom_establishment_classification) ? $accom_establishment_classification : 'N/A'; ?></td>
														<td><?php echo !empty($accom_establishment_phone) ? $accom_establishment_phone : 'N/A'; ?></td>
														<td><a href="<?php echo get_the_permalink(); ?>" class="red-text">Read Full Details...</a></td>
													</tr>

										<?php
												endwhile;
												wp_reset_postdata();
												else:
										?>
													<tr>
														<td>No Datas Available...</td>
														<td>No Datas Available...</td>
														<td>No Datas Available...</td>
														<td>No Datas Available...</td>
														<td>No Datas Available...</td>
													</tr>
									<?php			
										endif;
									?>				
													
												</tbody>
											</table>
										</div>
											
									</div>
								</div>
							</div> 
						</div>
						<!-- [#=== END OF ACCOM ESTABLISHMENTS ===#] -->

						<!-- [#=== START OF NATIVE DIALECT ===#] -->
						<div id="nativedialect" class="row scrollspy">

							<div class="row cag-tag">
								<div class="col s12">
									<span>Native Dialect/Demography</span>
								</div>	
							</div>

							<div class="cag-tourism-nativedialect">
								<div class="container-fluid">
									<div class="row">
										<div class="col s12">
											<div class="card-panel z-depth-1 hoverable center">
												
								<?php
									$demography_args = array(
										'post_type'	=>	'tourism-demography',
										'orderby'	=>	'menu_order',
										'order'		=>	'ASC'
									);
									$demography_query = new WP_Query($demography_args);
									if ($demography_query->have_posts()):
										echo '<canvas id="tourism-demography-chart-container"></canvas>';
										echo '<script type="text/javascript">var demography_chartist_args = {"DATAS":[],"BGCOLORS":[],"LABELS":[]};</script>';
										while($demography_query->have_posts()):
											$demography_query->the_post();
											$demography_ID = get_the_ID();

											// Meta Datas
											$demography_percent = rwmb_meta( $__mbox_prefix . "demography_id", "type=text", $demography_ID );
											$demography_percent = doubleval($demography_percent);
											echo '<script type="text/javascript">demography_chartist_args.DATAS.push('. $demography_percent .');demography_chartist_args.LABELS.push("'. get_the_title() .'");</script>';
										endwhile;
										wp_reset_postdata();
									endif;	
								?>

											</div>
										</div>
									</div>
								</div>
							</div> 
						</div>
						<!-- [#=== END OF NATIVE DIALECT ===#] -->

						<!-- [#=== START OF NATIVE DELICIES ===#] -->
						
						<div id="nativedelicacies" class="row scrollspy">
							
							<div class="row cag-tag">
								<div class="col s12">
									<span>Native Delicacies</span>
								</div>
            				</div>

			              	<div class="cag-tourism-nativedelicacies">
			                	<div class="container-fluid">
			                  		<div class="row">

			                <?php
			                	$native_delicacies_args = array(
			                		'post_type'	=>	'tourism-delicacies',
			                		'orderby'	=>	'title',
			                		'order'		=>	'ASC'
			                	);
			                	$native_delicacies_query = new WP_Query($native_delicacies_args);
			                	if ($native_delicacies_query->have_posts()):
			                		while ($native_delicacies_query->have_posts()):
			                			$native_delicacies_query->the_post();
			                			$native_delicacies_ID = get_the_ID();
			          					$native_delicacies_thumb_ID = get_post_thumbnail_id($native_delicacies_ID);
			                ?>  		
										
										<div class="col s12 m6 l4">
											<div class="card hoverable">
												<div class="card-image waves-effect waves-block waves-light">
													<img class="activator" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo extract_image_attrs($native_delicacies_thumb_ID)->alt; ?>" />
												</div>
												<div class="card-content">
													<a href="<?php echo get_the_permalink(); ?>">
														<span class="card-title activator grey-text text-darken-4"><?php echo get_the_title(); ?></i></i></span>
													</a>	
													<ul>
														<li><a class="btn-floating waves-effect waves-light" href="//www.facebook.com" target="_blank"><i class="cagicon-facebook"></i></a></li>
														<li><a class="btn-floating waves-effect waves-light" href="//www.twitter.com" target="_blank"><i class="cagicon-twitter"></i></a></li>
														<li><a class="btn-floating waves-effect waves-light" href="//www.youtube.com" target="_blank"><i class="cagicon-youtube-play"></i></a></li>
													</ul>
												</div>
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
			            </div>      		
						
						<!-- [#=== END OF NATIVE DELICIES ===#] -->

						<!-- [#=== START OF TOURIST ATTRACTIONS ===#] -->

						<div id="touratt" class="row scrollspy">

							<div class="row cag-tag">
								<div class="col s12">
									<span>Tourist Attractions</span>
								</div>
			            	</div>

  							<div class="cag-tourism-touratt">
    							<div class="container-fluid">
      								<div class="row">

							<?php
								$tourist_attractions_args = array(
									'post_type'	=>	'tourism-attractions',
									'orderby'	=>	'title',
									'order'		=>	'ASC'
								);
								$tourist_attractions_query = new WP_Query($tourist_attractions_args);
								if ( $tourist_attractions_query->have_posts() ):
									while ( $tourist_attractions_query->have_posts() ):
										$tourist_attractions_query->the_post();
										$tourist_attractions_ID = get_the_ID();
										$tourist_attractions_thumb_ID = get_post_thumbnail_id($tourist_attractions_ID);
							?>
										<div class="col s12 m6 l4">
											<div class="card hoverable">
												<div class="card-image waves-effect waves-block waves-light">
												<img class="activator" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo extract_image_attrs($tourist_attractions_thumb_ID)->alt; ?>" />
												</div>
												<div class="card-content">
													<a href="<?php echo get_the_permalink(); ?>">
														<span class="card-title activator grey-text text-darken-4"><i class="cagicon-beach"></i><?php echo get_the_title(); ?></span>
													</a>
													<ul>
														<li><a class="btn-floating waves-effect waves-light" href="//www.facebook.com" target="_blank"><i class="cagicon-facebook"></i></a></li>
														<li><a class="btn-floating waves-effect waves-light" href="//www.twitter.com" target="_blank"><i class="cagicon-twitter"></i></a></li>
														<li><a class="btn-floating waves-effect waves-light" href="//www.youtube.com" target="_blank"><i class="cagicon-youtube-play"></i></a></li>
													</ul>
												</div>
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
      					</div>			

      					<!-- [#=== END OF TOURIST ATTRACTIONS ===#] -->

      					<!-- [#=== START OF ACCOMADATION AND RESTAURANTS ===#] -->
						<div id="accomresto" class="row scrollspy">
							<div class="row cag-tag">
								<div class="col s12">
									<span>Accomodation & Resto</span>
								</div>
							</div>

							<div class="container-fluid">
								<div class="row">
									<div class="col s12">
										<table class="highlight responsive-table centered striped">
											<thead>
												<tr>
													<th data-field="NAME">NAME OF HOTEL/RESORTS</th>
													<th data-field="ADDRESS">ADDRESS</th>
													<th data-field="CLASSIFICATION">CLASSIFICATION</th>
													<th data-field="CONTACTNUMBERS">CONTACT NUMBERS</th>
													<th data-field="MORE">MORE</th>
												</tr>
											</thead>

											<tbody>

									<?php
										$accom_restaurant_args = array(
											'post_type'	=>	'tourism-accm-rstrnts',
											'orderby'	=>	'title',
											'order'		=>	'ASC'
										);
										$accom_restaurant_query = new WP_Query($accom_restaurant_args);
										if ($accom_restaurant_query->have_posts()):
											while($accom_restaurant_query->have_posts()):
												$accom_restaurant_query->the_post();
												$accom_restaurant_ID = get_the_ID();

												// Meta Datas
												$accom_restaurant_location = rwmb_meta( $__mbox_prefix . "accom_location_id", "type=text", $accom_restaurant_ID );
												$accom_restaurant_classification = rwmb_meta( $__mbox_prefix . "accom_classification_id", "type=text", $accom_restaurant_ID );
												$accom_restaurant_phone = rwmb_meta( $__mbox_prefix . "accom_telephone_id", "type=text", $accom_restaurant_ID );
									?>			
												<tr>
													<td><?php echo get_the_title(); ?></td>
													<td><?php echo !empty($accom_restaurant_location) ? $accom_restaurant_location : 'N/A'; ?></td>
													<td><?php echo !empty($accom_restaurant_classification) ? $accom_restaurant_classification : 'N/A'; ?></td>
													<td><?php echo !empty($accom_restaurant_phone) ? $accom_restaurant_phone : 'N/A'; ?></td>
													<td><a href="<?php echo get_the_permalink(); ?>" class="red-text">Read Full Details...</a></td>
												</tr>

									<?php
											endwhile;
											wp_reset_postdata();
											else:
									?>
												<tr>
													<td>No Datas Available...</td>
													<td>No Datas Available...</td>
													<td>No Datas Available...</td>
													<td>No Datas Available...</td>
													<td>No Datas Available...</td>
												</tr>		
									<?php
										endif;
									?>			


											</tbody>
										</table>
									</div>
								</div>
							</div>

						</div>	       
						<!-- [#=== END OF ACCOMADATION AND RESTAURANTS ===#] -->

						<!-- [#=== START OF HOW TO GET THERE ===#] -->
						<div id="howtogetthere" class="row scrollspy">
							<div class="row cag-tag">
								<div class="col s12">
									<span>How to get there</span>
								</div>
							</div>
							<div class="container-fluid">
								<div class="row">
									<div class="col s12">
										<div class="card horizontal hoverable">
											<div class="card-stacked">
												<div class="card-content">
													<p>Tuguegarao City (TUG), the capital of Cagayan, may be reached by plane from manila (MNL) through the daily flights of Air Philippines and Cebu Pacific.
														By land, Tuguegarao City can easily be reached by various air conditioned buses with very comfortable seating capacity 9-11 hours from Manila. For independent motorists, take the North Diversion Roan and exit at Sta. Rita Cagayan may also be reached via Ilocos Norte, passing by  the picturesque Patapat Bridge. 
													</p>
												</div>
												<div class="card-action">
												
													<div class="col s12 m6 l4">
														<div class="row valign-wrapper">
															<div class="col s3">
																<img src="images/5.png" alt="" class="circle responsive-img hoverable">
															</div>
															<div class="col s9">
																<ul>
																	<li>VICTORY BUS</li>
																	<li>Johnny T. Fernandez</li>
																	<li>(078) 844- 077</li>
																</ul>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>  
						</div>
						<!-- [#=== END OF HOW TO GET THERE ===#] -->

						<!-- [#=== START OF HOW TO GET AROUND ===#] -->

						<!-- [#=== END OF HOW TO GET AROUND ===#] -->

						<!-- [#=== START OF ACTIVITIES ===#] -->

						<!-- [#=== END OF ACTIVITIES ===#] -->
	

          			</div>
          		</div>


        	</div>
				<!-- END OF TOURISM MAIN BODY -->

				<!-- ========================================================================================================== -->

        </div>
        
    </div>    	

<!-- Enf of all -->
</div>

<!-- Sticky Sidebar -->
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/sticky-kit-1.1.3.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/sticky-sidebar.min.js"></script>
<!-- Scroll Spy -->
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/sidebar-scroll.min.js"></script>

<!--Addon-->
<script type="text/javascript" src="<?php echo $__tp_tour; ?>/js/movingfish.js"></script>
<script type="text/javascript" src="<?php echo $__tp_tour; ?>/js/magnific.js"></script>
<script type="text/javascript" src="<?php echo $__tp_tour; ?>/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="<?php echo $__tp_tour; ?>/js/jquery.simplr.smoothscroll.min.js"></script>

<script type="text/javascript" src="<?php echo $__tp_tour; ?>/js/lightslider.min.js"></script>
<script type="text/javascript" src="<?php echo $__tp_tour; ?>/js/jquery.material-cards.min.js"></script>
<script type="text/javascript" src="<?php echo $__tp_tour; ?>/js/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo $__tp_tour; ?>/js/maplace.js"></script>
<script type="text/javascript" src="<?php echo $__tp_tour; ?>/js/picturefill.min.js"></script>
<script type="text/javascript" src="<?php echo $__tp_tour; ?>/js/jquery.justifiedGallery.min.js"></script>

<!-- Chartjs -->
<script type="text/javascript" src="<?php echo $__tp_tour; ?>/chartjs/custom-utils.js"></script>
<script type="text/javascript" src="<?php echo $__tp_tour; ?>/chartjs/Chart.bundle.min.js"></script>

<!-- LightGallery -->
<script type="text/javascript" src="<?php echo $theme_dir; ?>/lightgallery/js/lightgallery.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_dir; ?>/lightgallery/js/lg-thumbnail.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_dir; ?>/lightgallery/js/lg-autoplay.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_dir; ?>/lightgallery/js/lg-zoom.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_dir; ?>/lightgallery/js/lg-hash.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_dir; ?>/lightgallery/js/lg-pager.min.js"></script>

<script type="text/javascript" src="<?php echo $__tp_tour; ?>/plyr/plyr.js"></script>
<!-- Google Maps -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKpwymHkXxpI1DJYCgGzzHfy3cO91XOa8&libraries=places&callback=initMap" async defer></script> -->

<!-- Custom JavaScript -->
<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-tourism.js"></script>

<?php get_footer(); ?>