<?php 
	show_admin_bar(false);

	add_theme_support( 'post-thumbnails' );
	/**
	 * Register our sidebars and widgetized areas.
	 *
	 */

	/**
	 * Removes width and height attributes from image tags
	 *
	 * @param string $html
	 *
	 * @return string
	 */
	add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
	add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

	function remove_width_attribute( $html ) {
	   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	   return $html;
	}
	
	// Add Menu Options
	function register_my_menus() {
	  register_nav_menus(
	    array(
	      'header-menu' => __( 'Header Menu' ),
	      'tourism-section-menu' => __( 'Tourism Section Menu' ),
	      'extra-menu' => __( 'Extra Menu' )
	    )
	  );
	}
	add_action( 'init', 'register_my_menus' );

	function arphabet_widgets_init() {

		register_sidebar( array(
			'name'          => 'Navbar Widget',
			'id'            => 'widget-1',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => 'Home Image Slider',
			'id'            => 'widget-2',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => 'Doodle Header',
			'id'            => 'widget-3',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => 'Home Main Contents',
			'id'            => 'widget-4',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => 'Home right sidebar',
			'id'            => 'widget-5',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => 'Pre-Footer',
			'id'            => 'widget-6',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => 'Footer',
			'id'            => 'widget-7',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		) );

	}
	add_action( 'widgets_init', 'arphabet_widgets_init' );

	// =========================================================================================================
	/**
	 * This is for the image cropping actions
	 */
	// add_image_size( 'cag-activities-thumbnail-size', 500, 263, true );

	function my_add_excerpts_to_pages() {
    	add_post_type_support('page', 'excerpt');
	}
	add_action('init', 'my_add_excerpts_to_pages');

	/* Custom Post Fields */
	function support_acfpb( $support = array() ) {

	    $support['post_type'] = array(
	        'page',
	        'post'
	    );

	    $support['page_template'] = array(
	        'page-templates/page-sectioned.php'
	    );

	    return $support;

	}
	add_filter('acfpb_set_locations', 'support_acfpb', 10, 1);

	// Set Uploading Options
	@ini_set( 'upload_max_size' , '64M' );
	@ini_set( 'post_max_size' , '64M' );
	@ini_set( 'max_execution_time' , '300' );

	/* Add the custom function for this theme
	 * 
	 */
	require_once('include-functions/cag-custom-functions.php');

	// * Required Files
	require_once('include-functions/themeblvd_time_ago.php');


	// ========================================= Review afterwards if you shoul transfer it =========================
	// View Counter
	function wpb_set_post_views($postID) {
	    $count_key = 'wpb_post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        $count = 0;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	    }else{
	        $count++;
	        update_post_meta($postID, $count_key, $count);
	    }
	}
	// To keep the count accurate, lets get rid of prefetching
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	// Return Post Views Count
	function wpb_get_post_views($postID){
	    $count_key = 'wpb_post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	        return "0 View";
	    }
	    return $count.' Views';
	}

	// =================================== Review afterwards if you shoul transfer it =================================
	
/**
 * Registering the PGC parent menu
 */
if ( empty($GLOBALS['admin_page_hooks']['pgc_menu_group']) ) {
	// if parent menu does not exists then add the menu

	add_action( 'admin_menu', function(){

		add_menu_page(
			'PGC',
			'PGC',
			'read',
			'pgc_menu_group',
			'cag_menu_action',
			get_stylesheet_directory_uri() . '/images/icons/map-icon(optimized).svg',
			5
		);
		
	});

	function cag_menu_action(){
		echo "<h1>Welcome To PGC Main</h1>";
	}

}

?>