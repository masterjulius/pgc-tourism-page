<?php
/*
 * Plugin Name: Cag-Navbar Menu
 * Plugin URI: http://www.caganda2025.com
 * Description: A Custom Navbar Menu exclusively for Cagayan.
 * Version: 1.0
 * Author: PPDO IT-Division
 * Author URI: http://www.cagayan.gov.ph
*/

/**
 * Adds Cag_Navbar_Menu widget.
*/
require_once('includes/wp-cag-custom-materializecss-navbar-walker.php');

class Cag_Navbar_Menu extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'cag_navbar_menu', // Base ID
			__( 'Cag-Navbar Menu', 'text_domain' ), // Name
			array( 'description' => __( 'A Custom Navbar Menu exclusively for Cagayan.', 'text_domain' ), ) // Args
		);
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
		$menu = $instance['nav_menu'];
		$sort_by = $instance['sort_by'];
		$asc_sort_order = $instance['asc_sort_order'];
		echo $before_widget;
		if ( !$title ):
			$title = "Announcements";
		endif;

		$asc_sort_order = (isset( $instance['asc_sort_order'] ) && $instance['asc_sort_order']) ? 'ASC' : 'DESC';

		$args = array( 'widget_title' => $title, 'nav_menu'=> $menu, 'orderby' => $sort_by, 'order' => $asc_sort_order );

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
		} else {
			$title = '';
		}
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();
	?>	

		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'realty_widget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
            <label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
				<?php foreach ( $menus as $menu ) : ?>
					<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
						<?php echo esc_html( $menu->name ); ?>
					</option>
				<?php endforeach; ?>
			</select>
        </p> 

		<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
			<p class="edit-selected-nav-menu" style="<?php if ( ! $nav_menu ) { echo 'display: none;'; } ?>">
				<button type="button" class="button"><?php _e( 'Edit Menu' ) ?></button>
			</p>
		<?php endif; ?>       

        <p>
            <label for="<?php echo $this->get_field_id("sort_by"); ?>">
                <?php _e('Sort by',TEXTDOMAIN); ?>:
                <select id="<?php echo $this->get_field_id("sort_by"); ?>" name="<?php echo $this->get_field_name("sort_by"); ?>">
                    <option value="date"<?php selected( $instance["sort_by"], "date" ); ?>><?php _e('Date',TEXTDOMAIN)?></option>
                    <option value="title"<?php selected( $instance["sort_by"], "title" ); ?>><?php _e('Title',TEXTDOMAIN)?></option>
                    <option value="comment_count"<?php selected( $instance["sort_by"], "comment_count" ); ?>><?php _e('Number of comments',TEXTDOMAIN)?></option>
                    <option value="rand"<?php selected( $instance["sort_by"], "rand" ); ?>><?php _e('Random',TEXTDOMAIN)?></option>
                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id("asc_sort_order"); ?>">
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("asc_sort_order"); ?>" name="<?php echo $this->get_field_name("asc_sort_order"); ?>" <?php checked( (bool) $instance["asc_sort_order"], true ); ?> />
                        <?php _e( 'Reverse sort order (ascending)',TEXTDOMAIN ); ?>
            </label>
        </p>

        <p>
            <label for="show_search_engine">
                <input type="checkbox" class="checkbox" id="show_search_engine" name="show_search_engine" <?php checked( (bool) $instance["show_search_engine"], true ); ?> />
                        <?php _e( 'Show search engine',TEXTDOMAIN ); ?>
            </label>
        </p>

	<?php	
	}

	/**
	 * The Front End View
	 */
	private function view( $args ) { //html
		// get scripts
		$this->get_scripts();
		$path = plugin_dir_url(__FILE__) . 'images/hourglass.svg';
	?>	
		<style>
			.textbox-with-gif {
    			background: url( <?php echo $path; ?> ) no-repeat scroll right center !important;
    			background-size: 30px 30px !important;
    			z-index: 999 !important;
  			}
  		</style>
  	<?php	

		$nav_menu = $args["nav_menu"];
		echo '<div class="navbar-fixed cag-navbar">';
      		echo '<nav  id="cag-nav" class="cag-nav">';
        		echo '<div class="nav-wrapper">';

        			wp_nav_menu( array( 'menu' => $nav_menu, 'theme_location' => 'header-menu', 'menu_class' => 'menu side-nav', 'menu_id' => 'mobile-nav','items_wrap' => '<ul id="%1$s" class="%2$s"><li class="mobile-header"><p>Menu</p></li>%3$s</ul><div class="clear"></div>', ) );
        			echo '<ul class="cag-main-menu left hide-on-med-and-down">';
						wp_nav_menu( array( 'menu' => $nav_menu, 'walker' => new wp_cag_materializecss_navbar_walker() ) );
					echo '</ul>';
				?>
					<!-- SEARCH NAV -->
          			<div class="cag-search-wrapper cag-search-mobile">
            			<input type="search" id="search" name="s" class="cag-search-input" placeholder="SEARCH CAGAYAN..." />
            			<i class="cagicon-search"></i>

            			<div class="cag-navbar-menu-search-results"></div>

          			</div><!-- END SEARCH NAV -->

				<?php

        		echo '</div>';
        	echo '</nav>';

        echo '</div>';

        $this->get_masthead();

	}

	/** Function for Website MastHead */
	private function get_masthead() {
		$plugin_dir = plugin_dir_url(__FILE__);
	?>
			<!-- MASTHEAD -->
    	<div class="cag-masthead">
    		<a href="<?php echo home_url(); ?>" alt="_home_url">
    			<img class="responsive-img" src="<?php echo $plugin_dir; ?>images/cagayan_masthead_100.png" />
    		</a>
      		<img class="hide-on-med-and-down" src="<?php echo $plugin_dir; ?>images/philippine_transparency_seal_100x100.png" />
      		<img class="hide-on-med-and-down" src="<?php echo $plugin_dir; ?>images/caganda_2025_logo_100.png" />
      		<img class="hide-on-med-and-down" src="<?php echo $plugin_dir; ?>images/pabaruen_ti_cagayan_logo_100.png" />
    	</div><!-- END MASTHEAD -->

    <?php

	}

	/** Call Scripts */
	private function get_scripts( $prefix = null ){
		$dir = plugin_dir_url(__FILE__);
    ?>
    	<!--- Custom CSS -->
    	<link rel="stylesheet" href="<?php echo $dir; ?>css/cag-navbar-menu.min.css" type="text/css" media="all" />	

    	<!--- JS -->
    	<script type="text/javascript" src="<?php echo $dir; ?>js/cag-navbar-menu.js"></script>
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
		$instance['sort_by'] = strip_tags($new_instance['sort_by']);
		$instance['asc_sort_order'] = strip_tags($new_instance['asc_sort_order']);
		return $instance;
	}	

} // end of class Cag_Navbar_Menu

