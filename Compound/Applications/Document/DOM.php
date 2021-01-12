<?php


namespace Mirele\Compound;




class DOM {



    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     * @link https://php.net/manual/en/language.oop5.decon.php
     */
    public function __construct(Template $Template, $TemplateProps, $Areas)
    {

        $dom = new DOMParser();

        $dom->setOptions(
            (new \PHPHtmlParser\Options())
                ->setStrict(false)
                ->setRemoveScripts(false)
                ->setRemoveStyles(false)
                ->setRemoveSmartyScripts(false)
                ->setPreserveLineBreaks(true)
        );

        $dom->loadStr($Template->build($TemplateProps)->HTML);

        $this->dom = $dom;

        foreach ($dom->find('c-area')->getIterator() as $area) {

            if ($area instanceof \PHPHtmlParser\Dom\Node\HtmlNode) {

                $section = $area->getParent();
                $links = [];
                $areaLink = $area->getAttribute('id');

                $this->areas[$area->getAttribute('id')] = $area;

                $this->editor[$areaLink] = $area->getAttributes();

                if (isset($Areas[$areaLink])) {
                    $links[$areaLink][] = true;

                    foreach ($area->getChildren() as $child) {
                        if ($child instanceof \PHPHtmlParser\Dom\Node\HtmlNode) {

                            $tagLinkWithComponent = $child->getTag()->name();
                            $tagAttributes = array_merge(
                                [
                                    'id' => '',
                                    'value' => $child->innerText()
                                ],
                                $child->getAttributes()
                            );

                            if ($child->getAttribute('id')) {
                                if (isset($this->ids[$child->getAttribute('id')])) {
                                    throw new \Exception("No two elements with the same ID can exist. ID: " . $child->getAttribute('id'));
                                } else {
                                    $this->ids[$child->getAttribute('id')] = true;
                                }
                            } else {
                                throw new \Exception("Elements without ID attribute cannot be registered in the system as anonymous. Please pass the id. Elements: " . $child->getTag()->name());
                            }

                            if (isset($Areas[$areaLink][$tagAttributes['id']])) {
                                if ($Areas[$areaLink][$tagAttributes['id']]['component'] === $tagLinkWithComponent) {

                                    $Component = Repository::getComponent($tagLinkWithComponent);

                                    if ($Component instanceof Component) {

                                        $Component = clone $Component;

                                        $HTML = $Component->render((array) array_merge(
                                            $tagAttributes,
                                            isset($Areas[$areaLink][$tagAttributes['id']]) ? $Areas[$areaLink][$tagAttributes['id']]['attributes'] : []
                                        ));

                                        $links[$areaLink][$tagAttributes['id']] = true;

                                        if ($HTML) {

                                            $children = (new DOMParser())->loadStr($HTML)->firstChild();

                                            if ($children->getTag()->name() == 'c-component') {

                                                $section->addChild($children);

                                            } else {
                                                throw new \Exception("Component `$tagLinkWithComponent` must be wrapped in a <c-component> tag");
                                            }

                                        } else {
                                            throw new \Exception("Component `$tagLinkWithComponent` is empty or non-existent");
                                        }

                                    }

                                }
                            }

                        }
                    }

                } else {

                    if (!$area->hasAttribute('permanent')) {
//                        $area->delete();
                    }

                }

                if (!$area->hasAttribute('strict')) {
                    if (isset($Areas[$areaLink])) {
                        foreach ($Areas[$areaLink] as $nonlink_component) {
                            if (isset($nonlink_component['attributes']['id'])) {
                                if (!$links[$areaLink][$nonlink_component['attributes']['id']]) {

                                    $Component = Repository::getComponent($nonlink_component['component']);

                                    if ($Component instanceof Component) {

                                        $Component = clone $Component;

                                        $HTML = $Component->render((array) $nonlink_component['attributes']);

                                        $links[$areaLink][$nonlink_component['attributes']['id']] = true;

                                        if ($HTML) {

                                            $children = (new DOMParser())->loadStr($HTML)->firstChild();

                                            if ($children->getTag()->name() == 'c-component') {
                                                $section->addChild($children);
                                            } else {
                                                throw new \Exception("Component `${$nonlink_component['component']}` must be wrapped in a c-component tag");
                                            }

                                        } else {
                                            throw new \Exception("Component `${$nonlink_component['component']}` is empty or non-existent");
                                        }

                                    }


                                }
                            }
                        }
                    }
                }

                $area->delete();

            }
        }

        $rtags = [
            '<c-component>',
            '</c-component>'
        ];

        $dom = str_replace($rtags, '', $dom);

        $this->document = $dom;

    }

    /**
     * @return DOMParser|string|string[]
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @return array
     */
    public function getAreas()
    {
        $areas = [];
        foreach ($this->areas as $name => $area) {
            if ($area instanceof \PHPHtmlParser\Dom\Node\HtmlNode) {
                $areas[$name] = [];

                foreach ($area->getChildren() as $child) {
                    if ($child instanceof \PHPHtmlParser\Dom\Node\HtmlNode) {
                        $areas[$name][] = [
                            'component' => $child->getTag()->name(),
                            'attrs' => $child->getAttributes(),
                            'value' => $child->innerText()
                        ];
                    }
                }
            }
        }
        return $areas;
    }

    /**
     * @return array
     */
    public function getEditor()
    {
        return $this->editor;
    }


}