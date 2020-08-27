<?php
add_action('woocommerce_checkout_mirele_coupon', 'woocommerce_checkout_mirele_coupon_render');

function woocommerce_checkout_mirele_coupon_render() {
?>
    

    <form class="woo-coupon-form" method="post">

        <p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></p>

        <div class="container-fluid el_392719154">
            <div class="row">
                
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <input type="text" name="coupon_code" class="el_1031851554" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
                </div>

                
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <button type="submit" class="el_1031851554" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
                </div>
                
                
            </div>
        </div>

    </form>
<?php } ?>