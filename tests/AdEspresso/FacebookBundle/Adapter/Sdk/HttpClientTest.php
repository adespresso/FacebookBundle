<?php

namespace AdEspresso\FacebookBundle\Adapter\Sdk;

use AdEspresso\FacebookBundle\Event\Sdk\HttpClientPostSendEvent;
use AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent;
use AdEspresso\FacebookBundle\Events;
use Facebook\Http\GraphRawResponse;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @group unit
 */
class HttpClientTest extends TestCase
{
    /**
     * @var HttpClient
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->object = new HttpClient();

        $this->assertInstanceOf(Client::class, $this->object->getClient());
        $this->assertInstanceOf(EventDispatcher::class, $this->object->getEventDispatcher());
    }

    public function testClient()
    {
        $client = $this
            ->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertInstanceOf(ClientInterface::class, $this->object->getClient());
        $this->assertNotSame($client, $this->object->getClient());

        $this->object->setClient($client);

        $this->assertInstanceOf(ClientInterface::class, $this->object->getClient());
        $this->assertSame($client, $this->object->getClient());
    }

    public function testEventDispatcher()
    {
        $eventDispatcher = $this
            ->getMockBuilder(EventDispatcherInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertInstanceOf(EventDispatcherInterface::class, $this->object->getEventDispatcher());
        $this->assertNotSame($eventDispatcher, $this->object->getEventDispatcher());

        $this->object->setEventDispatcher($eventDispatcher);

        $this->assertInstanceOf(EventDispatcherInterface::class, $this->object->getEventDispatcher());
        $this->assertSame($eventDispatcher, $this->object->getEventDispatcher());
    }

    public function testSend()
    {
        $data = [
            'url' => 'http://www.example.com/',
            'method' => 'GET',
            'body' => '',
            'headers' => [],
            'timeOut' => 0,
        ];

        $client = new Client([
            'handler' => HandlerStack::create(new MockHandler([
                // testare anche il 500
                new Response(200, [
                    'X-Foo' => ['Foo', 'Bar'],
                ], 'test'),
            ])),
        ]);

        $eventDispatcher = $this
            ->getMockBuilder(EventDispatcherInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setClient($client);
        $this->object->setEventDispatcher($eventDispatcher);

        $eventDispatcher
            ->expects($this->exactly(2))
            ->method('dispatch')
            ->withConsecutive(
                [Events::SDK_HTTP_CLIENT_PRE_SEND, $this->callback(function ($value) use ($data) {
                    return $value instanceof HttpClientPreSendEvent
                        && $value->getUrl() === $data['url']
                        && $value->getMethod() === $data['method']
                        && $value->getBody() === $data['body']
                        && $value->getHeaders() === $data['headers']
                        && $value->getTimeOut() === $data['timeOut'];
                })],
                [Events::SDK_HTTP_CLIENT_POST_SEND, $this->callback(function ($value) {
                    if (!$value instanceof HttpClientPostSendEvent) {
                        return false;
                    }

                    $graphRawResponse = $value->getGraphRawResponse();

                    return $graphRawResponse instanceof GraphRawResponse
                        && $graphRawResponse->getHeaders() === ['X-Foo' => 'Foo, Bar']
                        && $graphRawResponse->getBody() === 'test'
                        && $graphRawResponse->getHttpResponseCode() === 200;
                })]
            );

        $output = $this->object->send(...array_values($data));

        $this->assertInstanceOf(GraphRawResponse::class, $output);
        $this->assertSame(['X-Foo' => 'Foo, Bar'], $output->getHeaders());
        $this->assertSame('test', $output->getBody());
        $this->assertSame(200, $output->getHttpResponseCode());
    }
}
