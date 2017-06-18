<?php
/**
 * Plugin Name: Rested
 * Plugin URI: https://buildcreativewebsites.com
 * Description: Forces featured image set before publishing post
 * Version: 1.0
 * Author: BCW
 * Author URI: https://buildcreativewebsites.com
 * Text Domain: rested
 * License: GPLv2 or later
 */


function cupcake_activate(){
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'cupcake_activate' );


function cupcake_register_endpoints(){
	register_rest_route(
		'cupcake-voting/v1',
		'/votes/',
		array(
			'methods'   => 'POST',
			'callback'  => 'cupcake_add_vote',
		)
	);
}
add_action( 'rest_api_init', 'cupcake_register_endpoints' );


function cupcake_add_vote( WP_REST_Request $request ){

	return $request->get_params();
}