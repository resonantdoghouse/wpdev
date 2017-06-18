<?php
/*
Plugin Name: Cupcake Voting
Plugin URI: http://brianhogg.com/
Description: Ability to vote for your favourite cupcakes
Version: 1.0
Author: Brian Hogg
Author URI: https://brianhogg.com
License: GPLv2 or later
*/

define( 'CUPCAKE_VOTING_VERSION', 1 );

function cupcake_activate() {
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'cupcake_activate' );

function cupcake_register_endpoints() {
	register_rest_route(
		'cupcake-voting/v1',
		'/votes/(?P<id>[\d]+)',
		array(
			'methods' => 'GET',
			'callback' => 'cupcake_get_vote',
			'permission_callback' => function() {
				return true;
			},
			'args' => array(
				'id' => array(
					'validate_callback' => function($param, $request, $key) {
						return ! is_null( get_post( $param ) );
					}
				)
			)
		)
	);
	register_rest_route(
		'cupcake-voting/v1',
		'/votes/',
		array(
			array(
				'methods' => 'GET',
				'callback' => 'cupcake_get_votes',
				'permission_callback' => function() {
					return current_user_can( 'manage_options' );
				}
			),
			array(
				'methods' => 'POST',
				'callback' => 'cupcake_add_vote',
				'args' => array(
					'id' => array(
						'required' => true,
						'validate_callback' => 'is_numeric',/*function($param, $request, $key) {
							return is_numeric( $param ) and ! is_null( get_post( $param ) );
						},*/
						'sanitize_callback' => 'absint'
					),
					'rating' => array(
						'required' => true,
						'validate_callback' => function($param, $request, $key) {
							return is_numeric( $param ) and intval( $param ) >= 1 and intval( $param ) <= 5;
						},
						'sanitize_callback' => 'absint'
					),
					'review' => array(
						'required' => false,
						'sanitize_callback' => function($param, $request, $key) {
							return strip_tags( $param );
						}
					)
				)
			)
		)
	);
}
add_action( 'rest_api_init', 'cupcake_register_endpoints' );

function cupcake_get_votes( $request ) {
	// get all votes
	return array();
}

function cupcake_get_vote( $request ) {
	return intval( get_post_meta( $request->get_param( 'id' ), 'votes', true ) );
}

function cupcake_enqueue_scripts() {
	$js_suffix = WP_DEBUG ? '' : '.min';
	wp_enqueue_script(
		'cupcake-voting-js',
		plugins_url( 'js/cupcake-voting' . $js_suffix . '.js', __FILE__ ),
		array( 'jquery' ),
		CUPCAKE_VOTING_VERSION,
		true
	);
	wp_localize_script(
		'cupcake-voting-js',
		'cupcake_voting_data',
		array(
			'nonce' => wp_create_nonce( 'wp_rest' ),
			'base_url' => rest_url( '/cupcake-voting/v1/' ),
			'success_message' => __( 'Thanks for voting!', 'cupcake-voting' ),
			'error_message' => __( 'There was an error processing your vote', 'cupcake-voting' )
		)
	);
}
add_action( 'wp_enqueue_scripts', 'cupcake_enqueue_scripts' );

function cupcake_add_vote(  WP_REST_Request $request ) {
	return $request->get_params();
	$votes = intval( get_post_meta( $request->get_param( 'id' ), 'votes', true ) );
	if ( false === (bool) update_post_meta( $request->get_param( 'id' ), 'votes', $votes + 1 ) ) {
		return new WP_Error( 'vote_error', __( 'Unable to add vote', 'cupcake-voting' ), $request->get_param( 'id' ) );
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
		            esc_html( __( 'Vote!', 'cupcake-voting' ) ) .
		            '</a></p>';
	}
	return $content;
}
add_filter( 'the_excerpt', 'cupcake_add_vote_html' );