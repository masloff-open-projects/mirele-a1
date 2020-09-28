<?php


namespace Mirele\Compound\Patterns;

use Mirele\Compound\Component;
use \Mirele\Compound\Lexer;
use \Mirele\Compound\Tag;
use \Mirele\Compound\Grider;
use \Mirele\Compound\Template;
use \Mirele\Compound\Field;


/**
 * Class insertTemplate
 *
 * @package Mirele\Compound\Patterns
 */
class insertTemplate
{

    /**
     * @var string
     */
    private $template = "";
    /**
     * @var int
     */
    private $page = 0;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     *
     * @return insertTemplate
     */
    public function setTemplate($template)
    {
        $this->template = $template;
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
     *
     * @return insertTemplate
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     *
     */
    public function execute () {

        $template = $this->getTemplate();
        $page = $this->getPage();

        $wp_page = (object) get_post($page);

        if (isset($wp_page->post_content) and $wp_page->post_content) {

            # Content
            $content = $wp_page->post_content;
            $id = md5(rand(0, PHP_INT_MAX));

            # Lexer
            $lexer = new Lexer($content);

            # Proccess parsing
            if ($lexer->parse()) {

                # Get template
                $Template = Grider::get($template);

                if ($Template instanceof Template) {

                    $lexer->getSignature()->markupTemplate((string) $id, (string) $template);

                    $fields = $Template->getFields();

                    if ($fields) {

                        foreach ($fields as $field => $object) {

                            if ($object instanceof Field) {

                                $component = $object->getComponent();
                                if ($component instanceof Component) {

                                    $tag = new Tag();
                                    $tag->setTag('component');
                                    $tag->setAttributes($object->getComponentProps());

                                    $tag->setAttribute('name', $component->getAlias() ? $component->getAlias() : $component->getId());

                                    $lexer->getSignature()->setLayoutField((string) $id, $object->getName(), [clone $tag]);

                                }

                            }
                        }
                    }

                }

            }

            if (isset($wp_page->ID) and $wp_page->ID) {

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