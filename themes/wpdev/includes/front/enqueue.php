<?php

function wpdev_enqueue(){
    wp_register_style( 'wpdev_materialize' , get_template_directory_uri() . '/css/materialize.min.css' );
    wp_register_style( 'wpdev_roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400' );
    wp_register_style( 'wpdev_material_icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' );
    wp_register_style(  'wpdev_custom', get_template_directory_uri() . '/css/custom.css'  );

    wp_enqueue_style( 'wpdev_materialize' );
    wp_enqueue_style( 'wpdev_roboto' );
    wp_enqueue_style( 'wpdev_material_icons' );
    wp_enqueue_style( 'wpdev_custom' );


    wp_register_script( 'wpdev_materialize' , get_template_directory_uri() . '/js/materialize.min.js', array(), false, true );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'wpdev_materialize' );
}