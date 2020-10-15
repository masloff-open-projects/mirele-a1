<?php


namespace Mirele\Framework;


use Mirele\Framework\Traits\__getter;
use Mirele\Framework\Traits\__isset;
use Mirele\Framework\Traits\__setter;
use Mirele\Framework\Traits\__unset;

class Strategy
{

    private $next;
    private $reject;

    use __isset;
    use __unset;
    use __setter;
    use __getter;

    public function next (callable $next) {
        $this->next = $next;
        return $this;
    }

    public function reject (callable $reject) {
        $this->reject = $reject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        if (method_exists($this, 'handler')) {
            $a = $this->handler($this->data);
            if ($a === true and is_callable($this->next)) {
                return call_user_func($this->next, $a);
            } elseif ($a === false and is_callable($this->reject)) {
                return call_user_func($this->reject, $a);
            } elseif (is_callable($this->reject)) {
                return call_user_func($this->reject, $a);
            } else {
                return $a;
            }
        } else {
            // TODO
//            throw new \Exception("The strategy has no mandatory 'handler' method and cannot be implemented ");
        }
    }


}