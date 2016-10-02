<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use Symfony\Component\EventDispatcher\Event;

class PseudoRandomStringPreGetEvent extends Event
{
    /**
     * @var int
     */
    private $length;

    /**
     * @param int $length
     */
    public function __construct($length)
    {
        $this->length = $length;
    }

    /**
     * Gets the value of length.
     *
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Sets the value of length.
     *
     * @param int $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }
}
