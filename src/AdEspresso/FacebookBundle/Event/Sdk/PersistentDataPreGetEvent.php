<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use Symfony\Component\EventDispatcher\Event;

class PersistentDataPreGetEvent extends Event
{
    /**
     * @var mixed
     */
    private $key;

    /**
     * @param mixed $key
     */
    public function __construct($key)
    {
        $this->key = $key;
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
}
