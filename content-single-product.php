<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/Woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
global $varinats;
global $post;

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

if ($product->is_type( 'variable' ) === true) {

	$varinats = [];
	foreach ($product->get_available_variations() as $i => $variant) {
		$varinats[$variant['variation_id']] = $variant;
	}

	echo "<script> document.variants = " .json_encode($varinats) . "; </script>";
}

?>


<?php if ($product->status == 'publish') { 
	
	do_action( 'woocommerce_before_single_product' ); ?>

    <span itemscope itemtype="http://schema.org/Product">
        <meta itemprop="sku" content="<?php echo apply_filters('woocommerce_mirele_sku_single_product', $product->sku); ?>">
            <meta itemprop="mpn" content="925873">
            <meta itemprop="image" content="<?php echo wp_get_attachment_url($product->get_image_id()); ?>"/>
            <meta itemprop="name" content="<?php echo apply_filters('woocommerce_mirele_title_single_product', $product->name);?>">
            <meta itemprop="description" content="<?php echo apply_filters('woocommerce_mirele_description_product', $product->description);?>">

            <?php if (!empty($product->get_attribute('pa_brand'))): ?>
                <meta itemprop="brand" content="<?php echo $product->get_attribute('pa_brand');?>">
            <?php endif; ?>

        <?php if (!empty($product->get_attribute('pa_color'))): ?>
            <meta itemprop="color" content="<?php echo $product->get_attribute('pa_color');?>">
        <?php endif; ?>

            <span itemprop="audience" itemscope itemtype="http://schema.org/PeopleAudience">
                <meta itemprop="suggestedGender" content="unisex"/>
            </span>

            <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency()?>"/>
                <meta itemprop="price" content="<?php echo $product->get_price();?>">
                <link itemprop="itemCondition" href="http://schema.org/UsedCondition"/>
                <link itemprop="availability" href="http://schema.org/InStock"/>
            </span>
        </span>

	<div class="container <?php if ($product->is_type( 'variable' )) {echo 'el_2574282525';} ?> el_195996781" id="form-product-container">

	<?php do_action( 'woocommerce_before_single_product_summary' );  ?>

		<div class="row">
			
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 el_2066683423">
				
				<?php

					/**
					 * Hook: woocommerce_single_product_mirele_image
					 *
					 */
					do_action( 'woocommerce_single_product_mirele_image' );

				?>

			</div>
			
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 el_1462076611">
				
				<?php
				
					/**
					 * Hook: woocommerce_single_product_mirele_form
					 *
					 */

					do_action( 'woocommerce_single_product_mirele_form' );
					do_action( 'woocommerce_single_product_summary' );

				?>
				
			</div>
			
		</div>

		<?php
		
			/**
			 * Hook: woocommerce_after_single_product_summary
			 *
			 */
		
			do_action( 'woocommerce_after_single_product_summary' );

		?>
	

	</div>
	
	<?php
	if (is_active_sidebar('single-product-bar-after-form')) {
        mirele_execute_component('sidebar', get_option('mrl_wp_sidebar', 'white'), ( 'single-product-bar-after-form' ));
	}
	?>

	<?php
		
		/**
		 * Hook: woocommerce_single_product_mirele_description
		 *
		 */
		do_action( 'woocommerce_single_product_mirele_description' );


		if (get_option('woo_show_related_products_in_single_product_page', 'true') == 'true') {
			
			do_action( 'action_woo_show_related_products_in_single_product_page' );

			echo "<div class='el_2933607387'>";
			
			woocommerce_related_products( array(
				'posts_per_page' => 4,
				'columns'        => 4,
				'orderby'        => 'rand'
			) );

			echo "</div>";

		}

		if (is_active_sidebar('single-product-bar-after-page')) {
            mirele_execute_component('sidebar', get_option('mrl_wp_sidebar', 'white'), ( 'single-product-bar-after-page' ));
		}

		/**
		 * Hook: mirele_comments
		 *
		 */
		do_action( 'mirele_comments', $post->ID);
		do_action( 'mirele_comment_form', $post->ID);

	do_action( 'woocommerce_after_single_product' );

} else {
	
	/**
	 * Hook: woocommerce_single_product_mirele_disabled_product
	 *
	 */
	do_action( 'woocommerce_single_product_mirele_disabled_product' );

} ?>

