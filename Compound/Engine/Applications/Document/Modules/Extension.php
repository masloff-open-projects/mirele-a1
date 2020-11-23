<?php

namespace Mirele\Compound\Engine;

use Mirele\Compound\Component;
use Mirele\Compound\Store;
use Mirele\Compound\Template;
use Mirele\Framework\Customizer;
use Mirele\Utils\Converter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use voku\helper\AntiXSS;

class Extension extends AbstractExtension
{

    public function getFilters()
    {
        return [
            new TwigFilter('xss',         [$this, 'XSS']),
            new TwigFilter('var_dump',    [$this, 'var_dump']),
            new TwigFilter('tr',          [$this, 'Localize']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('Component', [$this, 'Component']),
            new TwigFunction('Field',     [$this, 'Field']),
            new TwigFunction('Tag',       [$this, 'Tag']),
            new TwigFunction('Option',    [$this, 'Option']),
            new TwigFunction('App',       [$this, 'App']),
        ];
    }

    public function var_dump ($data) {
        var_dump($data);
    }

    public function XSS ($data) {

        $XSS = new AntiXSS();
        $return = $XSS->xss_clean($data);
        unset($XSS);

        return $return;

    }

    public function Localize ($data) {
        return __($data, 'mirele');
    }

    public function Tag (string $tag, ... $props) {

        // FIXME
        // Эттот движок создания комопнентов ужасен по своей сущности!
        // Убрать его чертовой матери

        // input_class = это какаято пораша

        $attrs = [];
        $attributes = [];

        # Merge attrs
        foreach ($props as $object) {
            if (is_array($object) or is_object($object)) {
                $attrs = array_merge((array) $attrs, (array) $object);
            }
        }

        foreach ($attrs as $attr => $value) {
            if (!empty($value) and $value != false and is_string($value)) {
                $attributes[$attr] = $value;
            }
        }

        // Вот это параша какя-то
        if (isset($attributes['input_class'])) {

            if (is_array($attributes['input_class']) or is_object($attributes['input_class'])) {
                $attributes['class'] = $attributes['class'] . join(' ', $attributes['input_class']);
            } else {
                $attributes['class'] = $attributes['class'] . (string) $attributes['input_class'];
            }

            unset($attributes['input_class']);

        }

        $inline = (new Converter)->obj2htmlattr((array) $attributes);
        $value = "";

        if (isset($attributes['value'])) {
            $value = $attributes['value'];

            if (isset($attributes['text'])) {
                $value = $attributes['text'];
            }
        }

        $attr_inline = isset($attributes['inline']) ? $attributes['inline'] : '';

        return "<$tag $inline $attr_inline>$value</$tag>";

    }

    public function Component (string $id, array $props) {
        Store::call($id, $props);
    }

    public function Option (string $name, $namespace="*", $props=[]) {

        return (object) [
            'perform' => Customizer::perform($namespace, $name, $props)
        ];

    }

    public function Field (string $name, array $props) {
        if ($props and isset($props['template']) and $props['template'] instanceof Template) {

            $Template = $props['template'];
            if ($Template instanceof Template) {
                $Field = $Template->getField($name);

                if ($Field instanceof Field) {

                    if (isset($props['components'][$name])) {
                        foreach ($props['components'][$name] as $component) {
                            if ($component instanceof Component) {;
                                print ($component->render([
                                    'attributes' => array_merge(
                                        (array) $component->getProps(),
                                        (array) isset($props['attr']) ? $props['attr'] : []
                                    )
                                ]));
                            }
                        }
                    } elseif (isset($props['default'])) {

                        if ($props['default'] instanceof Component) {
                            print $props['default']->render([
                                'attributes' => array_merge(
                                    (array) $props['default']->getProps(),
                                    (array) isset($props['attr']) ? $props['attr'] : []
                                )
                            ]);
                        }

                    }
                }
            }

        }
    }

    public function App () {
        return (object) array(
            'User' => (object) wp_get_current_user(),
            'Blog' => function ($option) {
                return get_bloginfo($option, 'raw');
            },
            'Option' => function ($namespace, $option, $props=[]) {
                return Customizer::get($namespace, $option, $props);
            }
        );
    }

    public function getName() {
        return 'MireleFramework';
    }
}