<?php 
/*
 * Template Name: Cagayan Downloads Page
 * The Downloads page template file
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
$page_id = get_the_ID();
$file_prefix = 'cag_downloads_register_meta_box_';
$download_args = array(
	'post_type' => 'downloads',
	'orderby' => 'title',
	'order' => 'ASC'
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-downloads.min.css" />

<!-- PAGE -->
<div class="cag-page-downloads cag-page-template">

    <div class="row downloads-tabs-btn">
        <div class="col s12 downloads-tabs-items">
          	<h1>Downloads</h1>
          	<ul class="tabs">
<?php
$cat_query = new WP_Query($download_args);
if ( $cat_query->have_posts() ):
	$index_cat = 1;
	while ( $cat_query->have_posts() ) : $cat_query->the_post();
	$current_active = $index_cat === 1 ? "active" : "";
?>
            	<li class="tab"><a href="#f<?php echo $index_cat; ?>" class="waves-effect <?php echo $current_active; ?>"><?php echo get_the_title(); ?></a></li>
<?php
	$index_cat++;
	endwhile;
	wp_reset_postdata();
endif;
?>            	
          	</ul>
        </div>
    </div>
	
	<div class="downloads-tabs">

	    <div class="row">

<?php
$data_query = new WP_Query($download_args);
if ( $data_query->have_posts() ):
	$index_data = 1;
	while ( $data_query->have_posts() ) : $data_query->the_post();
		$data_id = get_the_ID();
?>
	        <div id="f<?php echo $index_data; ?>" class="col s12 downloads-contents">
	            <table class="responsive-table">
	              	<thead>
	                	<tr>
	                  		<th data-field="icon"> </th>
	                  		<th data-field="filename">Filename</th>
	                  		<th data-field="size">Size</th>
	                  		<th data-field="date">Date</th>
	                  		<th data-field="download">Download/View</th>
	                	</tr>
	              	</thead>

	              	<tbody>
<?php
$file_meta_id = 'cag_downloads_register_meta_box_downloadable_files_id';
$type = 'type=file';
$cag_meta_box_files = rwmb_meta( $file_meta_id, $type, $data_id );
if ( !empty( $cag_meta_box_files ) ) {
	// echo "<pre>";
	// print_r($cag_meta_box_files);
	// echo "<pre>";

	foreach ($cag_meta_box_files as $cag_meta_box_files_value) {
		$file_id = $cag_meta_box_files_value["ID"]; // ID
		$name = $cag_meta_box_files_value["name"]; // name
		$title = $cag_meta_box_files_value["title"]; // title
		$path = $cag_meta_box_files_value["path"]; // path
		$url = $cag_meta_box_files_value["url"]; // full url
		// $desc = $cag_meta_box_files_value["url"]; // full url
		$file_size = getFileSize( get_attached_file( $file_id ) );

?>	              	             	
		                <tr>
		                  	<td><i class="cagicon-file-pdf"></i></td>
		                  	<td>
		                    	<p><?php echo $title; ?></p>
		                    	<p>No Desciption</p>
		                  	</td>
		                  	<td><?php echo $file_size; ?></td>
		                  	<td>Febuary 30, 2017</td>
		                  	<td>
		                    	<a href="<?php echo $url; ?>" class="waves-effect" download="<?php echo $title; ?>"><i class="cagicon-download"></i></a>
		                    	<a href="<?php echo $url; ?>" class="waves-effect"><i class="cagicon-file-find"></i></a>
		                  	</td>
		                </tr>
<?php
	}
}
?>
	              </tbody>
	            </table>

	        </div>
<?php
	$index_data++;
	endwhile;
	wp_reset_postdata();
endif;
?>	        
	    </div>
		
	</div>

</div>
<!-- END PAGE -->

<?php
get_footer();
?>