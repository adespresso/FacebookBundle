<?php

namespace AdEspresso\FacebookBundle\Adapter\Sdk;

use AdEspresso\FacebookBundle\Event\Sdk\PostGetCurrentUrlEvent;
use AdEspresso\FacebookBundle\Events;
use Facebook\Url\UrlDetectionInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UrlDetectionDecorator implements UrlDetectionInterface
{
    /**
     * Decorated URL detector.
     *
     * @var UrlDetectionInterface
     */
    private $detector;

    /**
     * Events dispatcher.
     *
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param UrlDetectionInterface $detector
     */
    public function __construct(UrlDetectionInterface $detector)
    {
        $this->detector = $detector;

        $this->setEventDispatcher(new EventDispatcher());
    }

    /**
     * Sets the events dispatcher.
     *
     * @param EventDispatcherInterface $dispatcher
     */
    public function setEventDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->eventDispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentUrl()
    {
        $currentUrl = $this->detector->getCurrentUrl();

        $postEvent = new PostGetCurrentUrlEvent($currentUrl);
        $this->eventDispatcher->dispatch(
            Events::SDK_URL_POST_GET_CURRENT_URL,
            $postEvent
        );

        return $postEvent->getCurrentUrl();
    }
}
