<?php

function wpdev_admin_init(){
    include( 'enqueue.php' );
    add_action( 'admin_enqueue_scripts', 'wpdev_admin_enqueue' );
}