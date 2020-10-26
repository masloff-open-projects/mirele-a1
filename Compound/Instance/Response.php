<?php


namespace Mirele\Compound;


class Response
{

    /**
     * Pattern for reporting an error with code 403
     */
    const PATTERN_403 = [
        'message' => 'Access to this endpoint is not available to you',
        'code' => 403
    ];

    /**
     * Pattern for reporting an error with code 404
     */
    const PATTERN_404 = [
        'message' => 'Page or endpoint not found',
        'code' => 404
    ];

    /**
     * Pattern for reporting an error with code 500
     */
    const PATTERN_500 = [
        'message' => 'An internal server error occurred',
        'code' => 500
    ];

    private $code;
    private $body;

    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct(array $body, int $code)
    {
        $this->body = $body;
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return Response
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param array $body
     * @return Response
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

}