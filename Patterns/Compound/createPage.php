<?php


namespace Mirele\Compound\Patterns;

use Mirele\Framework\Prototypes\Pattern;


/**
 * Class createPage
 *
 * @package Mirele\Compound\Patterns
 */
class createPage extends Pattern
{
    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke()
    {
        if (isset($this->name)) {

            $name = $this->name;

            # Create a work sub-environment
            $user = wp_get_current_user();
            $author_id = $user->ID;
            $title = str_replace(COMPOUND_FORBIDDEN_SYMBOLS, '', $name);
            $slug = sanitize_title($title);

            # Request validation
            $post_id = wp_insert_post(array(
                'import_id' => rand(1000000, 9000000),
                'comment_status' => 'closed',
                'ping_status' => 'closed',
                'post_author' => $author_id,
                'post_name' => $slug,
                'post_title' => $title,
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_content' => "[Compound role='editor'] <root></root> [/Compound]",
                'page_template' => COMPOUND_CANVAS
            ));

            if ($post_id && !is_wp_error($post_id)) {
                update_post_meta($post_id, '_wp_page_template', COMPOUND_CANVAS);
            }

            return true;

        }

        return false;
    }


}