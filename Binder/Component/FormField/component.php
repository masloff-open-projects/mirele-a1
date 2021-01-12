<?php

namespace Mirele\Components;
use Mirele\Compound\Component;

use Mirele\Compound\Document\TWIG as App;

new Component([

    'data' => [
        'id'    => 'default_field',
        'alias' => '@field',
        'props' => [

        ],
        'index' => false
    ],

    'template'  => "Binder/Component/FormField/template.html.twig",

    # Once the component is created in the system and registered.
    # Not called when creating a component with an empty constructor
    'construct' => function (Component $self) {

    },

    # Once the component is ready to appear on the page,
    # but not yet created as an HTML entity.
    'created'   => function (Component $self) {

        // TODO: THIS!

        $props = (object)$self->getProps();

        # Filtering parameters
        $defaults = (object)array(
            'type'              => 'text',
            'label'             => '',
            'description'       => '',
            'placeholder'       => '',
            'maxlength'         => false,
            'required'          => false,
            'autocomplete'      => false,
            'id'                => $props->key,
            'class'             => array(),
            'label_class'       => array(),
            'input_class'       => array(),
            'options'           => array(),
            'custom_attributes' => array(),
            'validate'          => array(),
            'default'           => '',
            'autofocus'         => '',
            'priority'          => '',
            'width'             => '',
            'value'             => '',
            'style'             => '',
            'return'            => false,
        );

        $args = (object)apply_filters('woocommerce_form_field_args',
            wp_parse_args(array_merge((array)$props->field, (array)$props->attributes, (array)$props->attr
            ), (array)$defaults
            ), $props->key, $props->value
        );

        # Make changes in the field
        $args->custom_attributes = array_filter((array)$args->custom_attributes, 'strlen');
        $args->label_class = isset($args->label_class) and is_string($args->label_class
        ) ? array($args->label_class) : $args->label_class;
        $args->value = (isset($props->value) and is_null($props->value)) ? $args->default : $props->value;

        # We supplement the field depending on the circumstances
        !is_array($args->class) ? $args->class = [$args->class] : false;
        isset($args->required) and $args->required ? $args->class[] = 'validate-required' : false;
        $args->maxlength ? $args->custom_attributes->maxlength = absint($args->maxlength) : false;
        $args->autocomplete ? $args->custom_attributes->autocomplete = $args->autocomplete : false;
        $args->autofocus ? $args->custom_attributes->autofocus = 'autofocus' : false;
        $args->description ? $args->custom_attributes['aria-describedby'] = $args->id.'-description' : false;

        # Attribute Processing
        if (is_array($args->custom_attributes))
        {
            foreach ($args->custom_attributes as $attribute => $attribute_value)
            {
                $args->custom_attributes_filtred[] = esc_attr($attribute).'="'.esc_attr($attribute_value).'"';
            }
        }

        # Field Validation Processing
        if (!empty($args->validate))
        {
            foreach ($args->validate as $validate)
            {
                $args->class[] = 'validate-'.$validate;
            }
        }


        // Это куда?
        //    $field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );
        //
        //    /**
        //     * General filter on form fields.
        //     *
        //     * @since 3.4.0
        //     */
        //    $field = apply_filters( 'woocommerce_form_field', $field, $key, $args, $value );

        # Create an HTML component
        return App::render('Binder/Component/Abstract/default_field', (object) array(
            'args'    => (array) $args,
            'props'   => (array) $props,
            'country' => $countries = 'shipping_country' ===  $props->key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries(),
            'current_country' => current(array_keys( $countries )),
            'state' => [
                'for_country' => isset($args->country) ? $args->country : WC()->checkout->get_value( 'billing_state' === $props->key ? 'billing_country' : 'shipping_country' ),
                'states' => WC()->countries->get_states(isset($args->country) ? $args->country : WC()->checkout->get_value( 'billing_state' === $props->key ? 'billing_country' : 'shipping_country' ))
            ]
        ), $args->return);

    },

    # Once the component is created and already shown on the user page.
    # Interaction with it in this state is no longer possible.
    'mounted'   => function (Component $self) {

    }

]
);