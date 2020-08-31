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

/* editor/pages.twig */
class __TwigTemplate_e2049c67e00d3be543e9eac004b328352a3c2f0cac09e60cc31ca1f5f76648e8 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<table class=\"wp-list-table widefat fixed striped posts\">
    <thead>
    <tr>
        <th>Page ID</th>
        <th>Name</th>
        <th>Blocks count</th>
        <th>Used as</th>
        <th>Shortcode</th>
    </tr>
    </thead>
    <tbody>

    {foreach \$rm->markup() as \$page => \$body}
    {/foreach}

    <?php foreach (\$rm->markup() as \$page => \$body): ?>
    <tr>
        <th>
            <b> <?php echo ucfirst(\$page); ?> </b>
            <p class=\"row-actions\">

                                        <span class=\"view\">
                                            <a href=\"<?php echo admin_url(sprintf('admin.php?page=rosemary_render_editor&page_id=%s', \$body['page']['id'])) ?>\">Edit page</a>
                                        </span>

                <span class=\"view\">
                                            | <a href=\"javascript:;\" data-action=\"create_wordpress_page\" page=\"<?php echo \$body['page']['id']; ?>\">Create WordPress Page</a>
                                        </span>

                <span class=\"trash\">
                                            | <a href=\"javascript:;\" data-action=\"remove_page\" page=\"<?php echo \$body['page']['id']; ?>\">Remove page</a>
                                        </span>

            </p>
        </th>
        <th> <?php echo \$body['page']['id']; ?> </th>
        <th> <?php echo count(\$body) - 1; ?> </th>
        <th> <?php foreach (\$pages as \$key => \$value): ?>
            <?php if ((strpos(\$value->post_content, \"[Compound page=\\\"\" . \$body['page']['id'] . \"\\\"]\") !== false) || (strpos(\$value->post_content, \"[Compound page='\" . \$body['page']['id'] . \"']\") !== false)): ?>
            <span>
                                            <?php echo \$value->post_title; ?>
                <?php if (get_option('page_on_front') == \$value->ID): ?>
                                                    (<b>Home page</b>)
                <?php endif;?>
                                        </span>
            <?php endif; ?>
            <?php endforeach; ?> </th>
        <th> <?php echo sprintf('<code> [Compound page=\"%s\"] </code>', \$body['page']['id']); ?> </th>
    </tr>
    <?php endforeach; ?>

    </tbody>
</table>";
    }

    public function getTemplateName()
    {
        return "editor/pages.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "editor/pages.twig", "/var/www/html/wp-content/themes/Main-a1/templates/editor/pages.twig");
    }
}
