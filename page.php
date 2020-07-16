<?php get_header();

$width__ = get_option('mrl_wp_sidebar_width_2_active', 2);
$width_ = get_option('mrl_wp_sidebar_width_1_active', 4);
$center_ = 12 - $width_;
$center__ = 12 - ($width__ + $width__);
$hide_mobile = get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? 'hidden-xs' : '';

$left = "";
$center = "";
$right = "";

if (is_active_sidebar('right-side-page')) {
	if (is_active_sidebar('left-side-page')) {
		$left = "col-xs-12 col-sm-$width__ col-md-$width__ col-lg-$width__ $hide_mobile";
		$center = "col-xs-12 col-sm-$center__ col-md-$center__ col-lg-$center__";
		$right = "col-xs-12 col-sm-$width__ col-md-$width__ col-lg-$width__ $hide_mobile";
	} else {
		$left = false;
		$center = "col-xs-12 col-sm-$center_ col-md-$center_ col-lg-$center_";
		$right = "col-xs-12 col-sm-$width_ col-md-$width_ col-lg-$width_ $hide_mobile";
	}
} elseif (is_active_sidebar('left-side-page')) {
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
            <?php mirele_execute_component('sidebar', get_option('mrl_wp_sidebar', 'white'), ( 'left-side-page' )); ?>
        </div>
        <?php } ?>

        <div class="<?php echo $center; ?>">
            <?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>
                <?php if (get_option('woo_hide_page_title', 'false') != 'true' && !is_woocommerce()): ?>
                    <h1><?php the_title(); ?></h1>
                <?php endif; ?>
            <?php the_content();  ?>
            <?php endwhile; ?>
        </div>

        <?php if ($right) { ?>
        <div class="<?php echo $right; ?>">
            <?php mirele_execute_component('sidebar', get_option('mrl_wp_sidebar', 'white'), ( 'right-side-page' )); ?>
        </div>
        <?php } ?>

    </div>
</div>

<?php get_footer(); ?>