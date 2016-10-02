<?php

namespace AdEspresso\FacebookBundle\Subscriber;

use FacebookAds\Api;
use PHPUnit\Framework\TestCase;

/**
 * @covers AdEspresso\FacebookBundle\Subscriber\AdsConfigSubscriber
 * @group unit
 */
class AdsConfigSubscriberTest extends TestCase
{
    /**
     * @var AdsConfigSubscriber
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->api = $this->createMock(Api::class);
        $this->useImplicitFetch = 1 === mt_rand(0, 1);

        $this->object = new AdsConfigSubscriber($this->api, $this->useImplicitFetch);
    }

    /**
     * @covers AdEspresso\FacebookBundle\Subscriber\AdsConfigSubscriber::getSubscribedEvents
     *
     * @todo   Implement testGetSubscribedEvents()
     */
    public function testGetSubscribedEvents()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Subscriber\AdsConfigSubscriber::initialize
     *
     * @todo   Implement testInitialize()
     */
    public function testInitialize()
    {
        $this->markTestIncomplete();
    }
}
