<?php

function wpdev_widgets(){
    register_sidebar(array(
        'name'              =>  __( 'WpDev Sidebar', 'wpdev' ),
        'id'                =>  'wpdev_sidebar',
        'description'       =>  __( 'sidebar for the theme WpDev', 'wpdev' ),
        'class'             =>  '',
        'before_widget' => '<aside id="%1$s" class="widget card %2$s"><div class="card-content">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h5 class="widgettitle">',
        'after_title'   => '</h5>'
    ));
}