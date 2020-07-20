<?php get_header();

$width__ = get_option('mrl_wp_sidebar_width_2_active', 2);
$width_ = get_option('mrl_wp_sidebar_width_1_active', 4);
$center_ = 12 - $width_;
$center__ = 12 - ($width__ + $width__);
$hide_mobile = get_option('mrl_wp_sidebar_hide_mobile', 'true') == 'true' ? 'hidden-xs' : '';

$left = "";
$center = "";
$right = "";

if (is_active_sidebar('right-side-single')) {
	if (is_active_sidebar('left-side-single')) {
		$left = "col-xs-12 col-sm-$width__ col-md-$width__ col-lg-$width__ $hide_mobile";
		$center = "col-xs-12 col-sm-$center__ col-md-$center__ col-lg-$center__";
		$right = "col-xs-12 col-sm-$width__ col-md-$width__ col-lg-$width__ $hide_mobile";
	} else {
		$left = false;
		$center = "col-xs-12 col-sm-$center_ col-md-$center_ col-lg-$center_";
		$right = "col-xs-12 col-sm-$width_ col-md-$width_ col-lg-$width_ $hide_mobile";
	}
} elseif (is_active_sidebar('left-side-single')) {
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
            <?php mirele_execute_component('sidebar', get_option('mrl_wp_sidebar', 'white'), ( 'left-side-single' )); ?>
        </div>
        <?php } ?>

        <div class="<?php echo $center; ?>">
            <?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if (get_option('woo_hide_page_title', 'false') != 'true' && function_exists('is_woocommerce') and !is_woocommerce()): ?>
                    <h1 class="post-header"><?php the_title(); ?></h1>
                <?php endif; ?>
                <p><?php the_content();  ?></p>
            </article>

            <?php
				the_post_navigation(
					array(
						'next_text' => '<i class="fas fa-chevron-right"></i> Next post',
						'prev_text' => '<i class="fas fa-chevron-left"></i> Previous post',
					)
				);
				?>

            <hr>

            <?php
			
				if ( comments_open() || get_comments_number() ) :
					$comments = get_comments(array('post_id' => get_the_ID()));
					foreach( $comments as $comment ){
						$user = get_user_by('email', $comment->comment_author_email);
						?>

            <div class="container-fluid">
                <div class="row">

                    <div class="col-xs-3 col-sm-1 col-md-1 col-lg-1 avatar">
                        <img src="<?php echo get_avatar_url($comment->comment_author_email); ?>" alt="">
                    </div>


                    <div class="col-xs-9 col-sm-11 col-md-11 col-lg-11">
                        <h4> <?php if (!empty($user->data->user_nicename)) { echo $user->data->user_nicename; } else { echo $comment->comment_author; }  ?>
                            <?php if ($user->caps['administrator']) { echo '<small>Administrator</small>'; } ?> </h4>

                        <div>
                            <p> <?php echo $comment->comment_content ?> </p>
                        </div>
                    </div>

                </div>
            </div>
            <?php
					}

					comment_form(array(
						'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea style="width: 100%;" name="comment" aria-required="true"></textarea></p>',
						'fields' => [
							'author' =>
								'<p class="comment-form-author"><label for="author">' . __( 'Name', 'domainreference' ) .
								( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
								'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
								'" size="30"' . $aria_req . ' /></p>',

							'email' =>
								'<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) .
								( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
								'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
								'" size="30"' . $aria_req . ' /></p>',
						]
					));
				endif;
				?>

            <?php endwhile; ?>
        </div>

        <?php if ($right) { ?>
        <div class="<?php echo $right; ?>">
            <?php mirele_execute_component('sidebar', get_option('mrl_wp_sidebar', 'white'), ( 'right-side-single' )); ?>
        </div>
        <?php } ?>


    </div>
</div>

<?php get_footer(); ?>