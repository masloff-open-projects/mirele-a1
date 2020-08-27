
<?php function woocommerce_single_product_mirele_comments_render() {?>
	<?php if ( comments_open() || get_comments_number() ) : ?>
		
		<div class='el_2933607387'>
		
			<?php
			$comments = get_comments(array('post_id' => get_the_ID()));
			if (!empty($comments)) :
			?>
			
			<h3>Comments</h3>
			<?php
			foreach( $comments as $comment ){
				$user = get_user_by('email', $comment->comment_author_email);
				?>
					<div class="container-fluid">
						<div class="row">
							
							<div class="col-xs-3 col-sm-1 col-md-1 col-lg-1 avatar">
								<img src="<?php echo get_avatar_url($comment->comment_author_email); ?>" alt="">
							</div>
							
							
							<div class="col-xs-9 col-sm-11 col-md-11 col-lg-11">


								<?php
								$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

								if ( $rating && wc_review_ratings_enabled() ) {
									echo wc_get_rating_html( $rating ); // WPCS: XSS ok.
								}
								?>

								<h4> <?php if (!empty($user->data->user_nicename)) { echo $user->data->user_nicename; } else { echo $comment->comment_author; }  ?> <?php if ($user->caps['administrator']) { echo '<small>Administrator</small>'; } ?>  </h4>

								<div>
									<p> <?php echo $comment->comment_content ?> </p>
								</div>	
							</div>
							
						</div>
					</div>
				<?php
			}

			else:
				if (get_option('woo_enoji_without_comments', 'false') == 'true') {
				do_action( 'action_woo_enoji_without_comments' );
				?>
				<div class="text-center el_809696160">
					<img width="64px" src="<?php echo MIRELE_SOURCE_DIR . '/img/icons/comment.png' ?>" alt="No one rated the product" class="el_698985002">
					<h3 class="el_2755703396">No one rated the product</h3>
					<p>Be the first to comment on this product.</p>
				</div>
				<?php
				}
			endif;

			do_action('comment_form_before_fields');
			$fields = wp_get_current_commenter();
			foreach ($fields as $key => $value) {
				switch ($key) {
					case 'comment_author':
						$fields[$key] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
						break;
					case 'comment_author_email':
						$fields[$key] = '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
						break;
					case 'comment_author_url':
						$fields[$key] = '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
						break;
				}
			}

			$fields['rating'] = '
			<p class="comment-form-rating"><label for="url">' . __( 'Product rating' ) . '</label>
			<div class="rating_block">
				<input name="rating" value="5" id="rating_5" type="radio" />
				<label for="rating_5" class="label_rating"></label>
			
				<input name="rating" value="4" id="rating_4" type="radio" />
				<label for="rating_4" class="label_rating"></label>
			
				<input name="rating" value="3" id="rating_3" type="radio" />
				<label for="rating_3" class="label_rating"></label>
			
				<input name="rating" value="2" id="rating_2" type="radio" />
				<label for="rating_2" class="label_rating"></label>
			
				<input name="rating" value="1" id="rating_1" type="radio" />
				<label for="rating_1" class="label_rating"></label>
			</div>
			</p>';

			do_action('comment_form_after_fields');

			$iam = wp_get_current_user()->data;
			$iam->user_avatar = get_avatar_url($iam->user_email);

			$user_form = "
				<div class='el_1995341016'>
					<div>
						<img class='el_1366123117' src='$iam->user_avatar'>
					</div>

					<div class='el_2352021139'>
						<b>$iam->user_nicename</b>
						<p>$iam->user_email<p>
					</div>
				</div>
			";

			comment_form(array(
				'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea style="width: 100%;" name="comment" aria-required="true"></textarea></p>',
				'class_form' => 'el_2151832060',
				'fields'=> $fields,
				'logged_in_as'=> get_option('woo_comment_show_block_login_as', 'false') == 'true' ? apply_filters('woo_comment_form_login_as', $user_form) : '',
				'title_reply'=> 'You can comment on the product.',
			));
			
			?>

		</div>


	<?php endif; ?>
<?php } ?>