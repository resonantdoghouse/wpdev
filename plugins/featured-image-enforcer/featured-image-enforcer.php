<?php

define( 'FEATURED_ENFORCER_VERSION', 1 );

function featured_image_enforcer_enqueue_scripts( $hook ) {
	if ( 'post-new.php' != $hook ) {
		return;
	}

	wp_enqueue_script(
		'featured-image-enforcer',
		plugins_url( 'js/featured-image-enforcer.js', __FILE__ ),
		array( 'jquery' ),
		FEATURED_ENFORCER_VERSION,
		true
	);

	wp_localize_script(
		'featured-image-enforcer',
		'featured_image_data',
		array(
			'message' => __( 'Please select a featured image first', 'featured-image-enforcer' )
		)
	);
}

add_action( 'admin_enqueue_scripts', 'featured_image_enforcer_enqueue_scripts' );
