<?php

function wpdev_admin_menus(){
    add_menu_page(
        'WpDev Theme Options',
        'Theme Options',
        'edit_theme_options',
        'wpdev_theme_opts',
        'wpdev_theme_opts_page'
    );
}