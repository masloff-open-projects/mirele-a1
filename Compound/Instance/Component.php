<?php


namespace Mirele\Compound;


use Mirele\Compound\Document\TWIG as App;
use Mirele\Framework\ClassExtends\Storage;


class Component extends Storage
{

    private $html;
    protected $index = true;
    protected $id = null;
    protected $template = null;
    protected $name = null;
    protected $props = [];
    protected $meta = [];
    protected $alias = null;
    protected $parent = null;
    protected $editor = null;

    protected $construct;
    protected $created;
    protected $mounted;
    protected $middleware;

    private function __call_construct ()
    {
        if (is_callable($this->construct)) {
            return call_user_func($this->construct, $this);
        } else {
            return false;
        }
    }

    private function __call_created ()
    {
        if (is_callable($this->created)) {
            return call_user_func($this->created, $this);
        } else {
            return false;
        }
    }

    private function __call_mounted ()
    {
        if (is_callable($this->mounted)) {
            return call_user_func($this->mounted, $this);
        } else {
            return false;
        }
    }

    public function __construct($object = false)
    {
        if (is_array($object) or is_object($object)) {

            $object = (object) $object;

            if (isset($object->data)) {

                foreach ($object->data as $name => $value) {
                    $this->{$name} = $value;
                }

            }

            if (isset($object->construct)) {
                $this->construct = $object->construct;
            }

            if (isset($object->created)) {
                $this->created = $object->created;
            }

            if (isset($object->mounted)) {
                $this->mounted = $object->mounted;
            }

            if (isset($object->template)) {
                $this->template = $object->template;
            }

            if (isset($object->editor)) {
                $this->editor = $object->editor;
            }

            if (isset($this->editor)) {
                Market::registerComponent($this->id, $this->editor);
            }

            Repository::registerComponent($this->id, $this);

            $this->__call_construct();

        }
    }

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(array $props)
    {
        return $this->render($props);
    }

    /**
     * This method is called by var_dump() when dumping an object to get the properties that should be shown.
     * If the method isn't defined on an object, then all public, protected and private properties will be shown.
     * @return array
     * @since 5.6
     *
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.debuginfo
     */
    public function __debugInfo()
    {
        return array(
            'alias' => $this->alias,
            'id' => $this->id,
            'props' => $this->getData()
        );
    }

    public function build($attr)
    {
        if (empty($this->html)) {

            if ($this->getTemplate()) {

                $this->html = App::renderToString($this->getTemplate(), $attr);
                $this->__call_created();

                return $this->html;

            }

        } else {

            return $this->html;

        }

    }

    public function mount ($attr)
    {
        $this->__call_mounted();
        echo $this->build($attr);
    }

    /**
     * @return mixed
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @return bool
     */
    public function isIndex(): bool
    {
        return $this->index;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getProps(): array
    {
        return $this->props;
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @return null
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return null
     */
    public function getEditor()
    {
        return $this->editor;
    }

    /**
     * @return mixed
     */
    public function getConstruct()
    {
        return $this->construct;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getMounted()
    {
        return $this->mounted;
    }

    /**
     * @return mixed
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }




}