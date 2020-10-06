<?php


namespace Mirele\UnitTest;


class MireleUnit
{
    private $start_time = 0.0;
    private $start_ram = 0.0;
    private $end_time = 0.0;
    private $end_ram = 0.0;
    private $iterator_position = 0;
    private $while_position = 0;
    private $capability_while = true;

    protected function __start()
    {
        $this->start_ram = memory_get_usage();
        return $this->start_time = (float)microtime(true);
    }

    protected function __end()
    {
        $this->end_ram = $this->start_ram - memory_get_usage();
        return $this->end_time = (float)microtime(true) - (float)$this->start_time;
    }

    protected function __get_execute_time()
    {
        return (float)$this->end_time;
    }

    protected function __while(callable $function, int $count, $params)
    {

        while ((int)$this->while_position < $count) {
            if ($this->capability_while == true) {
                $this->while_position++;
                call_user_func($function, $params);
            } else {
                break;
                return false;
            }
        }

    }

    protected function __while_stop_iteration()
    {
        return $this->capability_while = false;
    }

    protected function __continue_iteration()
    {
        return $this->capability_while = true;
    }

    protected function __uniqid(string $prefix)
    {
        return uniqid($prefix, true);
    }

    protected function __get_start_ram()
    {
        return $this->start_ram;
    }

    protected function __get_end_ram()
    {
        return $this->end_ram;
    }


}