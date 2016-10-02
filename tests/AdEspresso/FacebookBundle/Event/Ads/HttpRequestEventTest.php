<?php

namespace AdEspresso\FacebookBundle\Event\Ads;

use FacebookAds\Http\Adapter\AdapterInterface;
use FacebookAds\Http\RequestInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers AdEspresso\FacebookBundle\Event\Ads\HttpRequestEvent
 * @group unit
 */
class HttpRequestEventTest extends TestCase
{
    /**
     * @var HttpRequestEvent
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = $this->createMock(RequestInterface::class);
        $this->adapter = $this->createMock(AdapterInterface::class);
        $this->object = new HttpRequestEvent($this->request, $this->adapter);
    }

    /**
     * @covers AdEspresso\FacebookBundle\Event\Ads\HttpRequestEvent::getRequest
     *
     * @todo   Implement testGetRequest()
     */
    public function testGetRequest()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Event\Ads\HttpRequestEvent::setRequest
     *
     * @todo   Implement testSetRequest()
     */
    public function testSetRequest()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Event\Ads\HttpRequestEvent::getAdapter
     *
     * @todo   Implement testGetAdapter()
     */
    public function testGetAdapter()
    {
        $this->markTestIncomplete();
    }
}
