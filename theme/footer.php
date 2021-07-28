<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme
 */

?>
        </main>
        <footer id="theme-footer">
            <?php 
                if (get_theme_mod('has_action')): 
                    $action = get_theme_mod( 'action', 'Call us on <a href="tel:01 2345 6789">01 2345 6789</a>' ); ?>
                <div id="action-bar" class="footer-section d-flex navbar navbar-dark">
                    <div class="container d-flex justify-content-center">
                        <div class="text-center"><?php echo $action; ?></div>
                    </div>
                </div>
            <?php endif; ?>
            <div id="footer-main" class="footer-section d-flex bg-primary text-light navbar navbar-dark">
                <div class="container">
                    <div class="row flex-grow-1">
                        <div class="footer-branding col-md">
                            <?php 
                            if (get_theme_mod('has_footerlogo')) : ?>
                                <div class="navbar-brand"> <?php
                                    if (has_custom_logo()) {
                                        the_custom_logo();
                                    } else {
                                        echo '<a href="'.home_url().'"><img src="'.get_stylesheet_directory_uri().'/assets/img/logo.svg" alt="'.get_bloginfo( 'name' ).'"></a>';
                                    } ?>
                                </div>
                            <?php endif; ?>
                            <div class="address">
                                <?php echo get_theme_mod( 'address', '' ); ?>
                            </div>
                            <?php $phone = get_theme_mod( 'phone', '' ); 
                                if (is_string($phone) && strlen($phone) > 0): ?>
                                <div class="phone">
                                    P: <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                                </div>
                            <?php endif; ?>
                            <?php $mobile = get_theme_mod( 'mobile', '' ); 
                                if (is_string($mobile) && strlen($mobile) > 0): ?>
                                <div class="mobile">
                                    M: <a href="tel:<?php echo $mobile; ?>"><?php echo $mobile; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="iconlist col-md d-flex align-items-end justify-content-center" id="social-links">
                            <ul>
                                <?php 
                                $iconlist = get_theme_mod( "social-links-list", [] );
                                foreach( $iconlist as $icon ) : ?>
                                    <li>
                                        <a 
                                            href="<?php echo $icon['icon_url']; ?>" 
                                            <?php echo $icon['new_window'] ? 'target="_blank"' : '' ?> 
                                        > 
                                            <span class="icon icon-<?php echo $icon['icon']; ?>"></span>
                                            <span class="text"><?php echo $icon['icon_text']; ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php
                            wp_nav_menu([
                                'theme_location' => 'footer',
                                'container'      => false,
                                'menu_class'     => 'nav navbar-nav text-md-end col-md',
                                'fallback_cb'    => '__return_false',
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'          => 2,
                                'walker'         => new bootstrap_5_wp_nav_menu_walker()
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <div id="footer-copyright" class="footer-section d-flex bg-dark text-light navbar navbar-dark">
                <div class="container d-flex justify-content-center">
                    <?php
                        $copyright = get_theme_mod( 'copyright-text', '&copy; YYYY '.get_bloginfo('name') );
                    ?>
                    <div class="text-center"><?php echo str_replace('YYYY', date('Y'), $copyright); ?>. <a class="text-light" href="https://2pisoftware.com">Designed and developed by <strong>2pi Software</strong></a></div>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>
