<?php

/**
 * Fired during plugin constants
 *
 * @link       http://tanvirmelon.com
 * @since      1.0.0
 *
 * @package    TMRelatedPosts
 * @subpackage TMRelatedPosts/includes
 */

/**
 * Fired during plugin constants.
 *
 * This class defines all code necessary to run during the plugin's constants.
 *
 * @since      1.0.0
 * @package    TMRelatedPosts
 * @subpackage TMRelatedPosts/includes
 * @author     Tanvir Islam <tanvirmelon2@gmail.com>
 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/*Stylesheet Version*/
if( ! defined( 'TMRELATEDPOSTS_STYLESHEET_VERSION' ) ){
	define( 'TMRELATEDPOSTS_STYLESHEET_VERSION', '1.0.0' );
}
/*Js Version*/
if( ! defined( 'TMRELATEDPOSTS_JS_VERSION' ) ){
	define( 'TMRELATEDPOSTS_JS_VERSION', '1.0.0' );
}

/**
 * Currently plugin version.
 * Start at version 1.0.0
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TMRELATEDPOSTS_VERSION', '1.0.0' );

/**
 * Sets the path to the parent admin.
 */
if( ! defined( 'TMRELATEDPOSTS_ADMIN_PATH' ) ){
    define( "TMRELATEDPOSTS_ADMIN_PATH", trailingslashit( TMRELATEDPOSTS_PATH . 'admin' ) );
}

/**
 * Sets the path to the parent admin >> partials.
 */

if( ! defined( 'TMRELATEDPOSTS_APRL_PATH' ) ){
    define( "TMRELATEDPOSTS_APRL_PATH", trailingslashit( TMRELATEDPOSTS_ADMIN_PATH . 'partials' ) );
}

/**
 * Sets the path to the parent public.
 */
if( ! defined( 'TMRELATEDPOSTS_PUBLIC_PATH' ) ){
    define( "TMRELATEDPOSTS_PUBLIC_PATH", trailingslashit( TMRELATEDPOSTS_PATH . 'public' ) );
}

/**
 * Sets the path to the parent public >> partials.
 */
if( ! defined( 'TMRELATEDPOSTS_PRL_PATH' ) ){
    define( "TMRELATEDPOSTS_PRL_PATH", trailingslashit( TMRELATEDPOSTS_PUBLIC_PATH . 'partials' ) );
}

/**
 * Sets the path to the parent public >> css.
 */
if( ! defined( 'TMRELATEDPOSTS_PCSS_PATH' ) ){
    define( "TMRELATEDPOSTS_PCSS_PATH", trailingslashit( TMRELATEDPOSTS_PUBLIC_PATH . 'css' ) );
}

/**
 * Sets the path to the parent public >> js.
 */
if( ! defined( 'TMRELATEDPOSTS_PJS_PATH' ) ){
    define( "TMRELATEDPOSTS_PJS_PATH", trailingslashit( TMRELATEDPOSTS_PUBLIC_PATH . 'js' ) );
}
