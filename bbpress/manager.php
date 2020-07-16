<?php

function bbpress_manager () {
    add_filter( 'bbp_breadcrumb_separator', function () {
        return ' <i class="fas fa-angle-right woo-breadcrumb"></i> ';
    });

    add_filter( 'bbp_get_breadcrumb_pre', function () {
        return ' <i class="fas fa-angle-right woo-breadcrumb"></i> ';
    });
}