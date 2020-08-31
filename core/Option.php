<?php

\Mirele\Framework\Customizer::add( (new \Mirele\Framework\Option)
    ->setType("integer")
    ->setDefault(true)
    ->setName("564545")
    ->setProps([
        'step' => 5,
        'min' => 10,
        'max' => 123
    ])
    ->setWarning([
        'type' => 'warning',
        'title' => 'Hello',
        'description' => ''
    ])
    ->setNamespace('main') );
