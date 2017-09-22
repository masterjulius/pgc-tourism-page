<?php
	
	// ==================================
	// ====== Header Functions ==========
	function caganda_title() {

        if ( is_front_page() ) {
            $description = get_bloginfo( 'description' );
            echo bloginfo( 'name' ) . " &mdash; " . $description;
        } else {
            wp_title();
        }

    }


	function is_edit_page($new_edit = null) {
		global $pagenow;
		// make sure we are on the backend
		if (!is_admin()) return false;

		if ($new_edit == "edit")
			return in_array( $pagenow, array( 'post.php' ) );
		elseif ($new_edit == "new") // check for new post page
			return in_array( $pagenow , array( 'post-new.php' ) );
		else // check for either new or edit
			return in_array( $pagenow , array( 'post.php', 'post-new.php' ) );
	}

	// -------------------------------------------------------------------------------------------------------
	// ---------------------------------------- FETCHING FUNCTIONS -------------------------------------------
	// -------------------------------------------------------------------------------------------------------

	/**
	 * Fetching related articles for a certain post
	 * @see WP_Query
	 * @param string $query from the arguments of WP_Query class
	 * @param array/string $items_wrap html element structure for wrapping returned items
	 * @return html structure
	 */
	function get_related_articles( $post_id, $items_wrap = array(
			'header' => '<div class="cag-sidebar-title">
                  			<a href="#!"><i class="cagicon-flag"></i> Related Articles</a>
                		</div>', // header markup
			'before_content' => '<div class="card-content">
                  				<ul>', // 
			'before_item' => '<li>', //
			'after_item' => '</li>', //
			'after_content' => '</ul>
                				</div>', //  
			'footer' => '' // footer markup
		), $post_limit = 5, $order_by = 'date', $order = 'DESC' ) {

			// Code here

			$tags = wp_get_post_tags($post_id);
			if ( $tags ) {
				$tags_array = array();
				for ($i=0; $i < count($tags); $i++) { 
					array_push($tags_array, $tags[$i]->term_id);
				}
				$related_args = array(
					'post_type' => array( 'any' ),
					'tag__in' => $tags_array,
					'post__not_in' => array($post_id),
					'posts_per_page'=> $post_limit,
					'caller_get_posts'=> 1,
					'orderby' => $order_by,
					'order' => $order
				);

				$related_query = new WP_Query($related_args);
				if ( $related_query->have_posts() ) :
					echo $items_wrap['header'];
						echo $items_wrap['before_content'];
					while ($related_query->have_posts()) :
						$related_query->the_post();

						$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), array(100, 100));				
						$related_post_thumbnail = !empty($thumbnail_url) ? $thumbnail_url : get_stylesheet_directory_uri() . "/images/others/no-thumbnail_100x100.png";

						$item_data = '<a href="' . get_the_permalink() . '" class="waves-effect waves-light">
	                        <span class="news-side-img valign-wrapper">
								<img src="' . $related_post_thumbnail . '" class="z-depth-1 valign" />
	                        </span>
	                        <span class="news-side-text">
	                          <p>' . get_the_title() . '</p>
	                        </span>
	                      </a>';
						echo $items_wrap['before_item'] . $item_data . $items_wrap['after_item'];
					endwhile;
					wp_reset_query();
						echo $items_wrap['after_content'];
					echo $items_wrap['footer'];
				endif;

			}

		// End of code here
		
	}

	/**
	 * Fetching latest articles for a certain post
	 * @see WP_Query
	 * @param string $query from the arguments of WP_Query class
	 * @param array/string $items_wrap html element structure for wrapping returned items
	 * @return html structure
	 */
	function get_latest_articles( $post_id, $items_wrap = array(
			'header' => '<div class="cag-sidebar-title">
                  			<a href="#!"><i class="cagicon-flag"></i> Latest Articles</a>
                		</div>', // header markup
			'before_content' => '<div class="card-content">
                  				<ul>', // 
			'before_item' => '<li>', //
			'after_item' => '</li>', //
			'after_content' => '</ul>
                				</div>', //
			'footer' => '' // footer markup
		), $post_limit = 5, $order_by = 'date', $order = 'DESC' ) {

			$latest_args = array(
				'post__not_in' => array($post_id),
				'posts_per_page'=> $post_limit,
				'orderby' => $order_by,
				'order' => $order
			);
			$latest_query = new WP_Query($latest_args);
			if ( $latest_query->have_posts() ):
				echo $items_wrap['header'];
					echo $items_wrap['before_content'];
					while ($latest_query->have_posts()): $latest_query->the_post();
						
						$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), array(100,100));
						$latest_post_thumbnail = !empty($thumbnail_url) ? $thumbnail_url : get_stylesheet_directory_uri() . "/images/others/no-thumbnail_100x100.png";
						
						$item_data = '<a href="' . get_the_permalink() . '" class="waves-effect waves-light">
	                        <span class="news-side-img valign-wrapper">
								<img src="' . $latest_post_thumbnail . '" class="z-depth-1 valign" />
	                        </span>
	                        <span class="news-side-text">
	                          <p>' . get_the_title() . '</p>
	                        </span>
	                      </a>';

	                    echo $items_wrap['before_item'] . $item_data . $items_wrap['after_item'];

					endwhile;
					wp_reset_query();	
					echo $items_wrap['after_content'];
				echo $items_wrap['footer'];		
			endif;	

	}

	/**
	 * Fetching popular articles for a certain post
	 * @see WP_Query
	 * @param string $query from the arguments of WP_Query class
	 * @param array/string $items_wrap html element structure for wrapping returned items
	 * @return html structure
	 */

	function get_popular_posts( $post_id, $items_wrap = array(
			'header' => '<div class="cag-sidebar-title">
                  			<a href="#!"><i class="cagicon-flag"></i>  Popular Articles</a>
                		</div>', // header markup
			'before_content' => '<div class="card-content">
                  				<ul>', // 
			'before_item' => '<li>', //
			'after_item' => '</li>', //
			'after_content' => '</ul>
                				</div>', //
			'footer' => '' // footer markup
		), $post_limit = 5, $order = 'DESC' ) {
			$post_types_array = array("post", "announcements", "trivia", "doodle", "news", "videos");
			$popular_args = array(
				'post_type' => $post_types_array,
				'post__not_in' => array($post_id),
				'posts_per_page' => $post_limit,
				'meta_key' => 'wpb_post_views_count',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
			);

			$popular_query = new WP_Query($popular_args);
			if ( $popular_query->have_posts() ):
				echo $items_wrap['header'];
					echo $items_wrap['before_content'];
					while ($popular_query->have_posts()): $popular_query->the_post();
						$popular_post_thumbnail = '';
						if ( has_post_thumbnail() ) {
							$popular_post_thumbnail = '<img src="' . get_the_post_thumbnail_url(get_the_ID(), array(100,100)) . '" class="z-depth-1 valign" />';
						}
						$item_data = '<a href="' . get_the_permalink() . '" class="waves-effect waves-light">
	                        <span class="news-side-img valign-wrapper">' . $popular_post_thumbnail . '</span>
	                        <span class="news-side-text">
	                          <p>' . get_the_title() . '</p>
	                        </span>
	                      </a>';

	                    echo $items_wrap['before_item'] . $item_data . $items_wrap['after_item'];

					endwhile;
					wp_reset_query();	
					echo $items_wrap['after_content'];
				echo $items_wrap['footer'];		
			endif;

	}

	// ------------------------------ 1 post fetching ---------------------
	/**
	 * Fetching the top story post
	 * @see WP_Query
	 * @param int $post_id from the arguments of WP_Query class
	 * @param array/string $items_wrap html element structure for wrapping returned items
	 * @return html structure
	 */

	function get_top_story_post( $categories ) {
		$args = array(
			'post_type' => array('post', 'events', 'announcements', 'image-slider', 'trivia', 'doodle', 'gallery', 'news', 'videos'),
			'category__and' => $categories,
			'orderby' => 'date',
			'order' => 'DESC'
		);
		$returnValue = null;
		$query = new WP_Query($args);
		if ( $query->have_posts() ):
			$query->the_post();
			$array_post_data = array();
			$array_post_data['title'] = get_the_title();
			$array_post_data['content'] = get_the_excerpt();
			$array_post_data['thumbnail'] = get_the_post_thumbnail_url();
			$array_post_data['permalink'] = get_the_permalink();
			$array_post_data['post-date'] = get_the_date();
			$array_post_data['author'] = get_the_author();
			$returnValue = $array_post_data;
		endif;
		wp_reset_query();
		return $returnValue;

	}

	/**
	 * Fetching the latest post
	 * @see WP_Query
	 * @param int $post_id from the arguments of WP_Query class
	 * @param array/string $items_wrap html element structure for wrapping returned items
	 * @return html structure
	 */

	function get_latest_post( $categories ) {

		$args = array(
			'post_type' => array('post', 'events', 'announcements', 'image-slider', 'trivia', 'doodle', 'gallery', 'news', 'videos'),
			'orderby' => 'date',
			'order' => 'DESC'
		);
		$returnValue = null;
		$query = new WP_Query($args);
		if ( $query->have_posts() ):
			$query->the_post();
			$array_post_data = array();
			$array_post_data['title'] = get_the_title();
			$array_post_data['content'] = get_the_excerpt();
			$array_post_data['thumbnail'] = get_the_post_thumbnail_url();
			$array_post_data['permalink'] = get_the_permalink();
			$array_post_data['post-date'] = get_the_date();
			$array_post_data['author'] = get_the_author();
			$returnValue = $array_post_data;
		endif;
		wp_reset_query();
		return $returnValue;

	}

	// ------------------------------ multiple post fetching with array data as returned values ---------------------
	// --------------------------------------------------------------------------------------------------------------
	// --------------------------------------------------------------------------------------------------------------

	/**
	 * Fetching the multiple latest post
	 * @see WP_Query
	 * @param int $post_id from the arguments of WP_Query class
	 * @param array/string $items_wrap html element structure for wrapping returned items
	 * @return html structure
	 */
	function get_the_related_articles( $post_id = null, $post_limit = 6, $order_by = "date", $order = "DESC" ) {

		$returnValue = null;
		// if argument query is not set
		$tags = wp_get_post_tags($post_id);
		if ( $tags ) {
			$tags_array = array();
			for ($i=0; $i < count($tags); $i++) { 
				array_push($tags_array, $tags[$i]->term_id);
			}
			$related_args = array(
				'post_type' => array( 'any' ),
				'tag__in' => $tags_array,
				'post__not_in' => array($post_id),
				'posts_per_page'=> $post_limit,
				'caller_get_posts'=> 1,
				'orderby' => $order_by,
				'order' => $order
			);

			$related_query = new WP_Query($related_args);
			if ( $related_query->have_posts() ) :
				$array_data = array();
				while ( $related_query->have_posts() ):
					$related_query->the_post();
					// set the array variable for each associative
					$array_row_datas = array(
						'title' => get_the_title(),
						'content' => get_the_content(),
						'excerpt' => get_the_excerpt(),
						'permalink' => get_the_permalink(),
						'thumbnail' => get_the_post_thumbnail_url(),
						'post-date' => get_the_date(),
						'author' => get_the_author()
					);
					array_push($array_data, $array_row_datas);
				endwhile;
				wp_reset_postdata();
				$returnValue = $array_data;
			endif;	

		}
		return $returnValue;

	}

	/**
	 * Fetching the multiple latest post
	 * @see WP_Query
	 * @param int $post_id from the arguments of WP_Query class
	 * @param array/string $items_wrap html element structure for wrapping returned items
	 * @return html structure
	 */
	function get_the_latest_posts( $args = null, $exclude = array() ) {

		$returnValue = null;
		if ( null != $args ) {
			// if has custom query
			$query = new WP_Query($args);
			if ($query->have_posts()):
				$array_data = array();
				while ($query->have_posts()):$query->the_post();
					// set the array variable for each associative
					$array_row_datas = array(
						'title' => get_the_title(),
						'content' => get_the_content(),
						'excerpt' => get_the_excerpt(),
						'permalink' => get_the_permalink(),
						'thumbnail' => get_the_post_thumbnail_url(),
						'post-date' => get_the_date(),
						'author' => get_the_author()
					);
					array_push($array_data, $array_row_datas);
				endwhile;
				wp_reset_postdata();
				$returnValue = $array_data;
			endif;

		} else {
			// if has no custom query
			$post_types_array = array("post", "announcements", "trivia", "doodle", "news", "videos");
			$latest_args = array(
				'post_type' => $post_types_array,
				'post__not_in' => $exclude,
				'posts_per_page' => 5,
				'orderby' => 'date',
				'order' => 'DESC'
			);
			$query = new WP_Query($latest_args);
			if ($query->have_posts()):
				$array_data = array();
				while ($query->have_posts()):$query->the_post();
					// set the array variable for each associative
					$array_row_datas = array(
						'title' => get_the_title(),
						'content' => get_the_content(),
						'excerpt' => get_the_excerpt(),
						'permalink' => get_the_permalink(),
						'thumbnail' => get_the_post_thumbnail_url(),
						'post-date' => get_the_date(),
						'author' => get_the_author()
					);
					array_push($array_data, $array_row_datas);
				endwhile;
				wp_reset_postdata();
				$returnValue = $array_data;
			endif;

		}
		return $returnValue;

	}

	/**
	 * Fetching the multiple popular post
	 * @see WP_Query
	 * @param int $post_id from the arguments of WP_Query class
	 * @param array/string $items_wrap html element structure for wrapping returned items
	 * @return html structure
	 */
	function get_the_popular_posts( $args = null, $exclude = array() ) {

		$returnValue = null;
		if ( null != $args ) {
			// if has custom query
			$query = new WP_Query($args);
			if ($query->have_posts()):
				$array_data = array();
				while ($query->have_posts()):$query->the_post();
					// set the array variable for each associative
					$array_row_datas = array(
						'title' => get_the_title(),
						'content' => get_the_content(),
						'excerpt' => get_the_excerpt(),
						'permalink' => get_the_permalink(),
						'thumbnail' => get_the_post_thumbnail_url(),
						'post-date' => get_the_date(),
						'author' => get_the_author()
					);
					array_push($array_data, $array_row_datas);
				endwhile;
				wp_reset_postdata();
				$returnValue = $array_data;
			endif;

		} else {
			// if has no custom query
			$post_types_array = array("post", "announcements", "trivia", "doodle", "news", "videos");
			$popular_args = array(
				'post_type' => $post_types_array,
				'post__not_in' => $exclude,
				'posts_per_page' => 5,
				'meta_key' => 'wpb_post_views_count',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
			);
			$query = new WP_Query($popular_args);
			if ($query->have_posts()):
				$array_data = array();
				while ($query->have_posts()):$query->the_post();
					// set the array variable for each associative
					$array_row_datas = array(
						'title' => get_the_title(),
						'content' => get_the_content(),
						'excerpt' => get_the_excerpt(),
						'permalink' => get_the_permalink(),
						'thumbnail' => get_the_post_thumbnail_url(),
						'post-date' => get_the_date(),
						'author' => get_the_author()
					);
					array_push($array_data, $array_row_datas);
				endwhile;
				wp_reset_postdata();
				$returnValue = $array_data;
			endif;

		}
		return $returnValue;

	}

	// -------------------------------------------------------------------------------------------------
	// --------------------------------------- POST DATA RETRIEVING ------------------------------------
	function get_author_full_name($author_id) {
	    $fname = get_the_author_meta('first_name', $author_id);
	    $lname = get_the_author_meta('last_name', $author_id);
	    $full_name = '';

	    if( empty($fname)){
	      $full_name = $lname;
	    } elseif( empty( $lname )){
	      $full_name = $fname;
	    } else {
	        //both first name and last name are present
	        $full_name = "{$fname} {$lname}";
	    }

	    return $full_name;
  	}

  	function get_author_name_info($author_id) {
    	$name = get_author_full_name($author_id);
    	if ( empty( $name ) ) {
      		$name = get_the_author('nickname');
    	}
    	return $name;
  	}

  	function get_author_img_url( $author_id ) {

    	$author_avatar_url = get_avatar_url( $author_id );
    	$img_url = $author_avatar_url;
    	if ( function_exists( 'get_cupp_meta' ) ) {
      		if ( !empty( get_cupp_meta($author_id, $size = array(100,100)) ) ) {
        		$img_url = get_cupp_meta($author_id, $size);
      		}
    	}
    	return $img_url;
  	}

  	// -------------------------------------------------------------------------------------------------
  	// ------------------------------------ Social media buttons ---------------------------------------

  	// get social media pages
  	function get_social_media_pages($args) {
  	?>
  		<ul>
  			<li><a class="btn-floating waves-effect waves-light" href="<?php echo $args['facebook']; ?>" target="_blank"><i class="cagicon-facebook"></i></a></li>
          	<li><a class="btn-floating waves-effect waves-light" href="<?php echo $args['twitter']; ?>" target="_blank"><i class="cagicon-twitter"></i></a></li>
          	<li><a class="btn-floating waves-effect waves-light" href="<?php echo $args['google_plus']; ?>" target="_blank"><i class="cagicon-google-plus"></i></a></li>
          	<li><a class="btn-floating waves-effect waves-light" href="<?php echo $args['youtube']; ?>" target="_blank"><i class="cagicon-youtube-play"></i></a></li>
  		</ul>
  	<?php	
  	}

  	// get social media share buttons
  	function get_social_media_share_buttons($args) {
  	?>
  		<ul>
  			<li><a class="btn-floating waves-effect waves-light" href="<?php echo $args['facebook']; ?>" target="_blank"><i class="cagicon-facebook"></i></a></li>
          	<li><a class="btn-floating waves-effect waves-light" href="<?php echo $args['twitter']; ?>" target="_blank"><i class="cagicon-twitter"></i></a></li>
          	<li><a class="btn-floating waves-effect waves-light" href="<?php echo $args['google_plus']; ?>" target="_blank"><i class="cagicon-google-plus"></i></a></li>
          	<li><a class="btn-floating waves-effect waves-light" href="<?php echo $args['youtube']; ?>" target="_blank"><i class="cagicon-youtube-play"></i></a></li>
  		</ul>
  	<?php	
  	}

  	// --------------------------------------------------------------------------------------------
  	// --------------------------------------------------------------------------------------------

  	function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  		// return value
  		$returnValue = null;

	  	if (empty($pagerange)) {
	    	$pagerange = 2;
	  	}

	  	/**
	   	 * This first part of our function is a fallback
	   	 * for custom pagination inside a regular loop that
	   	 * uses the global $paged and global $wp_query variables.
	   	 * 
	   	 * It's good because we can now override default pagination
	   	 * in our theme, and use this function in default quries
	   	 * and custom queries.
	     */
	  	global $paged;
	  	if (empty($paged)) {
	    	$paged = 1;
	  	}
	  	if ($numpages == '') {
	    	global $wp_query;
	    	$numpages = $wp_query->max_num_pages;
	    	if(!$numpages) {
	        	$numpages = 1;
	    	}
	  	}

	  /** 
	   * We construct the pagination arguments to enter into our paginate_links
	   * function. 
	   */
	  	$pagination_args = array(
	    	'base'            => get_pagenum_link(1) . '%_%',
	    	'format'          => 'page/%#%',
	    	'total'           => $numpages,
	    	'current'         => $paged,
	    	'show_all'        => False,
	    	'end_size'        => 1,
	    	'mid_size'        => $pagerange,
	    	'prev_next'       => True,
	    	'prev_text'       => __('&laquo;'),
	    	'next_text'       => __('&raquo;'),
	    	'type'            => 'array',
	    	'add_args'        => false,
	    	'add_fragment'    => ''
	  	);

	  	$paginate_links = paginate_links($pagination_args);

	  	if ($paginate_links) {

	    	$returnValue = array();
	    	$returnValue['paged'] = $paged;
	    	$returnValue['numpages'] = $numpages;
	    	$returnValue['paginate_links'] = $paginate_links;

	  	}

	  	return $returnValue;

	}

	// ==============================================================================================================
	// ======================================== User Management Functions ===========================================
	//hooks
	add_action( 'show_user_profile', 'Add_user_fields' );
	add_action( 'edit_user_profile', 'Add_user_fields' );

	function Add_user_fields( $user ) {
?>
		<hr/>
		<h3>Employee Details</h3>
		<table class="form-table">

		    <tr>
		        <th><label for="dropdown">Department</label></th>
		        <td>
		        <?php 
		            //get dropdown saved value
		            $selected = get_the_author_meta( 'user_department', $user->ID ); //there was an extra ) here that was not needed

		            $dir_query = new WP_Query(
		            	array(
		            		'post_type' => 'directories',
		            		'orderby' => 'post_title',
		            		'order' => 'ASC',
		            		'posts_per_page'=>-1
		            	)
		            );
		        ?>
		            <select name="user_department" id="user_department">
		        <?php
		        	if ( $dir_query->have_posts() ):
		        		while ( $dir_query->have_posts() ):
		        			$dir_query->the_post();
		        			$the_id = get_the_ID();
		        			$the_title = get_the_title();
		        			$the_selected = $selected == $the_id ? 'selected="selected"' : '';
		        ?>			
		        			<option value="<?php echo $the_id; ?>" <?php echo $the_selected; ?>><?php echo $the_title; ?></option>
		        <?php			
		        		endwhile;
		        		wp_reset_postdata();	
		        	endif;	
		        ?>
					</select>
					<br />

		            <span class="description">Choose the Office</span>
		        </td>
		    </tr>
		</table>
<?php
	}

	add_action( 'personal_options_update', 'save_user_fields' );
	add_action( 'edit_user_profile_update', 'save_user_fields' );

	function save_user_fields( $user_id ) {

		if ( !current_user_can( 'edit_user', $user_id ) )
		    return false;

		//save dropdown
		update_usermeta( $user_id, 'user_department', $_POST['user_department'] );
	}

