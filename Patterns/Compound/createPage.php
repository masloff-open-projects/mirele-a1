<?php


namespace Mirele\Compound\Patterns;

use \Mirele\Compound\Lexer;
use \Mirele\Compound\Tag;
use \Mirele\Compound\Grider;
use \Mirele\Compound\Template;
use \Mirele\Compound\Field;


/**
 * Class createPage
 *
 * @package Mirele\Compound\Patterns
 */
class createPage
{

    /**
     * @var string
     */
    private $name = "";
    /**
     * @var string
     */
    private $title = "";
    /**
     * @var string
     */
    private $template = "";

    /**
     * createPage constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return createPage
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return createPage
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

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
     * @return createPage
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     *
     */
    public function execute() {

        $name = $this->getName();
        $template = $this->getTemplate();
        $title = $this->getTitle();

        # Create a work sub-environment
        $user = wp_get_current_user();
        $author_id = $user->ID;
        $title = $title ? $title : str_replace(COMPOUND_FORBIDDEN_SYMBOLS, '', $name);
        $slug = sanitize_title($title);

        # Lexer object for generating $lex code
        $lexer = new Lexer("");

        # Get template
        $Template = Grider::get($template);

        if ($Template instanceof Template) {

            $fields = $Template->getFields();

            if ($fields) {

                foreach ($fields as $field => $object) {

                    if ($object instanceof Field) {
                        $lexer->getSignature()->addTemplateField($template, $object->getName(), [
                            (
                            (new Tag())
                                ->setTag('component')
                            )
                        ]);
                    }
                }
            }

            # We generate the code and create the page
            $code = $lexer->generateCode();

            # Request validation
            $uploader_page = array(
                'comment_status'        => 'closed',
                'ping_status'           => 'closed',
                'post_author'           => $author_id,
                'post_name'             => $slug,
                'post_title'            => $title,
                'post_status'           => 'publish',
                'post_type'             => 'page',
                'post_content'          => "[Compound role='editor'] \n $code \n [/Compound]",
                'page_template'     => COMPOUND_CANVAS
            );

            $post_id = wp_insert_post( $uploader_page );

            if ( $post_id && !is_wp_error($post_id) ){
                update_post_meta( $post_id, '_wp_page_template', COMPOUND_CANVAS );
            }


        }

    }

}