<?php

namespace Mirele\Components;

use \Mirele\Compound\Component;
use \Mirele\Compound\Config;
use Mirele\Compound\Store;

add_action('wp_loaded', function () {

    new Component([

        'data' => [
            'id' => 'default_widget_factory',
            'alias' => '@widget_factory',
            'props' => [],
            'meta' => [
                'editor' =>
                    (new Config())
                        ->setData('title', 'WidgetFactory')
                        ->setData('description', '')
                        ->setData('alias', '')
            ],
            'parent' => 'WordPress Widget'
        ],

        'template' => "Components/WidgetFactory/template.html.twig",

        # Once the component is created in the system and registered.
        # Not called when creating a component with an empty constructor
        'construct' => function (Component $self) {

            foreach ($GLOBALS['wp_widget_factory']->widgets as $id => $widget) {

                $clone = clone $self;
                $clone->setId("default_widget_factory_$id");
                $clone->setProp('widget', $id);
                $clone->setAlias("@widget_$id");
                $clone->setMeta('editor',
                    (new Config())
                        ->setData('title', "$widget->name")
                        ->setData('description', $widget->widget_options['description'])
                        ->setData('alias', '')
                        ->setData('picture', 'data:image/png;base64,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')
                );

                Store::add($clone);

            }

            unset($clone);

        },

        # Once the component is ready to appear on the page,
        # but not yet created as an HTML entity.
        'created' => function (Component $self) {

            if (!empty($self->getProp('widget'))) {
                the_widget($self->getProp('widget'));
            }

        },

        # Once the component is created and already shown on the user page.
        # Interaction with it in this state is no longer possible.
        'mounted' => function (Component $self) {

        }

    ]);

});