/** ==================================================================================================== */
// custom post types function

$download_cpt_args = array(
	'public' => true,
	'label' => 'DOWNLOADS',
	'labels' => array(
	    'all_items' => 'View All'
	),
	'menu_position' => 10,
	'menu_icon' => 'dashicons-portfolio',
	'supports' => array(
	    'title',
	    'editor',
	    'thumbnail',
		'excerpt'
	),
	'capability_type' => array('download', 'downloads'),
	'map_meta_cap' => true,
	'show_in_menu' => false,
	'public' => true,
);
register_post_type('downloads', $download_cpt_args);
add_action('admin_menu', 'cag_downloads_submenu_action'); 
function cag_downloads_submenu_action() { 
	add_submenu_page('pgc_menu_group', 'DOWNLOADS', 'DOWNLOADS', 'manage_options', 'edit.php?post_type=downloads', NULL, 'dashicons-portfolio', 2);
}

// generate meta box for this cpt
function cag_downloads_register_meta_box( $meta_boxes ) {

	$prefix = 'cag_downloads_register_meta_box_';

	// 1st meta box
	$meta_boxes[] = array(
	    'id'         => $prefix . 'downloads_info_id',
	    'title'      => __( 'Downloads File Box', 'textdomain' ),
	    'post_types' => array( 'downloads' ),
	    'context'    => 'normal',
	    'priority'   => 'high',
	    'fields' => array(
		    array(
		        'name'  => __( 'Files', 'textdomain' ),
		        'desc'  => 'Set the downloadable files here.',
		        'id'    => $prefix . 'downloadable_files_id',
		        'type'  => 'file_advanced',
		        'class' => $prefix . 'custom-class',
		        'clone' => false,
		        'mime_type' => 'application/pdf',	                
		    ),
		)
	);

	return $meta_boxes;

}
// intialize meta box
add_filter( 'rwmb_meta_boxes', 'cag_downloads_register_meta_box' );