// register  widget
function register_cag_navbar_menu() {
    register_widget( 'Cag_Navbar_Menu' );
}
add_action( 'widgets_init', 'register_cag_navbar_menu' );
/** AJAX */
// function enquee ajax search help
function ajax_search_enqueues() {

   	wp_enqueue_script( 'ajax-search', plugin_dir_url( __FILE__ ) . 'js/cag-ajax-search.js', array( 'jquery' ), '1.0.0', true );
    wp_localize_script( 'ajax-search', 'myAjaxSearch', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'pluginsUrl' => plugin_dir_url( __FILE__ ) ) );

}
add_action( 'wp_enqueue_scripts', 'ajax_search_enqueues' );

/** --------------------------------- EXTRA FUNCTIONS HERE ----------------------------- */
function load_search_results() {
	$query = $_POST['query'];
	$post_types_array = array("post", "page", "advisories", "announcements", "citizens-charter", "demography", "doodle", "events", "gallery", "image-slider", "news", "trivia", "videos");
    $args = array(
        'post_status' => 'publish',
        'post_type' => $post_types_array,
        'posts_per_page' => 5,
        's' => $query
    );
    $search = new WP_Query( $args );
    $result_count = 0;
    echo '<ul class="collection cag-navbar-menu-search-results" style="display:none;">';
    if ( $search->have_posts() ):
    	$result_count = $search->found_posts;
    	echo "<script>cag_ajax_search.toggle_result('.cag-navbar-menu-search-results', 'down');</script>";
    	while ( $search->have_posts() ):
    		$search->the_post();
?>
			<li class="collection-item avatar">
				<a href="<?php echo get_the_permalink(); ?>" class="collection-item" rel="_search_items">
					<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), array(100,100) ); ?>" alt="" class="circle" />
	      			<span class="title"><?php echo wp_trim_words( get_the_title(), 3 ); ?></span>
	      			<p><small><?php echo get_the_date(); ?></small></p>
				</a>
    		</li>
<?php    		
    	endwhile;
    	wp_reset_postdata();

    	echo "<li class='collection-item view-all-result center'><a href='" . esc_url( home_url( '/' ) ) . "search/{$query}/' rel='sear_results' class='collection-item'>View all {$result_count} results</a></li>";

    	else:
    		echo "<script>cag_ajax_search.toggle_result('.cag-navbar-menu-search-result(s)', 'down');</script>";
    		echo "<li class='collection-item no-data'>No results found for: {$query}</li>";
    endif;
    	echo '<li class="collection-item close-result center"> Close </li>';
    echo '</ul>';

    ob_start();
	$content = ob_get_clean();

	echo $content;

    die();

}
add_action( 'wp_ajax_load_search_results', 'load_search_results' );
add_action( 'wp_ajax_nopriv_load_search_results', 'load_search_results' );
?>