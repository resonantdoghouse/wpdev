<?php

function wpdev_setup_theme(){
    register_nav_menu( 'primary', __('Primary Menu', 'wpdev') );
}