<?php


namespace Mirele\Compound\Patterns;


use \Mirele\Compound\Lexer;


class removeTemplate
{

    private $template = "";
    private $id = "";

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return removeTemplate
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return removeTemplate
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function execute () {

        $tempalte = $this->getTemplate();
        $id = $this->getId();

        $wp_page = (object) get_post($id);

        $Lexer = new Lexer($wp_page->post_content);
        $lex = $Lexer->parse();

        $lex->removeTemplate($tempalte);

        $code = $Lexer->generateCode();

        wp_update_post(array(
            'ID' => (int) $wp_page->ID,
            'post_content' => (string) "[Compound role='editor'] \n $code \n [/Compound]",
        ));

        update_post_meta(
            (int) $wp_page->ID,
            '_wp_page_template',
            COMPOUND_CANVAS
        );

        return true;

    }

}