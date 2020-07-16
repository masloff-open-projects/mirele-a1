<?php get_header();

/**
 * :) Sorry, i dont know what write to this comment
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

$width__ = get_option('mrl_wp_sidebar_width_2_active', 2);
$width_ = get_option('mrl_wp_sidebar_width_1_active', 4);
$center_ = 12 - $width_;
$center__ = 12 - ($width__ + $width__);
$hide_mobile = get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? 'hidden-xs' : '';

$left = "";
$center = "";
$right = "";

if (is_active_sidebar('right-side-product')) {
	if (is_active_sidebar('left-side-product')) {
		$left = "col-xs-12 col-sm-$width__ col-md-$width__ col-lg-$width__ $hide_mobile";
		$center = "col-xs-12 col-sm-$center__ col-md-$center__ col-lg-$center__";
		$right = "col-xs-12 col-sm-$width__ col-md-$width__ col-lg-$width__ $hide_mobile";
	} else {
		$left = false;
		$center = "col-xs-12 col-sm-$center_ col-md-$center_ col-lg-$center_";
		$right = "col-xs-12 col-sm-$width_ col-md-$width_ col-lg-$width_ $hide_mobile";
	}
} elseif (is_active_sidebar('left-side-product')) {
	$left = "col-xs-12 col-sm-$width_ col-md-$width_ col-lg-$width_ $hide_mobile";
	$center = "col-xs-12 col-sm-$center_ col-md-$center_ col-lg-$center_";
	$right = false;
} else {
	$left = false;
	$center = "col-xs-12 col-sm-12 col-md-12 col-lg-12";
	$right = false;
}

?>

<div class="container content-body">
    <div class="row">
        
        <?php if ($left) { ?>
            <div class="<?php echo $left; ?>">
                <?php mirele_execute_component('sidebar', get_option('mrl_wp_sidebar', 'white'), ( 'left-side-product' )); ?>
            </div>
        <?php } ?>

        <div class="<?php echo $center; ?>">
        <?php
            do_action( 'woocommerce_before_main_content' );

            while ( have_posts() ) {
                the_post();
                wc_get_template_part( 'content', 'single-product' );
            }
            
            do_action( 'woocommerce_after_main_content' );
//            do_action( 'woocommerce_sidebar' );
        ?>
        </div>

        <?php if ($right) { ?>
            <div class="<?php echo $right; ?>">
                <?php mirele_execute_component('sidebar', get_option('mrl_wp_sidebar', 'white'), ( 'right-side-product' )); ?>
            </div>
        <?php } ?>
    
    </div>		
</div>

<?php get_footer(); ?>