<?php

function woocommerce_single_product_mirele_image_render () {

    global $product;
    $modern_picture = (get_option('woo_product_modern_picture_offer', 'false') == 'true');
    
    $gallery = $product->get_gallery_image_ids();
    $offer = $product->get_image_id(); 

    ?>
    
    
    <div id="product" class="carousel slide" data-ride="carousel" <?php echo ($modern_picture ? sprintf("style='background-image: url(%s);background-size: cover;background-position: center;'", $product->get_image_id() ? wp_get_attachment_url($product->get_image_id()) : wc_placeholder_img_src()) : ''); ?>>
        <div class="carousel-inner" <?php echo ($modern_picture ? 'style="backdrop-filter: blur(12px); border: solid 1px rgba(128, 128, 128, .25);"' : ''); ?>>
            
            <div class="item active">
                <img src="<?php echo wp_get_attachment_url( $offer ); ?>" id="product-picture" class="woo-gallery-product" data-lightboximage>
            </div>

            <?php foreach ($gallery as $id): ?>
                <div class="item">
                    <img src="<?php echo wp_get_attachment_url( $id ); ?>" class="woo-gallery-product" data-lightboximage>
                </div>
            <?php endforeach; ?>
            
        </div>
            
        <?php if (count($gallery) + 1 > 1): ?>

            <a class="left carousel-control" href="#product" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#product" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

        <?php endif; ?>

    </div>

    <?php
}