// End of custom post types function

// ===================================== FILE SYSTEM =========================================
function getFileSize($file) {
	$bytes = filesize($file);
	$s = array('b', 'Kb', 'Mb', 'Gb');
	$e = floor(log($bytes)/log(1024));
	return sprintf('%.2f '.$s[$e], ($bytes/pow(1024, floor($e))));
}

//============================================ Doodle Functions ==========================================
function ajax_doodle_enqueues() {

	if ( !is_admin() && is_single() && get_post_type() == "doodle" ) {
		wp_register_script( 'ajax-doodle', get_stylesheet_directory_uri() . '/js/single-doodle.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'ajax-doodle' );
		wp_localize_script( 'ajax-doodle', 'myAjaxDoodle', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'themedir' => get_stylesheet_directory_uri() ) );
	}

}
add_action( 'wp_enqueue_scripts', 'ajax_doodle_enqueues' );	

// previous from post id parameter
function get_previous_post_id( $post_id ) {
    // Get a global post reference since get_adjacent_post() references it
    global $post;

    // Store the existing post object for later so we don't lose it
    $oldGlobal = $post;

    // Get the post object for the specified post and place it in the global variable
    $post = get_post( $post_id );

    // Get the post object for the previous post
    $previous_post = get_previous_post();

    // Reset our global object
    $post = $oldGlobal;

    if ( '' == $previous_post ) {
        return null;
    }

    return $previous_post->ID;
}

