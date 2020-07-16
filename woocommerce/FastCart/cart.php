<?php
/**
 * Fast Cart
 * 
 * @package MIRELE/Templates
 * @version 1.0.0
 */

function woocommerce_cart_mirele_fastcart_render () {
    ?>

    <div class='woo-fastcart'>

        <?php if (get_option('woo_fastcart_hide_title', 'false') != 'true'): ?>
        <h4 id="mirele_fast_cart_title">
            <?php echo get_option('woo_fastcart_title', 'Fast cart') ?> <small id="mirele_fast_cart_total"></small>
        </h4>
        <?php endif; ?>

        <div class='woo-fastcart-body'> </div>
    </div>

    <?php

}