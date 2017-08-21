<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use Facebook\Http\GraphRawResponse;
use PHPUnit\Framework\TestCase;

/**
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
        $this->graphRawResponse = $this
            ->getMockBuilder(GraphRawResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = new HttpClientPostSendEvent($this->graphRawResponse);
    }

    public function testGraphRawResponse()
    {
        $this->assertSame(
            $this->graphRawResponse,
            $this->object->getGraphRawResponse()
        );

        $graphRawResponse = $this
            ->getMockBuilder(GraphRawResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setGraphRawResponse($graphRawResponse);

        $this->assertSame(
            $graphRawResponse,
            $this->object->getGraphRawResponse()
        );
        $this->assertNotSame(
            $this->graphRawResponse,
            $this->object->getGraphRawResponse()
        );
    }
}
