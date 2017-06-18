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
			'args'      => array(
				'id'        => array(
					'required' => true,
					'validate_callback' => function( $param, $request, $key ){
						return is_numeric( $param ) and ! is_null( get_post( $param ) );
					},
					'sanitize_calback' => 'absint'
				)
			)
		)
	);
}
add_action( 'rest_api_init', 'cupcake_register_endpoints' );


function cupcake_add_vote( WP_REST_Request $request ){

	$votes = intval( get_post_meta( $request->get_param( 'id' ), 'votes', true ) );

	if ( false === (bool) update_post_meta( $request->get_param( 'id' ), 'votes', $votes +1 ) )
		{
			return new WP_ERROR( 'vote_error', __( 'Unable to add vote', 'rested' ), $request->get_param( 'id' ) );
		}
		return $votes + 1;

}