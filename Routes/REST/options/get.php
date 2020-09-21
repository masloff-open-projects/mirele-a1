<?php

use \Mirele\Router;

Router::get('/rest_endpoint_v1/options/get', function () {
    var_dump(\Mirele\Framework\Customizer::all('*'));
});