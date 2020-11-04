<?php

namespace Mirele\Components;

use Mirele\Compound\Component;

new Component([

    'data'      => [
        'id'    => 'default_menu_navbar',
        'alias' => '@navbar_menu',
        'props' => [],
        'index' => false
    ],

    # Once the component is created in the system and registered.
    # Not called when creating a component with an empty constructor
    'construct' => function (Component $self) {

    },

    # Once the component is ready to appear on the page,
    # but not yet created as an HTML entity.
    'created'   => function (Component $self) {

        # <li> add class
        add_filter('nav_menu_css_class', function ($atts, $item, $args) {
            if (property_exists($args, 'item_class'))
            {
                $atts[] = $args->item_class;
            }
            return $atts;
        }, 1, 3
        );

        # <a> add class
        add_filter('nav_menu_link_attributes', function ($atts, $item, $args) {
            if (property_exists($args, 'link_class'))
            {
                $atts['class'] = $args->link_class;
            }
            return $atts;
        }, 1, 3
        );

        # add active class in <li>
        add_filter('nav_menu_css_class', function ($classes, $item) {
            if (in_array('current-menu-item', $classes))
            {
                $classes[] = 'active';
            }
            return $classes;
        }, 10, 2
        );

        # Render navbar items
        wp_nav_menu([
            'theme_location'    => 'navbar',
            'menu'              => '',
            'container'         => false,
            'container_class'   => '',
            'container_id'      => '',
            'menu_class'        => 'navbar-nav',
            'menu_id'           => '',
            'echo'              => true,
            'fallback_cb'       => 'wp_page_menu',
            'before'            => '',
            'after'             => '',
            'link_before'       => '',
            'link_after'        => '',
            'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
            'depth'             => 0,
            'walker'            => '',
            'link_class'        => 'nav-link',
            'item_class'        => 'nav-item',
            'item_class_active' => 'active',
        ]
        );

    },

    # Once the component is created and already shown on the user page.
    # Interaction with it in this state is no longer possible.
    'mounted'   => function (Component $self) {

    }

]
);