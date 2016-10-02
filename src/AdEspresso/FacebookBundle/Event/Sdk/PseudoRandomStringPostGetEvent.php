<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use Symfony\Component\EventDispatcher\Event;

class PseudoRandomStringPostGetEvent extends Event
{
    /**
     * @var int
     */
    private $length;

    /**
     * @var mixed
     */
    private $pseudoRandomString;

    /**
     * @param int    $length
     * @param string $pseudoRandomString
     */
    public function __construct($length, $pseudoRandomString)
    {
        $this->length = $length;
        $this->pseudoRandomString = $pseudoRandomString;
    }

    /**
     * Gets the pseudoRandomString of length.
     *
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Gets the value of pseudoRandomString.
     *
     * @return string
     */
    public function getPseudoRandomString()
    {
        return $this->pseudoRandomString;
    }

    /**
     * Sets the value of pseudoRandomString.
     *
     * @param string $pseudoRandomString
     */
    public function setPseudoRandomString($pseudoRandomString)
    {
        $this->pseudoRandomString = $pseudoRandomString;
    }
}
