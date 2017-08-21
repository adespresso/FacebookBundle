<?php

namespace AdEspresso\FacebookBundle\Subscriber;

use FacebookAds\Api;
use FacebookAds\Cursor;
use PHPUnit\Framework\TestCase;

/**
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
        $this->api = $this
            ->getMockBuilder(Api::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->useImplicitFetch = 1 === mt_rand(0, 1);

        $this->object = new AdsConfigSubscriber($this->api, $this->useImplicitFetch);
    }

    public function testGetSubscribedEvents()
    {
        $subscribedEvents = AdsConfigSubscriber::getSubscribedEvents();

        $this->assertInternalType('array', $subscribedEvents);
        $this->assertArrayHasKey('kernel.controller', $subscribedEvents);

        $this->assertTrue(method_exists($this->object, $subscribedEvents['kernel.controller']));
    }

    public function testInitialize()
    {
        $this->object->initialize();

        $this->assertSame($this->api, Api::instance());
        $this->assertSame($this->useImplicitFetch, Cursor::getDefaultUseImplicitFetch());
    }
}