// next from post id parameter
function get_next_post_id( $post_id ) {
    // Get a global post reference since get_adjacent_post() references it
    global $post;

    // Store the existing post object for later so we don't lose it
    $oldGlobal = $post;

    // Get the post object for the specified post and place it in the global variable
    $post = get_post( $post_id );

    // Get the post object for the previous post
    $next_post = get_next_post();

    // Reset our global object
    $post = $oldGlobal;

    if ( '' == $next_post ) {
        return null;
    }

    return $next_post->ID;
}

function get_single_doodle_details() {
	$post_id = $_POST['post_id'];

	// meta values
	$meta_prefix = "cag_doodle_register_meta_box_";

	$sktch_img_thumb = array(); $grphc_img_thumb = array(); $anmtn_img_thumb = array();

	// IMAGES
	if ( !empty(get_post_meta( $post_id, $meta_prefix . "artist_sktch_image_id") ) ) {
		$sktch_img_details = rwmb_meta( $meta_prefix . "artist_sktch_image_id", "image", $post_id );
		if ( !empty( $sktch_img_details ) ) {
			foreach ($sktch_img_details as $sktch_img) {
				$sktch_img_thumb = array(
					"url" => $sktch_img['full_url'],
					"alt" => !empty($sktch_img['alt']) ? $sktch_img['alt'] : 'Cagayan Doodle Sketch Artist',
				);	
			}
		}
	}

	if ( !empty(get_post_meta( $post_id, $meta_prefix . "artist_grphc_image_id") ) ) {
		$grphc_img_details = rwmb_meta( $meta_prefix . "artist_grphc_image_id", "image", $post_id );
		if ( !empty( $grphc_img_details ) ) {
			foreach ($grphc_img_details as $grphc_img) {
				$grphc_img_thumb = array(
					"url" => $grphc_img['full_url'],
					"alt" => !empty($grphc_img['alt']) ? $grphc_img['alt'] : 'Cagayan Doodle Graphic Artist',
				);	
			}
		}
	}

	if ( !empty(get_post_meta( $post_id, $meta_prefix . "artist_anmtn_image_id") ) ) {
		$anmtn_img_details = rwmb_meta( $meta_prefix . "artist_anmtn_image_id", "image", $post_id );
		if ( !empty( $anmtn_img_details ) ) {
			foreach ($anmtn_img_details as $anmtn_img) {
				$anmtn_img_thumb = array(
					"url" => $anmtn_img['full_url'],
					"alt" => !empty($anmtn_img['alt']) ? $anmtn_img['alt'] : 'Cagayan Doodle Animation Artist',
				);	
			}
		}
	}

	$sktch_img_thumb["url"] = !empty($sktch_img_thumb["url"]) ? $sktch_img_thumb["url"] : get_stylesheet_directory_uri() . "/images/svg/animal-icons/pig-1.svg";
	$grphc_img_thumb["url"] = !empty($grphc_img_thumb["url"]) ? $grphc_img_thumb["url"] : get_stylesheet_directory_uri() . "/images/svg/animal-icons/panda-3.svg";
	$anmtn_img_thumb["url"] = !empty($anmtn_img_thumb["url"]) ? $anmtn_img_thumb["url"] : get_stylesheet_directory_uri() . "/images/svg/animal-icons/dog-1.svg";

	// NAMES
	$sktch_artist_name = rwmb_meta( $meta_prefix . "artist_sktch_name_id", "type=text", $post_id );							
	$grphc_artist_name = rwmb_meta( $meta_prefix . "artist_grphc_name_id", "type=text", $post_id );							
	$anmtn_artist_name = rwmb_meta( $meta_prefix . "artist_anmtn_name_id", "type=text", $post_id );

	$sktch_img_thumb["artist-name"] = !empty($sktch_artist_name) ? $sktch_artist_name : "Julius B. Palcong";
	$grphc_img_thumb["artist-name"] = !empty($grphc_artist_name) ? $grphc_artist_name : "Abigail C. Pineda";
	$anmtn_img_thumb["artist-name"] = !empty($anmtn_artist_name) ? $anmtn_artist_name : "Mark Maynard A. Guzman";					

	$arrayRet = array(
		"title" => get_the_title( $post_id ),
		"thumbnail" => get_the_post_thumbnail_url( $post_id ),
		"content" => get_post_field('post_content', $post_id),
		"date" => get_the_date( $format, $post_id ),
		"permalink" => get_the_permalink( $post_id ),
		"previous" => get_previous_post_id( $post_id ),
		"next" =>  get_next_post_id( $post_id ),
		"artists" => array(
			"sktch_artist" => array(
				"name" => $sktch_img_thumb["artist-name"],
				"thumbnail" => $sktch_img_thumb["url"],
				"alt" => $sktch_img_thumb["alt"]
			),
			"grphc_artist" => array(
				"name" => $grphc_img_thumb["artist-name"],
				"thumbnail" => $grphc_img_thumb["url"],
				"alt" => $grphc_img_thumb["alt"]
			),
			"anmtn_artist" => array(
				"name" => $anmtn_img_thumb["artist-name"],
				"thumbnail" => $anmtn_img_thumb["url"],
				"alt" =>  $anmtn_img_thumb["alt"]
			)
		)
	);
	wp_send_json($arrayRet);

} // end function
add_action( 'wp_ajax_get_single_doodle_details', 'get_single_doodle_details' );
add_action( 'wp_ajax_nopriv_get_single_doodle_details', 'get_single_doodle_details' );

?>