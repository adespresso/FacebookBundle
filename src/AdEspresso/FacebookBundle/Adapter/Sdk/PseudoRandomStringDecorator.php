<?php

namespace AdEspresso\FacebookBundle\Adapter\Sdk;

use AdEspresso\FacebookBundle\Event\Sdk\PseudoRandomStringPostGetEvent;
use AdEspresso\FacebookBundle\Event\Sdk\PseudoRandomStringPreGetEvent;
use AdEspresso\FacebookBundle\Events;
use Facebook\PseudoRandomString\PseudoRandomStringGeneratorInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PseudoRandomStringDecorator implements PseudoRandomStringGeneratorInterface
{
    /**
     * Decorated pseudo random string generator.
     *
     * @var PseudoRandomStringGeneratorInterface
     */
    private $generator;

    /**
     * Events dispatcher.
     *
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param PseudoRandomStringGeneratorInterface $generator
     */
    public function __construct(PseudoRandomStringGeneratorInterface $generator)
    {
        $this->generator = $generator;

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
    public function getPseudoRandomString($length)
    {
        $preEvent = new PseudoRandomStringPreGetEvent($length);
        $this->eventDispatcher->dispatch(
            Events::SDK_PSEUDO_RANDOM_STRING_PRE_GET,
            $preEvent
        );

        $length = $preEvent->getLength();

        $pseudoRandomString = $this->generator->getPseudoRandomString($length);

        $postEvent = new PseudoRandomStringPostGetEvent($length, $pseudoRandomString);
        $this->eventDispatcher->dispatch(
            Events::SDK_PSEUDO_RANDOM_STRING_POST_GET,
            $postEvent
        );

        return $postEvent->getPseudoRandomString();
    }
}
