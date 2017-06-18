<?php
/*...*/

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

function cupcake_add_vote() {

}
