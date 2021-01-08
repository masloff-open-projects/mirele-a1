<?php

namespace Mirele\Templates;

use Mirele\Compound\Config;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Repository;
use Mirele\Compound\Market;
use Mirele\Compound\Template;

$Template = new Template([

    'data' => [

        'id' => 'default_header',
        'props' => [

        ]

    ],

    'template' => 'Binder/Template/Headers/template.html.twig',


    # Once the template is created in the system and registered.
    # Not called when creating a template with an empty constructor
    'construct' => function (Template $self) {

    },

    # Once the template is ready to appear on the page,
    # but not yet created as an HTML entity.
    'created'   => function (Template  $self) {

    },

    # Once the template is created and already shown on the user page.
    # Interaction with it in this state is no longer possible.
    'mounted'   => function (Template  $self) {

    },

    'editor' => [
        'title' => 'Header',
        'description' => 'About header'
    ]

]);