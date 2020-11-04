<?php


namespace Mirele\Framework;


use Mirele\Compound\Response;

/**
 * A class is usually inherited to other classes from the package Mirele\Network.
 * In the case of inheritance, the parent class may have the '__invoke' method - this is called when processing a request.
 *
 * Class Request
 * @package Mirele\Framework
 */
class Request implements IRequest
{

    private $strategy = null;

    /**
     * Create and transmit as a parameter 'strategy' the strategy object.
     * If successful, execute the function passed with the 'next' method,
     * if unsuccessful, execute the function passed with the 'reject' method
     *
     * @param Strategy $strategy Created strategy object
     * @return Strategy
     */
    protected function useAuthorizationStrategy (Strategy $strategy)
    {
        if (method_exists($strategy, '__invoke'))
        {
            return clone $strategy;
        } else {
            // TODO
//            throw new \Exception("The strategy does not have a mandatory __invoke method and cannot be implemented.");
        }
    }

    /**
     * The __invoke method is used to compile (if necessary) and process a request with the transferred parameters.
     * The query object also supports working with the 'handler' method, but its use is not recommended.
     *
     * PHPDOC: The __invoke method is called when a script tries to call an object as a function.
     *
     * @return object|array|Response|boolean|string
     * @param $request array $_REQUEST
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(array $request)
    {
        // TODO: Implement __invoke() method.
    }


}