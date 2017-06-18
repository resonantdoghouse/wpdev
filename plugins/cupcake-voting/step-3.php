<?php

function cupcake_activate() {
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'cupcake_activate' );

function cupcake_register_endpoints() {
	register_rest_route(
		'cupcake-voting/v1',
		'/votes/',
		array(
			'methods' => 'POST',
			'callback' => 'cupcake_add_vote',
		)
	);
}
add_action( 'rest_api_init', 'cupcake_register_endpoints' );

function cupcake_add_vote(  WP_REST_Request $request ) {
	$votes = intval( get_post_meta( $request->get_param( 'id' ), 'votes', true ) );
	if ( false === (bool) update_post_meta( $request->get_param( 'id' ), 'votes', $votes + 1 ) ) {
		return new WP_Error( 'vote_error', __( 'Unable to add vote', 'cupcake-voting' ), $request->get_param( 'id' ) );
	}
	return $votes + 1;
}
