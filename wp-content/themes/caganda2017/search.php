<?php
get_header();
$theme_dir = get_stylesheet_directory_uri();

global $query_string;
$query_args = explode("&", $query_string);
$search_query = array();

if( strlen($query_string) > 0 ) {
	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	} // foreach
} //if
$search_query['s'] = urldecode($search_query['s']);
// echo "<h1>".$search_query['s'] ."</h1>";

?>

<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-search.min.css" />
<script type="text/javascript">var sSuggestArr={};</script>
	
	<div class="cag-page-search cag-page-template">

		<div class="row search-header">
			<div class="col s12 m12 l12 search-parent">
				<form action="<?php echo site_url('/search/'); ?>" method="get" onsubmit="return false;">
					<input type="txtSearch" name="search" id="txtSearch" placeholder="Search..." autofocus onchange="window.location.href=this.form.action + this.form.search.value + '/';" />
					<button type="submit" value="" class="btn" id="btnSearch" onclick="window.location.href=this.form.action + this.form.search.value + '/';"><i class="cagicon-search"></i></button>
				</form>
			</div>
          	
        </div> 

        <div class="row search-container-parent">
 			
 			<div class="container search-container-main">
<?php
		// print_r($search_query);
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$search = new WP_Query(
			array(
				'post_status' => 'publish',
		        'post_type' => array('any'),
		        'posts_per_page' => 12,
		        's' => $search_query['s'],
		        'paged' => $paged,
	      		'page' => $paged
			)
		);
		if ( $search->have_posts() ):
?>	
			<div class="row result-info-row">
				<h4 class="result-label"><?php echo number_format( $search->found_posts ); ?> possible results for: &ldquo;<b><?php echo $search_query['s']; ?></b>&rdquo;</h4>
			</div>
			
			<div class="row result-set-row">

				<div class="col s12 m8 l8">
<?php
					$index = 0;
					while ( $search->have_posts() ):
						$search->the_post();
						$post_id = get_the_ID();
						$author_id = get_the_author_meta( 'ID' );
						$author_dept_office = get_the_title( get_user_meta($author_id, 'user_department', true) );

						$post_thumbnail_value = has_post_thumbnail() ? get_the_post_thumbnail_url( $post_id ) : null;
						echo '<script type="text/javascript">sSuggestArr["'.get_the_title().'"]="'.$post_thumbnail_value.'"</script>';

						// if page 1
						if ( $paged < 2 ) {
							
							if ( $index == 0 ) {
								echo '<div class="row result-set-vertical">';
								echo '<div class="col s12 m12 l12 result-set-top"><h5>Top results</h5></div>';
							}

							if ( $index == 3 ) {
								echo '</div>';
							}
						}	

						if ( $index < 3 ) {
							// column type
							if ( $paged < 2 ) {
								// if page 1
								$vert_index  = $index == 1 ? 'vert-card-first' : '';
?>							
							    <div class="col s12 m4 l4 result-set-item <?php echo $vert_index; ?>">

							        <div class="card">

							            <div class="card-image">
									<?php if ( has_post_thumbnail() ):  ?>					            
							              	<img src="<?php echo get_the_post_thumbnail_url($post_id, array(300,169)); ?>" />
							        <?php endif; ?>      	
							              	<!--- <span class="card-title">Card Title</span> -->
							            </div>

							            <div class="card-content">
							              	<p><?php echo get_the_title(); ?></p>
							            </div>

							            <div class="card-action">
							              	<a href="<?php echo get_the_permalink(); ?>">Read Article</a> &mdash; 
							              	<span><?php echo human_time_diff( get_the_date('U') ); ?> ago</span>
							            </div>

							        </div>

							    </div>

<?php
							} else { // else if the next pages
?>
								<div class="row result-set-horizontal" data-result-id="<?php echo $post_id ?>" data-result-index="<?php echo $index; ?>">
									<a href="<?php echo get_the_permalink(); ?>" class="result-set-title"><h4><?php echo get_the_title(); ?></h4></a>
									<a href="<?php echo get_the_permalink(); ?>" class="result-set-permalink"><?php echo get_the_permalink(); ?></a>
									<p class="result-set-content"><?php echo wp_trim_words( get_the_content(), 10, '...' ); ?></p>
								</div>
<?php
							}
				

						} else {
?>					
							<div class="row result-set-horizontal" data-result-id="<?php echo $post_id ?>" data-result-index="<?php echo $index; ?>">
								<a href="<?php echo get_the_permalink(); ?>" class="result-set-title"><h4><?php echo get_the_title(); ?></h4></a>
								<p href="<?php echo get_the_permalink(); ?>" class="result-set-permalink"><?php echo get_the_permalink(); ?></p>
								<p class="result-set-content"><?php echo wp_trim_words( get_the_content(), 10, '...' ); ?></p>
							</div>

<?php
						}

						// end if
						$index++;	
					endwhile;
					wp_reset_postdata();
?>
				</div>

			</div>

			<div class="row pagination-row">
<?php
				$pagination = custom_pagination($search->max_num_pages,"",$paged);
					// check if you if can paginate
					if ( $pagination ){
?>
						<!-- ======================================= -->
							<!-- Pagination -->
						<div class="cag-page-new-pagination-row">
							<div class="col l12 m12 s12">
				          		<div class="cag-page-new-pagination">
					            	<ul class="pagination">
										
								<?php
								// print_r($pagination);
									foreach ($pagination['paginate_links'] as $paginate_links) {
										echo "<li class='waves-effect'>{$paginate_links}</li>";
									}
								?>		

					            	</ul>
				          		</div>
				        	</div>
				        </div>
					        <!-- End of Pagination -->
							<!-- ======================================= -->
<?php
					}	
?>				
			</div>

<?php
		endif;
?>
			
			</div>

		</div>	

	</div>

	<script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-search.js"></script>

<?php

get_footer();
?>