<?php


namespace Mirele\UnitTest;


use Mirele\Compound\Component;
use Mirele\Compound\Store;


class UnitStore extends MireleUnit
{

    public function testStore()
    {

        $this->__start();

        $this->__while(function () {

            $component = new Component();
            $component->setId($this->__uniqid('component'));

            Store::add(clone $component);

        }, (int)(floor(pow(80, 4))), array());

        $this->__end();

        var_dump([
            'RAM' => $this->__get_end_ram(),
            'TIME' => $this->__get_execute_time(),
            'TEST' => [
                'COUNT' => count(Store::all())
            ]
        ]);


    }


}