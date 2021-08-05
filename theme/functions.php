<?php
/**
 * My theme WordPress functions 
 */
include_once get_theme_file_path( 'inc/kirki-installer.php' );

/**
 * Define what the theme supports
 */
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('admin-bar', ['callback' => '__return_false']);

function base_theme_custom_logo_setup()
{
    $defaults = [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => ['site-title', 'site-description'],
        'unlink-homepage-logo' => true,
    ];
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'base_theme_custom_logo_setup');

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/inc/wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

// Menus
register_nav_menu('navbar', __('Navbar', 'mytheme'));
register_nav_menu('footer', __('Footer', 'mytheme'));

function base_theme_styles()
{
    // Styles (or scripts that you want to load in the header should be here)
    wp_enqueue_style('base-css', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'base_theme_styles');

// Enqueue scripts (perferrably in the footer) as needed here
function base_theme_scripts()
{
    wp_enqueue_script('base-js', get_template_directory_uri() . '/js/theme.js', [], false, true);
}
add_action('wp_enqueue_scripts', 'base_theme_scripts');

include_once get_theme_file_path( 'inc/customiser.php' );

if (class_exists('WooCommerce')) {
    // Add woocommerce specific hooks/theme changes here

    /**
    * Adding support for custome WooCommerce theme files
    */
    add_action('after_setup_theme', 'theme_add_woocommerce_support');
    function theme_add_woocommerce_support()
    {
        add_theme_support('woocommerce');
    }

    add_action('after_setup_theme', 'twopi_base_theme_setup');
    function twopi_base_theme_setup()
    {
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }

    add_filter('woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1);
    function iconic_cart_count_fragments($fragments)
    {
        $fragments['div.header-cart-count'] = '<div class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</div>';
        
        return $fragments;
    }
}

// Change embed default size
add_filter( 'embed_defaults', 'bigger_embed_size' );
         
function bigger_embed_size()
{
return array( 'width' => 700, 'height' => 450 );
}