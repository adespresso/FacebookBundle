<?php

namespace AdEspresso\FacebookBundle\Subscriber;

use FacebookAds\Api;
use FacebookAds\Cursor;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdsConfigSubscriber implements EventSubscriberInterface
{
    /**
     * Facebook ads api instance.
     *
     * @var Api
     */
    private $api;

    /**
     * Sets if should use implicit fetch.
     *
     * @var bool
     */
    private $useImplicitFetch = false;

    /**
     * Required items.
     *
     * @param Api  $api
     * @param bool $useImplicitFetch
     */
    public function __construct(Api $api, $useImplicitFetch = false)
    {
        $this->api = $api;
        $this->useImplicitFetch = $useImplicitFetch;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'initialize',
        ];
    }

    /**
     * Initializes shared items.
     */
    public function initialize()
    {
        Api::setInstance($this->api);
        Cursor::setDefaultUseImplicitFetch($this->useImplicitFetch);
    }
}
