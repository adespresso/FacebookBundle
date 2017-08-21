<?php

namespace AdEspresso\FacebookBundle\Event\Ads;

use FacebookAds\Http\Adapter\AdapterInterface;
use FacebookAds\Http\ResponseInterface;
use PHPUnit\Framework\TestCase;

/**
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
        $this->response = $this
            ->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->adapter = $this
            ->getMockBuilder(AdapterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = new HttpResponseEvent($this->response, $this->adapter);
    }

    public function testRequest()
    {
        $this->assertSame($this->response, $this->object->getResponse());

        $response = $this
            ->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setResponse($response);

        $this->assertSame($response, $this->object->getResponse());
        $this->assertNotSame($this->response, $this->object->getResponse());
    }

    public function testAdapter()
    {
        $this->assertSame($this->adapter, $this->object->getAdapter());
    }
}
