<?php


namespace Mirele\Compound\Patterns;


use Mirele\Compound\Lexer;


class sort
{

    /**
     * @var int
     */
    private $page = 0;
    /**
     * @var array
     */
    private $prototype = [];

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return sort
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return array
     */
    public function getPrototype()
    {
        return $this->prototype;
    }

    /**
     * @param array $prototype
     * @return sort
     */
    public function setPrototype($prototype)
    {
        $this->prototype = $prototype;
        return $this;
    }


    /**
     *
     */
    public function execute () {

        $page       = (string) $this->getPage();
        $prototype  = (array) $this->getPrototype();

        $wp_page = (object) get_post($page);

        if (isset($wp_page->post_content) and $wp_page->post_content) {

            # Content
            $content = $wp_page->post_content;

            # Lexer
            $lexer = new Lexer($content);

            $lex = $lexer->parse();
            $lex->prototypeIDsBasedSorting($prototype);

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

            return true;

        }

    }

}