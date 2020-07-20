<?php
/**
 *
 * The template for displaying all bbPress pages
 *
 * This is the template that displays all bbPress pages by default.
 * Please note that this is the template of all bbPress pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Theme
 */

get_header();

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

<?php if (is_bbpress()): ?>
    <div class="container content-body">
        <div class="row">

            <?php if ($left) { ?>
                <div class="<?php echo $left; ?>">
                    <?php mirele_execute_component('sidebar', get_option('mrl_wp_sidebar', 'white'), ( 'left-side-page' )); ?>
                </div>
            <?php } ?>

            <div class="<?php echo $center; ?>">
                <?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>
                    <?php if (get_option('woo_hide_page_title', 'false') != 'true' && function_exists('is_woocommerce') and !is_woocommerce()): ?>

                        <h1><?php the_title(); ?></h1>

                    <?php endif; ?>
                    <?php the_content();  ?>
                <?php endwhile; ?>

                <?php if (bbp_is_forum()): ?>

                <div id="bbp-forums-list">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Forum</th>
                            <th>Topics</th>
                            <th>Posts</th>
                            <th>Last post</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach (MBBPress::get_forums() as $forum): ?>

                            <tr>
                                <td>
                                    <a href="<?php esc_html_e($forum->guid); ?>">
                                        <?php esc_html_e($forum->post_title); ?>
                                    </a>

                                    <br>

                                    <small>
                                        <?php esc_html_e($forum->post_content); ?>
                                    </small>
                                </td>
                                <td>
                                    <?php esc_html_e(bbp_get_forum_topic_count($forum->ID)) ?>
                                </td>
                                <td>
                                    <?php esc_html_e(bbp_get_forum_post_count($forum->ID)) ?>
                                </td>
                                <td>
                                    <?php esc_html_e(time_elapsed_string(date('Y-m-d H:i:s', strtotime($forum->post_modified)))) ?>
                                </td>
                            </tr>
                            <?php var_dump($forum); ?>

                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

                <?php endif; ?>

            </div>

            <?php if ($right) { ?>
                <div class="<?php echo $right; ?>">
                    <?php mirele_execute_component('sidebar', get_option('mrl_wp_sidebar', 'white'), ('right-side-page' )); ?>
                </div>
            <?php } ?>

        </div>
    </div>
<?php endif; ?>


<?php get_footer(); ?>