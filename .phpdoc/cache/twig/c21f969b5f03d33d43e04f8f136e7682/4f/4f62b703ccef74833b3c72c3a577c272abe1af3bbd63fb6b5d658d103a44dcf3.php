<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /trait.html.twig */
class __TwigTemplate_1f5cb9f94f24c097821ec43d1ec84dcc1baf893355ad59cbfa8ff31c9d0e1611 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.html.twig", "/trait.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "    ";
        $this->loadTemplate("breadcrumbs.html.twig", "/trait.html.twig", 4)->display($context);
        // line 5
        echo "
    <h2 class=\"phpdocumentor-content__title\">
        ";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "name", [], "any", false, false, false, 7), "html", null, true);
        echo "
        ";
        // line 8
        if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "usedTraits", [], "any", false, false, false, 8))) {
            // line 9
            echo "            <span class=\"phpdocumentor-trait__extends\">
                Uses
                ";
            // line 11
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "usedTraits", [], "any", false, false, false, 11));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["trait"]) {
                // line 12
                echo "                    ";
                echo call_user_func_array($this->env->getFilter('route')->getCallable(), [$context["trait"], "trait:short"]);
                if ( !twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 12)) {
                    echo ", ";
                }
                // line 13
                echo "                ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trait'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 14
            echo "            </span>
        ";
        }
        // line 16
        echo "    </h2>
    <aside class=\"phpdocumentor-element-found-in\">
        <abbr class=\"phpdocumentor-element-found-in__file\" title=\"";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "file", [], "any", false, false, false, 18), "path", [], "any", false, false, false, 18), "html", null, true);
        echo "\">";
        echo call_user_func_array($this->env->getFilter('route')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "file", [], "any", false, false, false, 18), "file:short"]);
        echo "</abbr>
        :
        <span class=\"phpdocumentor-element-found-in__line\">";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "line", [], "any", false, false, false, 20), "html", null, true);
        echo "</span>
    </aside>

    <p class=\"phpdocumentor-trait__summary\">";
        // line 23
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "summary", [], "any", false, false, false, 23), "html", null, true);
        echo "</p>
    <section class=\"phpdocumentor-trait__description\">";
        // line 24
        echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "description", [], "any", false, false, false, 24)]);
        echo "</section>

    <h3>Table of Contents</h3>
    <table class=\"phpdocumentor-table_of_contents\">
        ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "properties", [], "any", false, false, false, 28));
        foreach ($context['_seq'] as $context["_key"] => $context["property"]) {
            // line 29
            echo "            <tr>
                <th class=\"phpdocumentor-heading\"><a href=\"";
            // line 30
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('link')->getCallable(), [$context["property"]]), "html", null, true);
            echo "\">\$";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["property"], "name", [], "any", false, false, false, 30), "html", null, true);
            echo "</a></th>
                <td class=\"phpdocumentor-cell\">";
            // line 31
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["property"], "summary", [], "any", false, false, false, 31), "html", null, true);
            echo "</td>
                <td class=\"phpdocumentor-cell\">";
            // line 32
            echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["property"], "type", [], "any", false, false, false, 32), "trait:short"]), "|");
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['property'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "magicProperties", [], "any", false, false, false, 35));
        foreach ($context['_seq'] as $context["_key"] => $context["property"]) {
            // line 36
            echo "            <tr>
                <th class=\"phpdocumentor-heading\"><a href=\"";
            // line 37
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('link')->getCallable(), [$context["property"]]), "html", null, true);
            echo "\">\$";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["property"], "name", [], "any", false, false, false, 37), "html", null, true);
            echo "</a></th>
                <td class=\"phpdocumentor-cell\">";
            // line 38
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["property"], "summary", [], "any", false, false, false, 38), "html", null, true);
            echo "</td>
                <td class=\"phpdocumentor-cell\">";
            // line 39
            echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["property"], "type", [], "any", false, false, false, 39), "trait:short"]), "|");
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['property'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "inheritedProperties", [], "any", false, false, false, 42));
        foreach ($context['_seq'] as $context["_key"] => $context["property"]) {
            // line 43
            echo "            <tr>
                <th class=\"phpdocumentor-heading\"><a href=\"";
            // line 44
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('link')->getCallable(), [$context["property"]]), "html", null, true);
            echo "\">\$";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["property"], "name", [], "any", false, false, false, 44), "html", null, true);
            echo "</a></th>
                <td class=\"phpdocumentor-cell\">";
            // line 45
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["property"], "summary", [], "any", false, false, false, 45), "html", null, true);
            echo "</td>
                <td class=\"phpdocumentor-cell\">";
            // line 46
            echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["property"], "type", [], "any", false, false, false, 46), "trait:short"]), "|");
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['property'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "methods", [], "any", false, false, false, 49));
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 50
            echo "            <tr>
                <th class=\"phpdocumentor-heading\"><a href=\"";
            // line 51
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('link')->getCallable(), [$context["method"]]), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["method"], "name", [], "any", false, false, false, 51), "html", null, true);
            echo "()</a></th>
                <td class=\"phpdocumentor-cell\">";
            // line 52
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["method"], "summary", [], "any", false, false, false, 52), "html", null, true);
            echo "</td>
                <td class=\"phpdocumentor-cell\">";
            // line 53
            echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), [twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["method"], "response", [], "any", false, false, false, 53), "type", [], "any", false, false, false, 53), "trait:short"]), "|");
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "magicMethods", [], "any", false, false, false, 56));
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 57
            echo "            <tr>
                <th class=\"phpdocumentor-heading\"><a href=\"";
            // line 58
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('link')->getCallable(), [$context["method"]]), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["method"], "name", [], "any", false, false, false, 58), "html", null, true);
            echo "()</a></th>
                <td class=\"phpdocumentor-cell\">";
            // line 59
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["method"], "summary", [], "any", false, false, false, 59), "html", null, true);
            echo "</td>
                <td class=\"phpdocumentor-cell\">";
            // line 60
            echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), [twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["method"], "response", [], "any", false, false, false, 60), "type", [], "any", false, false, false, 60), "trait:short"]), "|");
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "inheritedMethods", [], "any", false, false, false, 63));
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 64
            echo "            <tr>
                <th class=\"phpdocumentor-heading\"><a href=\"";
            // line 65
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('link')->getCallable(), [$context["method"]]), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["method"], "name", [], "any", false, false, false, 65), "html", null, true);
            echo "()</a></th>
                <td class=\"phpdocumentor-cell\">";
            // line 66
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["method"], "summary", [], "any", false, false, false, 66), "html", null, true);
            echo "</td>
                <td class=\"phpdocumentor-cell\">";
            // line 67
            echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), [twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["method"], "response", [], "any", false, false, false, 67), "type", [], "any", false, false, false, 67), "trait:short"]), "|");
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "    </table>

    ";
        // line 72
        if ((((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "properties", [], "any", false, false, false, 72)) > 0) || (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "magicProperties", [], "any", false, false, false, 72)) > 0)) || (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "inheritedProperties", [], "any", false, false, false, 72)) > 0))) {
            // line 73
            echo "        <section>
            <h3 class=\"phpdocumentor-properties__header\">Properties</h3>
            ";
            // line 75
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "properties", [], "any", false, false, false, 75));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["property"]) {
                // line 76
                echo "                ";
                $this->loadTemplate("property.html.twig", "/trait.html.twig", 76)->display($context);
                // line 77
                echo "            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['property'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 78
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "magicProperties", [], "any", false, false, false, 78));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["property"]) {
                // line 79
                echo "                ";
                $this->loadTemplate("property.html.twig", "/trait.html.twig", 79)->display($context);
                // line 80
                echo "            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['property'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 81
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "inheritedProperties", [], "any", false, false, false, 81));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["property"]) {
                // line 82
                echo "                ";
                $this->loadTemplate("property.html.twig", "/trait.html.twig", 82)->display($context);
                // line 83
                echo "            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['property'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 84
            echo "        </section>
    ";
        }
        // line 86
        echo "
    ";
        // line 87
        if ((((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "methods", [], "any", false, false, false, 87)) > 0) || (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "magicMethods", [], "any", false, false, false, 87)) > 0)) || (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "inheritedMethods", [], "any", false, false, false, 87)) > 0))) {
            // line 88
            echo "        <section>
            <h3 class=\"phpdocumentor-methods__header\">Methods</h3>
            ";
            // line 90
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "methods", [], "any", false, false, false, 90));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
                // line 91
                echo "                ";
                $this->loadTemplate("method.html.twig", "/trait.html.twig", 91)->display($context);
                // line 92
                echo "            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 93
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "magicMethods", [], "any", false, false, false, 93));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
                // line 94
                echo "                ";
                $this->loadTemplate("method.html.twig", "/trait.html.twig", 94)->display($context);
                // line 95
                echo "            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 96
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "inheritedMethods", [], "any", false, false, false, 96));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
                // line 97
                echo "                ";
                $this->loadTemplate("method.html.twig", "/trait.html.twig", 97)->display($context);
                // line 98
                echo "            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 99
            echo "        </section>
    ";
        }
    }

    public function getTemplateName()
    {
        return "/trait.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  528 => 99,  514 => 98,  511 => 97,  493 => 96,  479 => 95,  476 => 94,  458 => 93,  444 => 92,  441 => 91,  424 => 90,  420 => 88,  418 => 87,  415 => 86,  411 => 84,  397 => 83,  394 => 82,  376 => 81,  362 => 80,  359 => 79,  341 => 78,  327 => 77,  324 => 76,  307 => 75,  303 => 73,  301 => 72,  297 => 70,  288 => 67,  284 => 66,  278 => 65,  275 => 64,  270 => 63,  261 => 60,  257 => 59,  251 => 58,  248 => 57,  243 => 56,  234 => 53,  230 => 52,  224 => 51,  221 => 50,  216 => 49,  207 => 46,  203 => 45,  197 => 44,  194 => 43,  189 => 42,  180 => 39,  176 => 38,  170 => 37,  167 => 36,  162 => 35,  153 => 32,  149 => 31,  143 => 30,  140 => 29,  136 => 28,  129 => 24,  125 => 23,  119 => 20,  112 => 18,  108 => 16,  104 => 14,  90 => 13,  84 => 12,  67 => 11,  63 => 9,  61 => 8,  57 => 7,  53 => 5,  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/trait.html.twig", "/trait.html.twig");
    }
}
