<?php

function wpdev_admin_enqueue(){
    if(!isset($_GET['page']) || $_GET['page'] != "wpdev_theme_opts" ){
        return;
    }

    wp_register_style( 'wpdev_materialize' , get_template_directory_uri() . '/css/materialize.min.css' );
    wp_register_style( 'wpdev_roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400' );
    wp_register_style( 'wpdev_material_icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' );

    wp_enqueue_style( 'wpdev_materialize' );
    wp_enqueue_style( 'wpdev_roboto' );
    wp_enqueue_style( 'wpdev_material_icons' );

    wp_register_script( 'wpdev_materialize' , get_template_directory_uri() . '/js/materialize.min.js', array(), false, true );
    wp_register_script( 'wpdev_option' , get_template_directory_uri() . '/js/options.js' );
    
    wp_enqueue_script( 'wpdev_materialize' );
    wp_enqueue_script( 'wpdev_option' );
}