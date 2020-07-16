<?php

add_action ('mirele_comments', function ($post_id=null) {

    $comments = get_comments(
        array('post_id' => $post_id)
    );

    if (!empty($comments)) :
    ?>

        <h3>Comments</h3>

        <div class="container-fluid">

            <?php foreach( $comments as $comment ): ?>

                <?php

                    /**
                     * Header
                     */

                    $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

                    if ( $rating && wc_review_ratings_enabled() ) {
                        echo wc_get_rating_html( $rating ); // WPCS: XSS ok.
                    }

                ?>

            <div class="row" data-commentid="<?php echo $comment->comment_ID; ?>">

                <div class="col-xs-3 col-sm-1 col-md-1 col-lg-1 avatar">
                    <img src="<?php echo get_avatar_url($comment->comment_author_email); ?>" alt="<?php echo $comment->comment_author_email; ?>">
                </div>

                <div class="col-xs-9 col-sm-11 col-md-11 col-lg-11">

                    <h4> <?php echo $comment->comment_author;?> </h4>

                    <div>
                        <p> <?php echo $comment->comment_content ?> </p>
                    </div>

                    <a href="<?php echo get_edit_comment_link($comment->comment_ID)?>">...</a>

                </div>
            </div>

            <?php endforeach; ?>

        </div>

    <?php
    endif;

});