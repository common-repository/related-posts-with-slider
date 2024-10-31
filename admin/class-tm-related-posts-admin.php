<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://tanvirmelon.com
 * @since      1.0.0
 *
 * @package    TMRelatedPosts
 * @subpackage TMRelatedPosts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    TMRelatedPosts
 * @subpackage TMRelatedPosts/admin
 * @author     Tanvir Islam <tanvirmelon2@gmail.com>
 */
class TM_Related_Posts_Admin {

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
	 * @param      string    $tmrelatedposts       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $tmrelatedposts, $version ) {

		$this->tmrelatedposts = $tmrelatedposts;
		$this->version = $version;
	    //this action callback is triggered when wordpress is ready to add new items to menu.
	    add_action("admin_menu", array(&$this, "tmrp_menu_items"));
		//this action is executed after loads its core, after registering all actions, finds out what page to execute and before producing the actual output(before calling any action callback)
		add_action("admin_init", array(&$this, "tmrp_display_options"));

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->tmrelatedposts, plugin_dir_url( __FILE__ ) . 'css/tm-related-posts-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->tmrelatedposts, plugin_dir_url( __FILE__ ) . 'js/tm-related-posts-admin.js', array( 'jquery' ), $this->version, false );

	}

	/* TM Settings Page Of Related Posts */
    public function tmrp_menu_items()
    {
        //add a new menu item. This is a top level menu item i.e., this menu item can have sub menus
        add_menu_page(
            "Related Post", //Required. Text in browser title bar when the page associated with this menu item is displayed.
            "Related Post", //Required. Text to be displayed in the menu.
            "manage_options", //Required. The required capability of users to access this menu item.
            "theme-optionss", //Required. A unique identifier to identify this menu item.
            array(&$this, "tmrp_theme_options_page"), //Optional. This callback outputs the content of the page associated with this menu item.
            "", //Optional. The URL to the menu item icon.
            100 //Optional. Position of the menu item in the menu.
        );

    }

    public function tmrp_theme_options_page()
    {
        ?>
            <div class="wrap">
            <div id="icon-options-general" class="icon32"></div>
            <h1>Related Post Setting</h1>
            <?php settings_errors(); //its works for save error show ?>
            <form method="post" action="options.php">
                <?php
               
                    //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
                    settings_fields("tmrp_header_section");
                   
                    // all the add_settings_field callbacks is displayed here
                    do_settings_sections("theme-optionss");
               
                    // Add the submit button to serialize the options
                    submit_button();
                   
                ?>         
            </form>
        </div>
        <?php
    }


    /*WordPress Settings API Demo*/

    public function tmrp_display_options()
    {
    	// All Callback to print form elemt
    	$tmrp_enable_c  = array(&$this, "tmrp_display_enable");
    	$tmrp_top_head  = array(&$this, "tmrp_display_top_head");
    	$tmrp_displ_he  = array(&$this, "display_header_options_content");
        //section name, display name, callback to print description of section, page to which section is attached.
        add_settings_section("tmrp_header_section", "Display", $tmrp_displ_he, "theme-optionss");

        //setting name, display name, callback to print form element, page in which field is displayed, section to which it belongs.
        //last field section is optional. 
        
        add_settings_field("tmrp_enable", "Enable", $tmrp_enable_c, "theme-optionss", "tmrp_header_section");
        add_settings_field("tmrp_heading", "Top Heading Title", $tmrp_top_head, "theme-optionss", "tmrp_header_section");

        //section name, form element name, callback for sanitization
        register_setting("tmrp_header_section", "tmrp_enable"); #"Copy"
        register_setting("tmrp_header_section", "tmrp_heading");
    }

    public function display_header_options_content(){echo "The header of the plugin";}
    public function tmrp_display_enable()
    {
        $tmrp_active = get_option('tmrp_enable');
        //id and name of form element should be same as the setting name.
        ?>
            <input type="checkbox" name="tmrp_enable" value="1" id="tmrp_enable" <?php echo $tmrp_active == 1 ? 'checked' : ''; ?> />
            <small id="tmrp_enable">If want to enable related post check it</small>
        <?php
    }
    public function tmrp_display_top_head()
    {
        $tmrp_heading = get_option('tmrp_heading');
        //id and name of form element should be same as the setting name.
        ?>
            <input type="text" name="tmrp_heading" id="tmrp_heading" value="<?php echo $tmrp_heading; ?>" />
        <?php
    }
}
