<?php
$theme_opts  = get_option('wpdev_opts');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    <?php wp_head(); ?>
</head>
<body>

    <nav class="blue-grey darken-4" role="navigation">
        <div class="nav-wrapper container">

            <?php
            if($theme_opts['logo_type'] == 1){
              ?>
              <a id="logo-container" href="<?php echo home_url(); ?>" class="brand-logo">
                <?php bloginfo( 'name' ); ?>
              </a>
              <?php
            } else {
              ?>
              <a id="logo-container" href="<?php echo home_url(); ?>" class="brand-logo">
                <img class="brand-logo-img" src="<?php echo $theme_opts['logo_img']; ?>">
              </a>
              <?php
            }
            ?>



            <!-- theme options -->
            <ul class="right">
              <?php
              if(!empty($theme_opts['twitter'])){
              ?>
                <li>
                  <a href="https://twitter.com/<?php echo $theme_opts['twitter']?>">
                    <i class="material-icons">star</i>
                  </a>
                </li>
              <?php
              }
              if(!empty($theme_opts['facebook'])){
              ?>
                <li>
                  <a href="https://facebook.com/<?php echo $theme_opts['facebook']?>">
                    <i class="material-icons">star</i>
                  </a>
                </li>
              <?php
              }if(!empty($theme_opts['youtube'])){
                ?>
                  <li>
                    <a href="https://youtube.com/user/<?php echo $theme_opts['youtube']?>">
                      <i class="material-icons">star</i>
                    </a>
                  </li>
              <?php
              }
              ?>
            </ul>


            <?php
            wp_nav_menu(array(
                'theme_location'        =>  'primary',
                'container'             =>  false,
                'menu_class'            =>  'right hide-on-med-and-down'
            ));
            ?>

        </div>
    </nav>
