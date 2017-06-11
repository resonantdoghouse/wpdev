<?php
/**
 * Plugin Name: Recipe
 * Description: Simple recipe plugin with ratings
 * Version: 0.0.1
 * Author URI: http://wpfork.com
 * Text Domain: recipe
 */


if( !function_exists( 'add_action' ) ){
    echo 'Not allowed!';
    exit();
}


// Setup
define( 'RECIPE_PLUGIN_URL', __FILE__ );

// Includes
include( 'inc/activate.php' );
include( 'inc/init.php' );
include( 'inc/admin/init.php' );


// Hooks
register_activation_hook( __FILE__, 'r_activate_plugin' );
add_action( 'init', 'recipe_init' );
add_action( 'admin_init', 'recipe_admin_init' );

// Shortcodes
