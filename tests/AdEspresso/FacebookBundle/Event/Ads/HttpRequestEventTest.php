<?php

namespace AdEspresso\FacebookBundle\Event\Ads;

use FacebookAds\Http\Adapter\AdapterInterface;
use FacebookAds\Http\RequestInterface;
use PHPUnit\Framework\TestCase;

/**
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
        $this->request = $this
            ->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->adapter = $this
            ->getMockBuilder(AdapterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = new HttpRequestEvent($this->request, $this->adapter);
    }

    public function testRequest()
    {
        $this->assertSame($this->request, $this->object->getRequest());

        $request = $this
            ->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setRequest($request);

        $this->assertSame($request, $this->object->getRequest());
        $this->assertNotSame($this->request, $this->object->getRequest());
    }

    public function testAdapter()
    {
        $this->assertSame($this->adapter, $this->object->getAdapter());
    }
}
