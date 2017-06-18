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

define( 'CUPCAKE_VOTING_VERSION', 1.1 );


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
					'sanitize_callback' => 'absint'
				)
			),
			'permission_callback' => function(){
				return is_user_logged_in();
			}
		)
	);
}
add_action( 'rest_api_init', 'cupcake_register_endpoints' );


function cupcake_enqueue_scripts(){
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
			'nonce'             => wp_create_nonce( 'wp_rest' ),
			'base_url'          => rest_url( '/cupcake-voting/v1/' ),
			'success_message'   => __( 'Thanks for voting!', 'rested' ),
			'error_message'     => __( 'Error processing vote', 'rested' )
		)
	);
}
add_action( 'wp_enqueue_scripts', 'cupcake_enqueue_scripts' );


function cupcake_add_vote( WP_REST_Request $request ){
	$votes = intval( get_post_meta( $request->get_param( 'id' ), 'votes', true ) );
	if ( false === (bool) update_post_meta( $request->get_param( 'id' ), 'votes', $votes +1 ) )
		{
			return new WP_ERROR( 'vote_error', __( 'Unable to add vote', 'rested' ), $request->get_param( 'id' ) );
		}
		return $votes + 1;
}


function cupcake_add_vote_html( $content ){
	if ( 'post'== get_post_type() and is_main_query() ) {
		$content .= '<p>' . sprintf(
				esc_html( __( '%s%d%s vote(s)', 'rested' ) ),
				'<span class="vote-count" id="vote-count-' . get_the_ID() . '">',
					intval( get_post_meta( get_the_ID(), 'votes', true ) ),
				'</span>'
			) . '</p>';
		$content .= '<p><a href="#" class="cupcake_vote" data-post-id="' . get_the_ID() . '">' .
	                esc_html( __( 'Vote!', 'rested' ) ) .
	                '</a></p>';
	}
	return $content;
}
add_filter( 'the_excerpt', 'cupcake_add_vote_html' );












