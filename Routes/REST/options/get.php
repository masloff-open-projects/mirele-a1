<?php

use Mirele\Framework\Customizer;
use Mirele\Router;

Router::get('/rest_endpoint_v1/options/get', function () {
    var_dump(Customizer::all('*'));
});