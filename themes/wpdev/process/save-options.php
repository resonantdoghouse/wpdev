<?php


function wpdev_save_options(){
  if ( !current_user_can( 'edit_theme_options' ) ){
    wp_die( __('You are not allowed to be on this page.') );
  }

  check_admin_referer( 'wpdev_options_verify' );

  $opts                       = get_option( 'wpdev_opts' );
  $opts['twitter']            = sanitize_text_field( $_POST['wpdev_inputTwitter']);
  $opts['facebook']           = sanitize_text_field( $_POST['wpdev_inputFacebook']);
  $opts['youtube']            = sanitize_text_field( $_POST['wpdev_inputYoutube']);
  $opts['logo_type']          = absint( $_POST['wpdev_inputLogoType']);
  $opts['footer']             = $_POST['wpdev_inputFooter'];
  $opts['logo_img']           = esc_url_raw($_POST['wpdev_inputLogoImg']);

  update_option( 'wpdev_opts', $opts );
  wp_redirect( admin_url('admin.php?page=wpdev_theme_opts&status=1') );

}
