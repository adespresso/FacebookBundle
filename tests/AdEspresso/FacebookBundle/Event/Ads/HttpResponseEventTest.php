<?php

namespace AdEspresso\FacebookBundle\Event\Ads;

use FacebookAds\Http\Adapter\AdapterInterface;
use FacebookAds\Http\ResponseInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers \AdEspresso\FacebookBundle\Event\Ads\HttpResponseEvent
 * @group unit
 */
class HttpResponseEventTest extends TestCase
{
    /**
     * @var HttpResponseEvent
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->response = $this->createMock(ResponseInterface::class);
        $this->adapter = $this->createMock(AdapterInterface::class);
        $this->object = new HttpResponseEvent($this->response, $this->adapter);
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Ads\HttpResponseEvent::getResponse
     *
     * @todo   Implement testGetResponse()
     */
    public function testGetResponse()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Ads\HttpResponseEvent::setResponse
     *
     * @todo   Implement testSetResponse()
     */
    public function testSetResponse()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Ads\HttpResponseEvent::getAdapter
     *
     * @todo   Implement testGetAdapter()
     */
    public function testGetAdapter()
    {
        $this->markTestIncomplete();
    }
}
