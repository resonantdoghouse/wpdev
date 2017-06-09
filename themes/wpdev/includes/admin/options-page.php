<?php

function wpdev_theme_opts_page(){
  $theme_opts               = get_option( 'wpdev_opts' );
?>

<div class="wrap">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4 class="panel-title"><?php _e('WpDev Theme Settings', 'wpdev' ); ?></h4>
        </div>
        <div class="panel-body row">

            <?php
            if(isset($_GET['status']) && $_GET['status'] == 1){
              ?>
              <div class="col s12">
                <h6 class="blue-text">Success!!!</h6>
              </div>

              <?php
            }
            ?>

            <form class="col s12" method="post" action="admin-post.php">

                <input type="hidden" name="action" value="wpdev_save_options">
                <?php wp_nonce_field( 'wpdev_options_verify' ); ?>

                <div class="row">
                    <h5><?php _e('Social Icons', 'wpdev'); ?></h5>
                    <div class="col s4">
                        <div class="input-field">
                            <input type="text" class="form-control" name="wpdev_inputTwitter" id="wpdev_inputTwitter"
                                   value="<?php echo $theme_opts['twitter']?>">
                            <label for="wpdev_inputTwitter"><?php _e('Twitter', 'wpdev'); ?></label>
                        </div>
                    </div>
                    <div class="col s4">
                        <div class="input-field">
                            <input type="text" class="form-control" name="wpdev_inputFacebook" id="wpdev_inputFacebook"
                                   value="<?php echo $theme_opts['facebook']?>">
                            <label for="wpdev_inputFacebook"><?php _e('Facebook', 'wpdev'); ?></label>
                        </div>
                    </div>
                    <div class="col s4">
                        <div class="input-field">
                            <input type="text" class="validate" name="wpdev_inputYoutube" id="wpdev_inputYoutube"
                                   value="<?php echo $theme_opts['youtube']?>">
                            <label for="wpdev_inputYoutube"><?php _e('YouTube', 'wpdev'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <h5><?php _e('Logo', 'wpdev'); ?></h5>

                    <div class="col s2">
                        <div class="input-field">
                            <select name="wpdev_inputLogoType" id="wpdev_inputLogoType">
                                <option value="1"><?php _e('Site Name', 'wpdev'); ?></option>
                                <option value="2" <?php echo $theme_opts['logo_type'] == 2 ? 'SELECTED' : '' ;?>><?php _e('Image', 'wpdev'); ?></option>
                            </select>
                            <label for="wpdev_inputLogoType"><?php _e('Logo Type', 'wpdev'); ?></label>
                        </div>
                    </div>

                    <!-- image upload -->
                    <div class="col s10">
                        <div class="file-field input-field">
                            <div class="btn" id="wpdev_uploadLogoImgBtn">
                                <span><?php _e( 'Logo Image', 'wpdev' ); ?></span>
                                <input type="file" id="wpdev_inputLogoImgBtn">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text"
                                       id="wpdev_inputLogoImg" name="wpdev_inputLogoImg"
                                       value="<?php echo $theme_opts['logo_img']; ?>">
                            </div>
                        </div>
                    </div>

                </div><!-- .row -->

                <div class="row">
                    <h5><?php _e('Footer', 'wpdev'); ?></h5>
                    <div class="col s12">
                        <div class="input-field">
                            <label><?php _e('Footer Text (HTML Allowed)', 'wpdev'); ?></label>
                            <textarea class="materialize-textarea" name="wpdev_inputFooter"><?php echo stripslashes_deep($theme_opts['footer'])?></textarea>
                        </div>
                        <div class="input-field">
                            <button type="submit" class="btn btn-primary"><?php _e('Update', 'wpdev'); ?></button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<?php
}
