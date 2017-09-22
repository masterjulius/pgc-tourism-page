<?php 
/*
 * Plugin Name: Cag-Visit Cagayan Section
 * Plugin URI: http://www.caganda2025.com
 * Description: A Custom Tourism section that contains links for tourism exclusively for Cagayan.
 * Version: 1.0.0
 * Author: PPDO IT-Division
 * Author URI: http://www.cagayan.gov.ph
*/

/**
 * Adds Cag_Visit_Cagayan widget.
*/

class Cag_Visit_Cagayan extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'cag_visit_cagayan_widget', // Base ID
			__( 'Cag-Visit Cagayan Section', 'text_domain' ), // Name
			array( 'description' => __( 'A Custom Tourism section that contains links for tourism exclusively for Cagayan.', 'text_domain' ), ) // Args
		);

		// Add the build in wordpress custom post type and meta box
		add_action( 'init', array( $this, 'cag_cpt_tourism_options' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'cag_meta_box_tourism_init' ) );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$nav_menu = $instance['nav_menu'];
		$pagename = $instance['pagename'];
		$linkname = $instance['linkname'];
		echo $before_widget;
		if ( !$title ):
			$title = "TOURISM";
		endif;

		// $asc_sort_order = (isset( $instance['asc_sort_order'] ) && $instance['asc_sort_order']) ? 'ASC' : 'DESC';

		$args = array( 'widget_title' => $title, 'nav_menu' => $nav_menu, 'page_source' => $pagename,  'linkname' => $linkname );

		$this->view($args);
		echo $after_widget;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if( $instance) {
			$title = esc_attr($instance['title']);
			$nav_menu = esc_attr($instance['nav_menu']);
			$pagename = esc_attr($instance['pagename']);
			$linkname = esc_attr($instance['linkname']);
		} else {
			$title = '';
			$nav_menu = '';
			$pagename = '0';
			$linkname = '';
		}

		// Get menus
		$menus = wp_get_nav_menus();

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'cag_visit_cagayan_widget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
            <label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
				<?php foreach ( $menus as $menu ) : ?>
					<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
						<?php echo esc_html( $menu->name ); ?>
					</option>
				<?php endforeach; ?>
			</select>
        </p>

        <p>
            <label>
                <?php _e( 'Visit Cagayan Page',TEXTDOMAIN ); ?>
                <?php wp_dropdown_pages( array( 'hide_empty'=> 0, 'name' => $this->get_field_name("pagename"), 'value_field' => 'post_id', 'selected' => $pagename, 'show_option_none' => '&mdash; Select &mdash;', 'option_none_value' => '0' ) ); ?>
            </label>
        </p>

        <p>
			<label for="<?php echo $this->get_field_id('linkname'); ?>"><?php _e('Link Label', 'cag_visit_cagayan_widget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkname'); ?>" name="<?php echo $this->get_field_name('linkname'); ?>" type="text" value="<?php echo $linkname; ?>" />
		</p>

		<?php

	}	

	/**
	 * The Front End View
	 */
	private function view( $args ) { //html
		// get scripts
		$this->get_scripts();
		$nav_menu = $args["nav_menu"];
		$permalink = get_the_permalink($args["page_source"]);
		?>

		<!-- VISIT CAGAYAN -->
	    <div class="cag-visit-cagayan">
	      	<div class="container-fluid">
	        	<div class="row">
	          		<div class="col s12">
	            		<div class="card hoverable">
			              	<div class="cag-visit-cagayan-title">
			                	<a href="<?php echo $permalink; ?>" target="_blank"><i class="cagicon cagicon-tourism"></i><?php echo $args['widget_title']; ?></a>
			              	</div>

			              	<div class="card-content">
				                
			              	<?php wp_nav_menu( array( 'menu' => $nav_menu, 'menu_class' => 'cag-visit-cagayan-menu-group' ) ); ?>	

			              	</div>

			              	<div class="cag-visit-cagayan-footer">
			                	<a href="<?php echo $permalink; ?>" class="cag-visit-cagayan-more" target="_blank"><?php echo $args['linkname']; ?><i class="cagicon cagicon-arrow_forward"></i></a>
			              	</div>

	            		</div>
	          		</div>
	        	</div>
	      	</div>
	    </div><!-- END VISIT CAGAYAN -->

		<?php

	}

	/** Call Scripts */
	private function get_scripts( $prefix = null ){
		$dir = plugin_dir_url(__FILE__);
    ?>
    	<!--- CSS -->
    	<link rel="stylesheet" href="<?php echo $dir; ?>cssfonts/animation.css" type="text/css" media="all" />
    	<link rel="stylesheet" href="<?php echo $dir; ?>cssfonts/cagicon.css" type="text/css" media="all" />
    	<link rel="stylesheet" href="<?php echo $dir; ?>cssfonts/cagicon-codes.css" type="text/css" media="all" />
    	<link rel="stylesheet" href="<?php echo $dir; ?>cssfonts/cagicon-embedded.css" type="text/css" media="all" />
    	<link rel="stylesheet" href="<?php echo $dir; ?>cssfonts/cagicon-ie7.css" type="text/css" media="all" />
    	<link rel="stylesheet" href="<?php echo $dir; ?>cssfonts/cagicon-ie7-codes.css" type="text/css" media="all" />
    	<!--- Custom CSS -->
    		<!--- Custom -->
    	<link rel="stylesheet" href="<?php echo $dir; ?>css/cag-visit-cagayan.css" type="text/css" media="all" />	
    	<!--- JS -->
    		<!--- Custom -->
    	<script type="text/javascript" src="<?php echo $dir; ?>js/cag-visit-cagayan.js"></script>
    <?php

	}

	/** end of function view and fetch enquee scripts */

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['nav_menu'] = strip_tags($new_instance['nav_menu']);
		$instance['pagename'] = strip_tags($new_instance['pagename']);
		$instance['linkname'] = strip_tags($new_instance['linkname']);
		return $instance;
	}

	/**
	 * Custom Functions
	 * For this Plugin
	 */

	public function cag_cpt_tourism_options() {
		// Top Visited
		$cpt_top_visited = array(
	        'public'			=>	true,
	        'label'				=>	'TOP VISITED',
	        'labels'			=>	array(
	        	'all_items'		=>	'View All'
	        ),
	        'menu_position'		=>	10,
			'menu_icon'			=>	'dashicons-category',
	        'supports'			=>	array(
	            'title',
	            'editor',
	            'thumbnail',
				'excerpt'
	        ),
	        'capability_type'	=>	'tourism_top_visited',
	        'map_meta_cap'		=>	true,
	        'show_in_menu'		=>	true
	    );
	    register_post_type('tourism-top-visited', $cpt_top_visited);

	    // Featured Articles
	    $cpt_featured_articles = array(
	    	'public'			=>	true,
	        'label'				=>	'FEATURED ARTICLE',
	        'labels'			=>	array(
	        	'all_items'		=>	'View All'
	        ),
	        'menu_position'		=>	10,
			'menu_icon'			=>	'dashicons-category',
	        'supports'			=>	array(
	            'title',
	            'editor',
	            'thumbnail',
				'excerpt'
	        ),
	        'capability_type'	=>	'tourism_featured_article',
	        'map_meta_cap'		=>	true,
	        'show_in_menu'		=>	true
	    );
	    register_post_type('tourism-feat-artcle', $cpt_featured_articles);

	    // Image Gallery
	    $cpt_image_gallery = array(
	    	'public'			=>	true,
	        'label'				=>	'IMAGE GALLERY',
	        'labels'			=>	array(
	        	'all_items'		=>	'View All'
	        ),
	        'menu_position'		=>	10,
			'menu_icon'			=>	'dashicons-category',
	        'supports'			=>	array(
	            'title',
	            'editor',
	            'thumbnail',
				'excerpt'
	        ),
	        'capability_type'	=>	'tourism_image_gallery',
	        'map_meta_cap'		=>	true,
	        'show_in_menu'		=>	true
	    );
	    register_post_type('tourism-img-gallery', $cpt_image_gallery);

	    // ----------------------------------------------------------
	    // FAST FACTS
	    $cpt_fast_facts = array(
	    	'public'			=>	true,
	        'label'				=>	'FAST FACTS',
	        'labels'			=>	array(
	        	'all_items'		=>	'View All'
	        ),
	        'menu_position'		=>	10,
			'menu_icon'			=>	'dashicons-category',
	        'supports'			=>	array(
	            'title',
	            'editor',
	            'thumbnail',
				'excerpt'
	        ),
	        'capability_type'	=>	'tourism_fast_fact',
	        'map_meta_cap'		=>	true,
	        'show_in_menu'		=>	true
	    );
	    register_post_type('tourism-fast-fact', $cpt_fast_facts);

	    // TRAVEL AND TOURS
	    $cpt_travel_and_tours = array(
	    	'public'			=>	true,
	        'label'				=>	'TRAVEL AND TOURS',
	        'labels'			=>	array(
	        	'all_items'		=>	'View All'
	        ),
	        'menu_position'		=>	10,
			'menu_icon'			=>	'dashicons-category',
	        'supports'			=>	array(
	            'title',
	            'editor',
	            'thumbnail',
				'excerpt'
	        ),
	        'capability_type'	=>	'tourism_travel_and_tours',
	        'map_meta_cap'		=>	true,
	        'show_in_menu'		=>	true
	    );
	    register_post_type('tourism-trvl-tours', $cpt_travel_and_tours);

	    // ACCOM ESTABLISHMENTS
	    $cpt_accom_establishments = array(
	    	'public'			=>	true,
	        'label'				=>	'ACCOM ESTABLISHMENTS',
	        'labels'			=>	array(
	        	'all_items'		=>	'View All'
	        ),
	        'menu_position'		=>	10,
			'menu_icon'			=>	'dashicons-category',
	        'supports'			=>	array(
	            'title',
	            'editor',
	            'thumbnail',
				'excerpt'
	        ),
	        'capability_type'	=>	'tourism_accom_establishments',
	        'map_meta_cap'		=>	true,
	        'show_in_menu'		=>	true
	    );
	    register_post_type('tourism-accm-stblsm', $cpt_accom_establishments);

	    // NATIVE DIALECTS / DEMOGRAPHY
	    $cpt_demography = array(
	    	'public'			=>	true,
	        'label'				=>	'NATIVE DIALECTS / DEMOGRAPHY',
	        'labels'			=>	array(
	        	'all_items'		=>	'View All'
	        ),
	        'menu_position'		=>	10,
			'menu_icon'			=>	'dashicons-category',
	        'supports'			=>	array(
	            'title',
	            'editor',
	            'thumbnail',
				'excerpt'
	        ),
	        'capability_type'	=>	'tourism_demography',
	        'map_meta_cap'		=>	true,
	        'show_in_menu'		=>	true
	    );
	    register_post_type('tourism-demography', $cpt_demography);

	    // NATIVE DELICACIES
	    $cpt_delicacies = array(
	    	'public'			=>	true,
	        'label'				=>	'NATIVE DELICACIES',
	        'labels'			=>	array(
	        	'all_items'		=>	'View All'
	        ),
	        'menu_position'		=>	10,
			'menu_icon'			=>	'dashicons-category',
	        'supports'			=>	array(
	            'title',
	            'editor',
	            'thumbnail',
				'excerpt'
	        ),
	        'capability_type'	=>	'tourism_delicacies',
	        'map_meta_cap'		=>	true,
	        'show_in_menu'		=>	true
	    );
	    register_post_type('tourism-delicacies', $cpt_delicacies);

	    // TOURIST ATTRACTIONS
	    $cpt_attractions = array(
	    	'public'			=>	true,
	        'label'				=>	'ATTRACTIONS',
	        'labels'			=>	array(
	        	'all_items'		=>	'View All'
	        ),
	        'menu_position'		=>	10,
			'menu_icon'			=>	'dashicons-category',
	        'supports'			=>	array(
	            'title',
	            'editor',
	            'thumbnail',
				'excerpt'
	        ),
	        'capability_type'	=>	'tourism_attractions',
	        'map_meta_cap'		=>	true,
	        'show_in_menu'		=>	true
	    );
	    register_post_type('tourism-attractions', $cpt_attractions);

	    // ACCOM AND RESTAURANTS
	    $cpt_accom_restaurants = array(
	    	'public'			=>	true,
	        'label'				=>	'ACCOM AND RESTAURANTS',
	        'labels'			=>	array(
	        	'all_items'		=>	'View All'
	        ),
	        'menu_position'		=>	10,
			'menu_icon'			=>	'dashicons-category',
	        'supports'			=>	array(
	            'title',
	            'editor',
	            'thumbnail',
				'excerpt'
	        ),
	        'capability_type'	=>	'tourism_accm_rstrnts',
	        'map_meta_cap'		=>	true,
	        'show_in_menu'		=>	true
	    );
	    register_post_type('tourism-accm-rstrnts', $cpt_accom_restaurants);

	    // TRAVEL AND TOURS
	    $cpt_how_to_get_there = array(
	    	'public'			=>	true,
	        'label'				=>	'HOW TO GET THERE',
	        'labels'			=>	array(
	        	'all_items'		=>	'View All'
	        ),
	        'menu_position'		=>	10,
			'menu_icon'			=>	'dashicons-category',
	        'supports'			=>	array(
	            'title',
	            'editor',
	            'thumbnail',
				'excerpt'
	        ),
	        'capability_type'	=>	'tourism_how_to_get_there',
	        'map_meta_cap'		=>	true,
	        'show_in_menu'		=>	true
	    );
	    register_post_type('tourism-how-to-get', $cpt_how_to_get_there);

	}

	/**
	 * Generate Meta Box field
	 * for this plugin
	 */
	public function cag_meta_box_tourism_init($meta_boxes){

		$prefix = 'tourism_meta_box_';

		/**
		 * 1st meta box
		 * Meta Box for the Map information of the top visited and attractions
		 */
	    $meta_boxes[] = array(
	        'id'         => $prefix . 'map_id',
	        'title'      => __( 'Map Information', 'textdomain' ),
	        'post_types' => array( 'tourism-top-visited', 'tourism-attractions' ),
	        'context'    => 'normal',
	        'priority'   => 'high',
	        'fields' => array(
	            array(
	                'name'			=>	__( 'Map Location', 'textdomain' ),
	                'desc'  		=>	'Set the Map here...',
	                'id'    		=>	$prefix . 'cpt_location_id',
	                'type'			=>	'map',
	                'address_field'	=>	$prefix . 'cpt_map_address_id',
	                'std'			=>	'17.6132,121.7270',
	                'api_key'		=>	'AIzaSyDKpwymHkXxpI1DJYCgGzzHfy3cO91XOa8'
	            )
	        )
	    );

		/**
		 * 2nd meta box
		 * Meta Box for the image slider
		 */
	    $meta_boxes[] = array(
	        'id'         => $prefix . 'gallery_info_id',
	        'title'      => __( 'Gallery Box', 'textdomain' ),
	        'post_types' => array( 'tourism-img-gallery' ),
	        'context'    => 'normal',
	        'priority'   => 'high',
	        'fields' => array(
	            array(
	                'name'  => __( 'Gallery Images', 'textdomain' ),
	                'desc'  => 'Upload images here...',
	                'id'    => $prefix . 'gallery_images_id',
	                'type'  => 'image_advanced'
	            )
	        )
	    );

	    /**
		 * 3rd meta box
		 * Meta Box for the Fast Facts
		 */
	    $meta_boxes[] = array(
	        'id'         => $prefix . 'fast_facts_id',
	        'title'      => __( 'Fast Facts Box', 'textdomain' ),
	        'post_types' => array( 'tourism-fast-fact' ),
	        'context'    => 'normal',
	        'priority'   => 'high',
	        'fields' => array(
	            array(
	                'name'  => __( 'Article icon', 'textdomain' ),
	                'desc'  => 'Set the icon here...',
	                'id'    => $prefix . 'fast_facts_icon_id',
	                'type'  => 'text'
	            )
	        )
	    );

	    /**
		 * 4th meta box
		 * Meta Box for the Travel and tours
		 */
	    $meta_boxes[] = array(
	        'id'         => $prefix . 'travel_n_tours_id',
	        'title'      => __( 'Travel and Tours Information Box', 'textdomain' ),
	        'post_types' => array( 'tourism-trvl-tours' ),
	        'context'    => 'normal',
	        'priority'   => 'high',
	        'fields' => array(
	            array(
	                'name'  => __( 'Location Address', 'textdomain' ),
	                'desc'  => 'Set the location address here...',
	                'id'    => $prefix . 'travel_n_tours_location_id',
	                'type'  => 'text',
	            ),
	            array(
	            	'name'	=>	__( 'Contact Informations', 'textdomain' ),
	            	'type'	=>	'divider'
	            ),
	            array(
	            	'name'  => __( 'Telephone Number', 'textdomain' ),
	                'desc'  => 'Set the Telephone number here...',
	                'id'    => $prefix . 'travel_n_tours_telephone_id',
	                'type'  => 'text'
	            ),
	            array(
	            	'name'  => __( 'E-mail', 'textdomain' ),
	                'desc'  => 'Set the E-Mail here...',
	                'id'    => $prefix . 'travel_n_tours_email_id',
	                'type'  => 'email'
	            ),
	            array(
	                'name'			=>	__( 'Map Location(Optional)', 'textdomain' ),
	                'desc'  		=>	'Set the Map here...',
	                'id'    		=>	$prefix . 'travel_n_tours_map_location_id',
	                'type'			=>	'map',
	                'address_field'	=>	$prefix . 'travel_n_tours_map_address_id',
	                'std'			=>	'17.6132,121.7270',
	                'api_key'		=>	'AIzaSyDKpwymHkXxpI1DJYCgGzzHfy3cO91XOa8'
	            )
	        )
	    );

	    /**
		 * 5th meta box
		 * Meta Box for the Accom Establishments and Accom & Restaurants
		 */
	    $meta_boxes[] = array(
	        'id'         => $prefix . 'accom_id',
	        'title'      => __( 'Accom Establishments Information Box', 'textdomain' ),
	        'post_types' => array( 'tourism-accm-stblsm', 'tourism-accm-rstrnts' ),
	        'context'    => 'normal',
	        'priority'   => 'high',
	        'fields' => array(
	            array(
	                'name'  => __( 'Location Address', 'textdomain' ),
	                'desc'  => 'Set the location address here...',
	                'id'    => $prefix . 'accom_location_id',
	                'type'  => 'text',
	            ),
	            array(
	                'name'  => __( 'Classification', 'textdomain' ),
	                'desc'  => 'Select the classification here...',
	                'id'    => $prefix . 'accom_classification_id',
	                'type'  => 'select_advanced',
	                'placeholder'=>	'&mdash; Please select classification &mdash;',
	                'options'=>	array(
	                	'Hotel'		=>	'Hotel',
	                	'Resort'	=>	'Resort',
	                	'Restaurant'=>	'Restaurant'
	                )
	            ),
	            array(
	            	'name'	=>	__( 'Contact Informations', 'textdomain' ),
	            	'type'	=>	'divider'
	            ),
	            array(
	            	'name'  => __( 'Telephone Number', 'textdomain' ),
	                'desc'  => 'Set the Telephone number here...',
	                'id'    => $prefix . 'accom_telephone_id',
	                'type'  => 'text'
	            ),
	            array(
	            	'name'  => __( 'E-mail', 'textdomain' ),
	                'desc'  => 'Set the E-Mail here...',
	                'id'    => $prefix . 'accom_email_id',
	                'type'  => 'email'
	            ),
	            array(
	                'name'			=>	__( 'Map Location(Optional)', 'textdomain' ),
	                'desc'  		=>	'Set the Map here...',
	                'id'    		=>	$prefix . 'accom_map_location_id',
	                'type'			=>	'map',
	                'address_field'	=>	$prefix . 'accom_map_address_id',
	                'std'			=>	'17.6132,121.7270',
	                'api_key'		=>	'AIzaSyDKpwymHkXxpI1DJYCgGzzHfy3cO91XOa8'
	            )
	        )
	    );

	    /**
		 * 6TH meta box
		 * Meta Box for the Native Dialects / Demography
		 */
	    $meta_boxes[] = array(
	        'id'         => $prefix . 'demography_id',
	        'title'      => __( 'Native Dialects / Demography', 'textdomain' ),
	        'post_types' => array( 'tourism-demography' ),
	        'context'    => 'normal',
	        'priority'   => 'high',
	        'fields' => array(
	            array(
	                'name'  => __( 'Ethnology Percentage', 'textdomain' ),
	                'desc'  => 'Set percentage(%) of population here...',
	                'id'    => $prefix . 'demography_id',
	                'type'  => 'text'
	            )
	        )
	    );

	    return $meta_boxes;       

	}
	
	// ------------------------------------------------------------------------------------------------------------------------
	//

} // end of class Cag_Visit_Cagayan

// register  widget
function register_visit_cagayan_widget() {
    register_widget( 'Cag_Visit_Cagayan' );
}
add_action( 'widgets_init', 'register_visit_cagayan_widget' );
?>