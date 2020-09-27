<?php

use \Mirele\Router;
use \Mirele\Framework\Customizer;

Router::get('/rest_endpoint_v1/options/get', function () {
    var_dump(Customizer::all('*'));
});