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
            <a id="logo-container" href="<?php echo home_url(); ?>" class="brand-logo">
                <?php bloginfo( 'name' ); ?>
            </a>

            <?php 
            wp_nav_menu(array(
                'theme_location'        =>  'primary',
                'container'             =>  false,
                'menu_class'            =>  'right hide-on-med-and-down'
            )); 
            ?>
            
        </div>
    </nav>
  