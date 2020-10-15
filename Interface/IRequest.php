<?php


namespace Mirele\Framework;

use Mirele\Compound\Response;

/**
 * A universal interface to standardise requests and simplify their spelling
 *
 * Interface IRequest
 * @package Mirele\Framework
 */
interface IRequest
{
    /**
     * @param $request array $_REQUEST
     * @return object|array|Response|boolean|string
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(array $request);
}