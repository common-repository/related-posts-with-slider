<?php
/**
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://tanvirmelon.com
 * @since             1.0.0
 * @package           TMRelatedPosts
 *
 * @wordpress-plugin
 * Plugin Name:       Related Posts With Slider
 * Plugin URI:        http://tanvirmelon.com/tm-related-posts-uri/
 * Description:       This plugin will enable as Related Posts in your wordpress theme. you can embed Related Posts without any code in everywhere you want, even in theme files.
 * Version:           1.0.0
 * Author:            Tanvir Islam
 * Author URI:        http://tanvirmelon.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt Change
 * Text Domain:       tmrelatedposts
 * Domain Path:       /languages
 */


/**
 * Copyright (c) 2018 Tanvir Islam (email: tanvirmmelon2@gmail.com). All rights reserved.
 *
 * This is an add-on for WordPress
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Sets the path &
 * That is Include path
 */
if( ! defined( 'TMRELATEDPOSTS_PATH' ) ){
    define( "TMRELATEDPOSTS_PATH", trailingslashit( dirname( __FILE__ ) ) );
}

/**
 * The code that runs during plugin includes functionaltiy.
 * This action is documented in includes
 */
if( ! defined( 'TMRELATEDPOSTS_INC_PATH' ) ){
    define( "TMRELATEDPOSTS_INC_PATH", trailingslashit( TMRELATEDPOSTS_PATH . 'includes' ) );
}

/**
 * The core plugin class that is used to define plugin constant,
 *
 */
require_once TMRELATEDPOSTS_INC_PATH . 'class-tm-related-posts-constants.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tm-related-posts-activator.php
 */
function activate_tmrelatedposts() {
	require_once TMRELATEDPOSTS_INC_PATH . 'class-tm-related-posts-activator.php';
	TM_Related_Posts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tm-related-posts-deactivator.php
 */
function deactivate_tmrelatedposts() {
	require_once TMRELATEDPOSTS_INC_PATH . 'class-tm-related-posts-deactivator.php';
	TM_Related_Posts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tmrelatedposts' );
register_deactivation_hook( __FILE__, 'deactivate_tmrelatedposts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require TMRELATEDPOSTS_INC_PATH . 'class-tm-related-posts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tmrelatedposts() {

	$plugin = new TM_Related_Posts();
	$plugin->run();

}
run_tmrelatedposts();
