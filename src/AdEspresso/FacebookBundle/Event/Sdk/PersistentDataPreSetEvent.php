<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use Symfony\Component\EventDispatcher\Event;

class PersistentDataPreSetEvent extends Event
{
    /**
     * @var mixed
     */
    private $key;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * Gets the value of key.
     *
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets the value of key.
     *
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Gets the value of value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value of value.
     *
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
