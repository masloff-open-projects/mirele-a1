<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/Woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>

<h5 class="el_3825098092"> <?php echo wc_price($product->price) ?> </span> </h5>

<?php if ($product->regular_price != $product->price && $product->regular_price): ?>
	<h3 class="el_1851147446"> <strike> <?php echo wc_price($product->regular_price) ?> </span></strike> </h3>
<?php endif; ?>