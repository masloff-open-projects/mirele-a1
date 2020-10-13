<?php


namespace Mirele\WPAJAX;


use Mirele\Compound\Config;
use Mirele\Compound\Field;
use Mirele\Compound\Grider;
use Mirele\Compound\Layout;
use Mirele\Compound\Lexer;
use Mirele\Compound\Response;
use Mirele\Compound\Tag;
use Mirele\Compound\Template;
use Mirele\Framework\Prototypes\Request;


# ...
# Endpoint Version: 1.0.0
# Distributors: AJAX
class WPAJAX_Compound__getMarkup extends Request {

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke($req)
    {

        if (is_user_logged_in() and current_user_can(MIRELE_RIGHTS['page']['edit'])) {

            $props = array(
                'page' => (MIRELE_POST)['page'],
            );

            $wp_page = (object)get_post($props['page']);

            $Markup = array();
            $Lexer = new Lexer($wp_page->post_content);
            $lex = $Lexer->parse();

            if ((object)$lex and $lex instanceof Layout) {
                foreach ($lex->getLayout() as $ID => $Template) {

                    $template = Grider::findById($Template->props->name);

                    if ($template instanceof Template) {

                        $fields = $template->getFields();

                        foreach ($fields as $name => $field) {

                            if ($field instanceof Field) {

                                $meta['editor'] = $field->getMeta('editor');

                                if ($meta['editor'] instanceof Config) {

                                    $Markup[$ID]['fields'][$name]['meta']['editor'] = $meta['editor']->all();

                                }

                                if (isset($Template->fields[$name])) {

                                    foreach ($Template->fields[$name] as $tag) {
                                        if ($tag instanceof Tag) {
                                            $Markup[$ID]['fields'][$name]['tags'][] = (object)[
                                                'tag' => $tag->getTagName(),
                                                'essence' => $tag->getEssence(),
                                                'attributes' => $tag->getAttributes()
                                            ];
                                        }
                                    }

                                }


                                $Markup[$ID]['fields'][$name]['field'] = (object)[
                                    'id' => $field->getId(),
                                    'name' => $field->getName(),
                                    'props' => $field->getProps(),
                                    'page' => $props['page']
                                ];

                            }

                        }


                        # Get props
                        $Markup[$ID]['props'] = $Template->props;

                    }

                }
            }

            return new Response($Markup, 200);

        } else {

            return new Response([
                'message' => 'Access to this endpoint is not available to you'
            ], 403);

        }

    }

}