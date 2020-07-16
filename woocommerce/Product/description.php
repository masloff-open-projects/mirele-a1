<?php

function woocommerce_single_product_mirele_description_render() {
    
    global $product;

    if ($product->description) {
        ?>

        <div class="el_2933607387">
            <h3>Description</h3>
            <p> <?php echo $product->description; ?> </p>
        </div>

        <?php
    }
}
?>
