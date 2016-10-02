<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use Symfony\Component\EventDispatcher\Event;

class PostGetCurrentUrlEvent extends Event
{
    /**
     * @var string
     */
    private $currentUrl;

    /**
     * @param string $currentUrl
     */
    public function __construct($currentUrl)
    {
        $this->currentUrl = $currentUrl;
    }

    /**
     * Gets the value of current URL.
     *
     * @return string
     */
    public function getCurrentUrl()
    {
        return $this->currentUrl;
    }

    /**
     * Sets the value of current URL.
     *
     * @param string $currentUrl
     */
    public function setCurrentUrl($currentUrl)
    {
        $this->currentUrl = $currentUrl;
    }
}
