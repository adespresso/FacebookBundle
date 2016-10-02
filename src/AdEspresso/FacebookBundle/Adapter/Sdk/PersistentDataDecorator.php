<?php

namespace AdEspresso\FacebookBundle\Adapter\Sdk;

use AdEspresso\FacebookBundle\Event\Sdk as Event;
use AdEspresso\FacebookBundle\Events;
use Facebook\PersistentData\PersistentDataInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PersistentDataDecorator implements PersistentDataInterface
{
    /**
     * Decorated data persistence.
     *
     * @var PersistentDataInterface
     */
    private $persistentData;

    /**
     * Events dispatcher.
     *
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param PersistentDataInterface $persistentData
     */
    public function __construct(PersistentDataInterface $persistentData)
    {
        $this->persistentData = $persistentData;

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
    public function get($key)
    {
        $preEvent = new Event\PersistentDataPreGetEvent($key);
        $this->eventDispatcher->dispatch(
            Events::SDK_PERSISTENT_DATA_PRE_GET,
            $preEvent
        );

        $key = $preEvent->getKey();

        $value = $this->persistentData->get($key);

        $postEvent = new Event\PersistentDataPostGetEvent($key, $value);
        $this->eventDispatcher->dispatch(
            Events::SDK_PERSISTENT_DATA_POST_GET,
            $postEvent
        );

        return $postEvent->getValue();
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $preEvent = new Event\PersistentDataPreSetEvent($key, $value);
        $this->eventDispatcher->dispatch(
            Events::SDK_PERSISTENT_DATA_PRE_SET,
            $preEvent
        );

        $this->persistentData->set($preEvent->getKey(), $preEvent->getValue());
    }
}
