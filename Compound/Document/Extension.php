<?php


namespace Mirele\Compound\Document;


use Mirele\Compound\Repository;
use Mirele\Framework\Customizer;
use Mirele\Utils\Converter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use voku\helper\AntiXSS;


final class Extension extends AbstractExtension
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

    public function Component (string $id, array $props) {
        echo Repository::getComponent($id)->mount($props);
    }

    public function getName() {
        return 'MireleFramework';
    }
}