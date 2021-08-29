<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header id="theme-header">
        <div id="header-main" class="footer-section d-flex bg-primary text-light navbar navbar-dark" style="border-bottom: solid 5px #070D1F";>
                <div class="container">
                    <div class="row flex-grow-1">
                        <div class="footer-branding col-md">
                            <?php 
                            if (get_theme_mod('has_footerlogo')) : ?>
                                <div class="navbar-brand"> <?php
                                    if (has_custom_logo()) {
                                        the_custom_logo();
                                    } else {
                                        echo '<a href="'.home_url().'"><img src="'.get_stylesheet_directory_uri().'/assets/img/Generic logo.svg" alt="'.get_bloginfo( 'name' ).'"></a>';
                                    } ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                            wp_nav_menu([
                                'theme_location' => 'footer',
                                'container'      => false,
                                'menu_class'     => 'nav navbar-nav text-md-center col-md',
                                'fallback_cb'    => '__return_false',
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'          => 2,
                                'walker'         => new bootstrap_5_wp_nav_menu_walker()
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </header>
        <main role="main" id="theme-content">
