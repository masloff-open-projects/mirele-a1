<?php 
add_action( 'woocommerce_cart_mirele_manager_table_cart', 'woocommerce_cart_mirele_manager_table_cart_render' );

function woocommerce_cart_mirele_manager_table_cart_render () { ?>

<div class="woo-sub-manage-cart">
    <div class="info-panel">
        
    </div>

    <?php if ( wc_coupons_enabled() ) { ?>
        <div class="coupon el_2917040284">
            <input type="text" name="coupon_code" class="input-text el_2917040284" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Do you have a coupon? Enter it!', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
            <?php do_action( 'woocommerce_cart_coupon' ); ?>
        </div>
    <?php } ?>

    <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
    <?php if ( get_option('woo_move_the_next_button_to_the_panel_below_the_table', 'false') == 'true' ): ?>
        <button onclick="location.href='<?php echo wc_get_checkout_url(); ?>'; return false;" class="el_1548850895"> Contunte </button>
    <?php endif; ?>
</div>

<?php } ?>