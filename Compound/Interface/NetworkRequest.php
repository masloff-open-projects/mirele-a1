<?php


namespace Mirele\Framework;


interface NetworkRequest
{
    public function __invoke(array $request);
}