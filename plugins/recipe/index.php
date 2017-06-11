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
include( 'process/save-post.php' );
include( 'process/filter-content.php' );


// Hooks
register_activation_hook( __FILE__, 'r_activate_plugin' );
add_action( 'init', 'recipe_init' );
add_action( 'admin_init', 'recipe_admin_init' );
add_action( 'save_post_recipe', 'r_save_post_admin', 10, 3 );
add_filter( 'the_content', 'r_filter_recipe_content' );


// Shortcodes
