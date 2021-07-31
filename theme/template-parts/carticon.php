<?php if (class_exists('WooCommerce') && function_exists('WC')) : ?>
    <a href="<?php echo get_template_directory_uri() ?>/cart/">
        <div class="cart-contents"><div class="header-cart-count ">
                <?php echo WC()->cart->get_cart_contents_count(); ?> 
            </div>
        </div>
    </a>
<?php endif;
