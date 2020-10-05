<?php


namespace Mirele\Compound\Patterns;

use Mirele\Compound\Component;
use Mirele\Compound\Lexer;
use Mirele\Compound\Store;
use Mirele\Compound\Tag;


class insertComponent
{

    private $page = 0;
    private $template = 0;
    private $component = '';
    private $field = '';

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return insertComponent
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param int $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return int
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return mixed
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * @param mixed $component
     * @return insertComponent
     */
    public function setComponent($component)
    {
        $this->component = $component;
        return $this;
    }

    /**
     *
     */
    public function execute() {

        $id = $this->getPage();
        $component = $this->getComponent();

        # Create a work sub-environment
        $user = wp_get_current_user();

        # Create a work environment
        $component = $this->getComponent();
        $page      = $this->getPage();
        $field     = $this->getField();
        $template  = $this->getTemplate();

        # Pattern
        $wp_page = (object) get_post($page);
        $content = $wp_page->post_content;
        $lexer = new Lexer($content);

        $lexer->parse();
        $root = $lexer->getSignature()->getRootInstanceById((string) $template);

        if ($root !== false) {

            $Component = Store::get($component);

            if ($Component instanceof Component) {

                $tag = new Tag();
                $tag->setTag('component');
                $tag->setAttributes((array) $Component->getProps());
                $tag->setAttribute('name', $Component->getAlias() ? $Component->getAlias() : $Component->getId());

                $root->fields[(string) $field] = (array) [$tag];

                $lexer->getSignature()->setRootInstanceById((string) $template, $root);

                $code = $lexer->generateCode();

                wp_update_post(array(
                    'ID'           => (int) $wp_page->ID,
                    'post_content' => (string) "[Compound role='editor'] \n $code \n [/Compound]",
                ));

                update_post_meta(
                    (int) $wp_page->ID,
                    '_wp_page_template',
                    COMPOUND_CANVAS
                );

            }

        }


    }

}