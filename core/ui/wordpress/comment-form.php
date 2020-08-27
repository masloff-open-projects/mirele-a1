<?php

add_action ('mirele_comment_form', function ($post_id=null) {

    if (!comments_open($post_id)) {

        /**
         * Fires after the comment form if comments are closed.
         */
        do_action( 'comment_form_comments_closed' );

        return;

    }

    do_action('comment_form_before_fields');

    $fields = wp_get_current_commenter();
    foreach ($fields as $key => $value) {
        switch ($key) {
            case 'comment_author':
                $fields[$key] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="comment-author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
                break;
            case 'comment_author_email':
                $fields[$key] = '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="comment-author" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
                break;
            case 'comment_author_url':
                $fields[$key] = '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
                    '<input id="comment-author" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
                break;
        }
    }

    $fields = apply_filters( 'comment_form_default_fields', $fields );

    comment_form(array(
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Your comment', 'noun' ) . '</label><textarea style="width: 100%;" name="comment" aria-required="true"></textarea></p>',
        'class_form' => 'el_2151832060',
        'fields'=> $fields,
        'logged_in_as'=> get_option('woo_comment_show_block_login_as', 'false') == 'true' ? apply_filters('woo_comment_form_login_as', $user_form) : '',
        'title_reply'=> 'You can comment on the product.',
    ));


});