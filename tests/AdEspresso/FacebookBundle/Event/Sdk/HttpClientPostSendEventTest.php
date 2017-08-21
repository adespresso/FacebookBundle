<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use Facebook\Http\GraphRawResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPostSendEvent
 * @group unit
 */
class HttpClientPostSendEventTest extends TestCase
{
    /**
     * @var HttpClientPostSendEvent
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->graphRawResponse = $this->createMock(GraphRawResponse::class);
        $this->object = new HttpClientPostSendEvent($this->graphRawResponse);
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPostSendEvent::getGraphRawResponse
     *
     * @todo   Implement testGetGraphRawResponse()
     */
    public function testGetGraphRawResponse()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPostSendEvent::setGraphRawResponse
     *
     * @todo   Implement testSetGraphRawResponse()
     */
    public function testSetGraphRawResponse()
    {
        $this->markTestIncomplete();
    }
}
