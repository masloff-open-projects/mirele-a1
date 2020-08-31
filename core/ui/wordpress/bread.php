<?php

add_action('Main-breadcrumbs', function ($e=null) {

    foreach ($e as $part) {
        $part ?> <i class="fas fa-angle-right woo-breadcrumb"></i> <?php
    }

});