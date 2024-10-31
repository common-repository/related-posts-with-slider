<?php
# Change Pac	TMRelatedPosts
# description 
# file name 	tm-related-posts
# function  	tmrelatedposts
# Class Name 	TM_Related_Posts
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://tanvirmelon.com
 * @since      1.0.0
 *
 * @package    TMRelatedPosts
 * @subpackage TMRelatedPosts/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    TMRelatedPosts
 * @subpackage TMRelatedPosts/public
 * @author     Tanvir Islam <tanvirmelon2@gmail.com>
 */
class TM_Related_Posts_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $tmrelatedposts    The ID of this plugin.
	 */
	private $tmrelatedposts;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $tmrelatedposts       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $tmrelatedposts, $version ) {

		$this->tmrelatedposts = $tmrelatedposts;
		$this->version = $version;
		// The filder hook
		add_filter( 'the_content', array(&$this, "tm_related_post_output") );

	}

	// Callback funciton of hook
	public function tm_related_post_output( $default ) {
		$tmrp_heading = get_option('tmrp_heading');
    	//$tmrp_active = get_option('tmrp_enable');
    	// Top Title Condition 
    	if(!empty($tmrp_heading)) {
			$tmrp_heading;
		}else {
			$tmrp_heading = 'Related Post';
		}

		if( is_single() ) :

			$tm_terms = get_the_terms( get_the_ID(), 'category' );
			if ( $tm_terms && ! is_wp_error( $tm_terms ) ) :
			    $tm_blank_category = array();		 
			    foreach ( $tm_terms as $tm_term ) {
			        $tm_blank_category[] = $tm_term->term_id;
			    }
			endif;
			//if( $tmrp_active == 1 ) :
			$default .= '<div class="main-container">';
			$default .= '<div class="row">';
			$default .= '<div class="col-md-12 content-wrap">';
			$default .= '<article>';
			$default .= '<h4 class="text-center related-heading">'.$tmrp_heading.'</h4>';
			$default .= '<div class="related-posts">';

			// The Query
			$tm_rltd_pst = new WP_Query(array(
				'post_type'		=> 'post',
				'category__in'  => $tm_blank_category, // get the category plz print_r it
				'post__not_in'  => array(get_the_ID()),// remove present post
			));
		while( $tm_rltd_pst->have_posts() ) : $tm_rltd_pst->the_post();
			$default .= '<div>';
			$default .= '<a href="'.get_the_permalink().'" class="image-holder">';
			$default .= '<img src="'.get_the_post_thumbnail_url().'" alt="'.get_the_title().'">';
			$default .= '</a>';
			$default .= '<a href="'.get_the_permalink().'"><h3>'.wp_trim_words( get_the_title(), 5 ).'</h3></a>';
			$default .= '<p>'.wp_trim_words( get_the_content(), 15 ).'</p>';
			$default .= '</div>';
		endwhile; // end of while loop
		/* Restore original Post Data */
	    wp_reset_postdata();
			$default .= '</div>';
			$default .= '</article>';
			$default .= '</div>';
			$default .= '</div>';
			$default .= '</div>';
		endif; // end of if loop

			return $default;
		//endif;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in TM_Related_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The TM_Related_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'tmrp_bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), '4.1.3', 'all' );
		wp_enqueue_style( $this->tmrelatedposts, plugin_dir_url( __FILE__ ) . 'css/tm-related-posts-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in TM_Related_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The TM_Related_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->tmrelatedposts, plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

	}

}
