<?php


namespace Mirele\Compound;


/**
 * Class Duplicator
 * @package Mirele\Compound
 * @deprecated
 */
class Duplicator
{

    /**
     * @var
     */
    private $component;
    /**
     * @var
     */
    private $props;
    /**
     * @var
     */
    private $field;
    /**
     * @var
     */
    private $fieldName;

    /**
     * @param Component $component
     * @return $this
     */
    public function setComponent(Component $component)
    {
        $this->component = $component;
        return $this;
    }

    /**
     * @param Field $field
     * @return $this
     */
    public function setField(Field $field)
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @param string $fieldName
     * @return $this
     */
    public function setFieldName(string $fieldName)
    {
        $this->fieldName = $fieldName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @param array $props
     * @return $this
     */
    public function setProps(array $props)
    {
        $this->props = $props;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * @return mixed
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * @return Component
     */
    public function build() {
        if ($this->component instanceof Component) {
            $this->component->setProps(array_merge(
                (array) $this->getProps(),
                (array) [
                    'attributes' => (array) $this->getProps()
                ]
            ));

            return $this->component->build();
        }
    }

    /**
     * @param $props
     * @return mixed
     */
    public function render ($props) {
        if ($this->component instanceof Component) {
            return $this->component->render((array) $props);
        }
    }


}