<?php

class MBBPress {

    static public function get_forums () {
        return get_pages(
            array(
                'post_type' => bbp_get_forum_post_type(),
                'numberposts' => 99,
                'post_status' => array(
                    'publish',
                    'private'
                )
            )
        );
    }

}