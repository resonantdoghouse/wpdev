<?php
// TODO: Add plugin header

define( 'CUPCAKE_VOTING_VERSION', 1 );

/**
 * We need to flush the rewrite rules because of our definition of a new REST API route
 */
function cupcake_activate() {
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'cupcake_activate' );

function cupcake_register_endpoints() {
	register_rest_route(
		'cupcake-votings/v1',
		'/votes/',
		array(
			'methods' => 'POST',
			'callback' => 'cupcake_add_vote',
			'args' => array(
				'id' => array(
					'required' => true,
					'validate_callback' => function($param, $request, $key) {
						return is_numeric( $param );
					},
					'sanitize_callback' => 'absint'
				)
			)
		)
	);
}
add_action( 'rest_api_init', 'cupcake_register_endpoints' );

function cupcake_enqueue_scripts() {
	wp_enqueue_script(
		'cupcake-voting-js',
		plugins_url( 'js/cupcake-voting.js', __FILE__ ),
		array( 'jquery' ),
		CUPCAKE_VOTING_VERSION,
		true
	);
	wp_localize_script(
		'cupcake-voting-js',
		'cupcake_voting_data',
		array(
			'api_url' => rest_url( '/cupcake-voting/v1/' ),
			'success_message' => __( 'Thanks for voting!', 'cupcake-voting' ),
			'error_message' => __( 'There was an error processing your vote', 'cupcake-voting' )
		)
	);
}
add_action( 'wp_enqueue_scripts', 'cupcake_enqueue_scripts' );

function cupcake_add_vote( WP_REST_Request $request ) {
	$votes = intval( get_post_meta( $request->get_param( 'id' ), 'votes', true ) );

	if ( false === (bool) update_post_meta( $request->get_param( 'id' ), 'votes', $votes + 1 ) ) {
		return new WP_Error( 'vote_update_error', __( 'Unable to update votes', 'cupcake_voting' ), array( 'status' => 500 ) );
	}

	return $votes + 1;
}

function cupcake_add_vote_html( $content ) {
	if ( 'post' == get_post_type() and is_main_query() ) {
		$content .= '<p>' . sprintf(
					esc_html( __( '%s%d%s vote(s)', 'cupcake-voting' ) ),
					'<span class="vote_count" id="vote-count-' . get_the_ID() . '">',
					intval( get_post_meta( get_the_ID(), 'votes', true ) ),
					'</span>'
				) . '</p>';
		$content .= '<p><a href="#" class="cupcake_vote" data-post-id="' . get_the_ID() . '">' .
		            esc_html( __( 'Votes!', 'cupcake-voting' ) ) .
		            '</a></p>';
	}
	return $content;
}
add_filter( 'the_excerpt', 'cupcake_add_vote_html' );