<?php 
/*
 * Plugin Name: Cag-Philippine Standard Footer
 * Plugin URI: http://www.caganda2025.com
 * Description: A Custom Plugin that for the footer that has the standard footer layout use by the Philippine Government.
 * Version: 1.0.0
 * Author: PPDO IT-Division
 * Author URI: http://www.cagayan.gov.ph
*/

/**
 * Adds Cag_Whats_New_Section Widget.
*/
class Cag_PH_Standard_Footer extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'cag_ph_standard_footer', // Base ID
			__( 'Cag-Philippine Standard Footer', 'text_domain' ), // Name
			array( 'description' => __( 'A Custom Plugin that for the footer that has the standard footer layout use by the Philippine Government.', 'text_domain' ), ) // Args
		);
		// Add the build in wordpress media uploader
		add_action( 'admin_enqueue_scripts', array( $this, 'cag_ph_standard_footer_enqueue_assets' ) );
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
		$thumbnail = $instance['cag_ph_standard_thumbnail'];
		$copyright_message = $instance['copyright_message'];
		$about_gov_ph = $instance['about_gov_ph'];
		$direct_links = $instance['direct_links'];
		$ph_government_links = $instance['ph_government_links'];
		$linkname = $instance['linkname'];
		$pagename = $instance['pagename'];
		echo $before_widget;
		if ( !$title ):
			$title = "FOOTER";
		endif;

		// $asc_sort_order = (isset( $instance['asc_sort_order'] ) && $instance['asc_sort_order']) ? 'ASC' : 'DESC';

		$args = array( 
			'widget_title' => $title,
			'thumbnail' => $thumbnail,
			'copyright_message' => $copyright_message,
			'about_gov_ph' => $about_gov_ph,
			'direct_links' => $direct_links,
			'ph_government_links' => $ph_government_links,
			'linkname' => $linkname,
			'page_source' => $pagename
		);

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
			$thumbnail = esc_url($instance['cag_ph_standard_thumbnail']);
			$copyright_txt = esc_attr($instance['copyright_message']);
			$about_txt = esc_attr($instance['about_gov_ph']);
			$direct_links_menu = esc_attr($instance['direct_links']);
			$government_links = esc_attr($instance['ph_government_links']);
			$linkname = esc_attr($instance['linkname']);
			$pagename = esc_attr($instance['pagename']);
		} else {
			$title = '';
			$thumbnail = '';
			$copyright_txt = '';
			$about_txt = '';
			$direct_links_menu = '';
			$government_links = '';
			$linkname = '';
			$pagename = '';
		}

		// Get menus
		$menus = wp_get_nav_menus();

		?>

		<style type="text/css">.cag-form-divider{border:1px dashed #ccc;padding-left:5px;padding-right:5px;margin-top:10px;margin-bottom:10px;}</style>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'cag_ph_standard_footer'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<?php 
			/* This is
			 * for the image group
			 * the default image is the post/page thumbnail
			 */

			if ( $thumbnail === '' ):
				if ( $pagename != '0' || $pagename != 0 ):
					$thumbnail = get_the_post_thumbnail_url( $pagename );
				endif;
			endif;	

		?>

		<p>
            <label>
                <?php _e( 'Featured Image',TEXTDOMAIN ); ?>
                <div>
                	<img src="<?php echo $thumbnail; ?>" height="100" width="100" class="ph_standard_footer_img" />
                </div>

                <input class="widefat" id="<?php echo $this->get_field_id('cag_ph_standard_thumbnail'); ?>" name="<?php echo $this->get_field_name('cag_ph_standard_thumbnail'); ?>" type="hidden" value="<?php echo $thumbnail; ?>" />
                <input class="cag_ph_standard_upload_image_button" type="button" value="Choose Other" />
            </label>
        </p>

        <div class="cag-form-divider">
        	<p>
				<label for="<?php echo $this->get_field_id('copyright_message'); ?>"><?php _e('Copyright Content Message', 'cag_ph_standard_footer'); ?></label>
				<textarea class="widefat" id="<?php echo $this->get_field_id('copyright_message'); ?>" name="<?php echo $this->get_field_name('copyright_message'); ?>" type="text" value="<?php echo $copyright_txt; ?>"><?php echo $copyright_txt; ?></textarea>
			</p>
        </div>

        <div class="cag-form-divider">
        
        	<p>
				<label for="<?php echo $this->get_field_id('about_gov_ph'); ?>"><?php _e('About GOVPH Message', 'cag_ph_standard_footer'); ?></label>
				<textarea class="widefat" id="<?php echo $this->get_field_id('about_gov_ph'); ?>" name="<?php echo $this->get_field_name('about_gov_ph'); ?>" type="text" value="<?php echo $about_txt; ?>"><?php echo $about_txt; ?></textarea>
			</p>

			<p>
	            <label for="<?php echo $this->get_field_id( 'direct_links' ); ?>"><?php _e( 'Direct Links' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'direct_links' ); ?>" name="<?php echo $this->get_field_name( 'direct_links' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $direct_links_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
	        </p>
	        
        </div>

        <div class="cag-form-divider">
        	
        	<p>
	            <label for="<?php echo $this->get_field_id( 'ph_government_links' ); ?>"><?php _e( 'Government Links' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'ph_government_links' ); ?>" name="<?php echo $this->get_field_name( 'ph_government_links' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $government_links, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
	        </p>

        </div>


        <div class="cag-form-divider">
        	
        	<p>
				<label for="<?php echo $this->get_field_id('linkname'); ?>"><?php _e('Link Label', 'cag_visit_cagayan_widget'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('linkname'); ?>" name="<?php echo $this->get_field_name('linkname'); ?>" type="text" value="<?php echo $linkname; ?>" />
			</p>

			<p>
	            <label>
	                <?php _e( 'Developer\'s Page',TEXTDOMAIN ); ?>
	                <?php wp_dropdown_pages( array( 'hide_empty'=> 0, 'name' => $this->get_field_name("pagename"), 'value_field' => 'post_id', 'selected' => $pagename, 'show_option_none' => '&mdash; Select &mdash;', 'option_none_value' => '0' ) ); ?>
	            </label>
	        </p>

        </div>
  

		<?php

	}

	/**
	 * The Front End View
	 */
	private function viewX( $args ) { //html

		$get_copyright_msg = $args["copyright_message"] != '' ? $args["copyright_message"] : 'All content is in the public domain unless otherwise stated.';
		$get_about_msg = $args["about_gov_ph"] != '' ? $args["about_gov_ph"] : 'Learn more about the Philippine government, its structure, how government works and the people behind it.';

		?>

		<!-- FOOTER -->
	    <footer class="page-footer cag-footer">
	      	<div class="container">
	        	
	        		<div class="row">
	        		
		        		<div class="col l5 m12 s12">
				        	<img src="<?php echo $args["thumbnail"]; ?>" />
				        	<h5 class="white-text">Republic of the Philippines</h5>
				            <p class="grey-text text-lighten-3"><?php echo $get_copyright_msg; ?></p>
				        </div>

				        <div class="col l4 m6 s12">
				            <h5 class="white-text">About GOVPH</h5>
				            <p class="grey-text text-lighten-3"><?php echo $get_about_msg; ?></p>
				            <?php wp_nav_menu( array( 'menu' => $args["direct_links"], 'menu_class' => 'cag-ph-standard-footer-direct-links-group' ) ); ?>
				        </div>

				        <div class="col l3 m6 s12">
				            <h5 class="white-text">Government Links</h5>
				            <?php wp_nav_menu( array( 'menu' => $args["ph_government_links"], 'menu_class' => 'cag-ph-standard-footer-govt-links-group' ) ); ?>
				        </div>

		        	</div>
	        	
	        </div>

	        <div class="footer-copyright">
		        <div class="container">
		          	<a class="grey-text text-lighten-4" href="<?php echo get_the_permalink( $args["page_source"] ); ?>"><?php echo $args["linkname"]; ?></a>
		        </div>
		    </div>

	    </footer>
		<?php

	}

	private function view( $args ) {
		// get scripts
		$this->get_scripts();
		$get_copyright_msg = $args["copyright_message"] != '' ? $args["copyright_message"] : 'All content is in the public domain unless otherwise stated.';
		$get_about_msg = $args["about_gov_ph"] != '' ? $args["about_gov_ph"] : 'Learn more about the Philippine government, its structure, how government works and the people behind it.';
	?>	
			<!-- FOOTER -->
  		<footer class="page-footer cag-footer">

    		<div class="cag-footer-container">
    			
    			<div class="row reset-margin">

			        <div class="col l5 m5">
			          	<div class="row reset-margin">
			              	<div class="col l4 s4">
			                	<img class="responsive-img" src="<?php echo $args["thumbnail"]; ?>" />
			              	</div>
			              	<div class="col l8 s8">
			                	<h5>Republic of the Philippines</h5>
			                	<p><?php echo $get_copyright_msg; ?></p>
			                	<ul>
			                  		<li><a href="http://www.gov.ph/about-this-website/privacy-policy/">Privacy Policy</a></li>
			                	</ul>
			              	</div>
			          	</div>
			        </div>

			        <div class="col l7 m7 reset-padding">

			          	<div class="row reset-margin">

				            <div class="col l6 m6 s8 offset-s4">
				              	<h5>About GOVPH</h5>
				              	<p><?php echo $get_about_msg; ?></p>
				              	<?php wp_nav_menu( array( 'menu' => $args["direct_links"], 'menu_class' => 'cag-ph-standard-footer-direct-links-group' ) ); ?>
				              	<!---<ul>
				              		<li><a href="http://www.gov.ph">Official Gazette</a></li>
				              		<li><a href="http://data.gov.ph">Open Data Portal</a></li>
				              		<li><a href="http://www.gov.ph/feedback/idulog/">Send us your feedback</a></li>
				              	</ul>-->
				            </div>

				            <div class="col l6 m6 s8 offset-s4">
				              <h5>Government Links</h5>
				              <?php wp_nav_menu( array( 'menu' => $args["ph_government_links"], 'menu_class' => 'cag-ph-standard-footer-govt-links-group' ) ); ?>
				              <!---
				              <ul>
				                <li><a href="http://president.gov.ph">The President</a></li>
				                <li><a href="http://op-proper.gov.ph">Office of the President</a></li>
				                <li><a href="http://ovp.gov.ph">Office of the Vice President</a></li>
				                <li><a href="http://senate.gov.ph/">Senate of the Philippines</a></li>
				                <li><a href="http://www.congress.gov.ph/">House of Representatives</a></li>
				                <li><a href="http://sc.judiciary.gov.ph/">Supreme Court</a></li>
				                <li><a href="http://ca.judiciary.gov.ph/">Court of Appeals</a></li>
				                <li><a href="http://sb.judiciary.gov.ph/">Sandiganbayan</a></li>
				              </ul>
				              -->

				            </div>

			          	</div>

			        </div>

			    </div>

    		</div>

    		<div class="footer-copyright">

		      	<div class="cag-footer-copy left">
		        	<a href="<?php echo get_the_permalink( $args["page_source"] ); ?>"><?php echo $args["linkname"]; ?></a>
		      	</div>

		      	<div class="cag-footer-social right">
		        	<ul>
		          		<li><a href="https://www.facebook.com/cagayanPIO/"><i class="cagicon-facebook-box"></i></a></li>
		          		<!---
		          		<li><a href="#!"><i class="cagicon-twitter"></i></a></li>
		          		<li><a href="#!"><i class="cagicon-google-plus"></i></a></li>
		          		<li><a href="#!"><i class="cagicon-youtube-play"></i></a></li>
		          		-->
		        	</ul>
		      	</div>

		    </div>

    	</footer>
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
    	<link rel="stylesheet" href="<?php echo $dir; ?>css/cag-ph-standard-footer.min.css" type="text/css" media="all" />	

    	<!--- JS -->
    	<script type="text/javascript" src="<?php echo $dir; ?>js/cag-ph-standard-footer.js"></script>
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
		$instance['cag_ph_standard_thumbnail'] = strip_tags($new_instance['cag_ph_standard_thumbnail']);
		$instance['copyright_message'] = strip_tags($new_instance['copyright_message']);
		$instance['about_gov_ph'] = strip_tags($new_instance['about_gov_ph']);
		$instance['direct_links'] = strip_tags($new_instance['direct_links']);
		$instance['ph_government_links'] = strip_tags($new_instance['ph_government_links']);
		$instance['linkname'] = strip_tags($new_instance['linkname']);
		$instance['pagename'] = strip_tags($new_instance['pagename']);
		return $instance;
	}

	/*
	 * This is for the custom
	 * mfc functions
	 */
	public function cag_ph_standard_footer_enqueue_assets() {

		wp_enqueue_script('media-upload');
		wp_enqueue_media();
		wp_enqueue_script('cag-standard-footer-media-upload', plugin_dir_url(__FILE__) . 'js/cag-ph-standard-footer-media-upload.js', array('jquery') );

	}

} // end of class Cag_PH_Standard_Footer

// register  widget
function register_ph_standard_footer() {
    register_widget( 'Cag_PH_Standard_Footer' );
}
add_action( 'widgets_init', 'register_ph_standard_footer' );
?>