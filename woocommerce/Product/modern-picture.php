<?php

function woocommerce_loop_product_mirele_modern_picture_render () {
    
    global $product;

    if ($product->get_image_id()) {
        $thumbl = wp_get_attachment_image_src($product->get_image_id(), 'thumbnail');
    }

    $image = $product->get_image_id() ? ($thumbl != false ? $thumbl[0] : wc_placeholder_img_src()) : wc_placeholder_img_src();

    ?>

    <div <?php echo get_option('woo_product_lazy_loader', 'false') == 'true' ? 'data-loading="lazy" data-src="' . $image . '"' : 'style="background-image: url(' . $image . ')"'; ?> class="woo-modern-picture-background">
        <img <?php echo get_option('woo_product_lazy_loader', 'false') == 'true' ? 'data-loading="lazy" data-src="' . $image . '"' : 'src="' . $image . '"'; ?> class="woo-modern-picture">
    </div>

    <?php

}