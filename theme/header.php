<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header id="theme-header">
            <nav class="navbar navbar-expand-md navbar-dark bg-primary">
                <div class="container">
                    <div class="navbar-brand">
                        <?php
                            if (has_custom_logo()) {
                                the_custom_logo();
                            } else {
                                echo '<a href="'.home_url().'"><img src="'.get_stylesheet_directory_uri().'/assets/img/logo.svg" alt="'.get_bloginfo( 'name' ).'"></a>';
                            }
                        ?>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-column align-items-end" id="navbarCollapse">
                        <form class="form-inline mt-2 mt-md-0" id="theme-search" action="/" method="get">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="s">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                        <?php
                            wp_nav_menu([
                                'theme_location' => 'navbar',
                                'container'      => false,
                                'menu_class'     => 'nav navbar-nav navbar-md-end',
                                'fallback_cb'    => '__return_false',
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'          => 2,
                                'walker'         => new bootstrap_5_wp_nav_menu_walker()
                            ]);
                        ?>
                    </div>
                </div>
            </nav>
        </header>
        <main role="main" id="theme-content">
