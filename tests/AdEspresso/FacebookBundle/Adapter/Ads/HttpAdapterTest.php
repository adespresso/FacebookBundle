<?php

namespace AdEspresso\FacebookBundle\Adapter\Ads;

use AdEspresso\FacebookBundle\Event\Ads\HttpRequestEvent;
use AdEspresso\FacebookBundle\Event\Ads\HttpResponseEvent;
use AdEspresso\FacebookBundle\Events;
use ArrayObject;
use FacebookAds\Http\Client;
use FacebookAds\Http\Headers;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Http\ResponseInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use ReflectionObject;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @group unit
 */
class HttpAdapterTest extends TestCase
{
    /**
     * @var HttpAdapter
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->client = $this
            ->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = new HttpAdapter($this->client);
    }

    public function testOpts()
    {
        $this->assertInstanceOf(ArrayObject::class, $this->object->getOpts());

        $opts = $this
            ->getMockBuilder(ArrayObject::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setOpts($opts);

        $this->assertSame($opts, $this->object->getOpts());
    }

    public function testSetGuzzleClient()
    {
        $reflection = new ReflectionObject($this->object);
        $property = $reflection->getProperty('guzzleClient');
        $property->setAccessible(true);

        $this->assertInstanceOf(
            GuzzleClientInterface::class,
            $property->getValue($this->object)
        );

        $guzzleClient = $this
            ->getMockBuilder(GuzzleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setGuzzleClient($guzzleClient);

        $this->assertSame($guzzleClient, $property->getValue($this->object));
    }

    public function testSetEventDispatcher()
    {
        $reflection = new ReflectionObject($this->object);
        $property = $reflection->getProperty('eventDispatcher');
        $property->setAccessible(true);

        $this->assertInstanceOf(
            EventDispatcherInterface::class,
            $property->getValue($this->object)
        );

        $eventDispatcher = $this
            ->getMockBuilder(EventDispatcherInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setEventDispatcher($eventDispatcher);

        $this->assertSame($eventDispatcher, $property->getValue($this->object));
    }

    public function testSendRequest()
    {
        $psrResponse = $this
            ->getMockBuilder(PsrResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $psrResponse
            ->expects($this->once())
            ->method('getBody')
            ->willReturn('test');

        $psrResponse
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $psrResponse
            ->expects($this->once())
            ->method('getHeaders')
            ->willReturn([
                'X-Foo' => ['Foo', 'Bar'],
            ]);

        $guzzleClient = $this
            ->getMockBuilder(GuzzleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $guzzleClient
            ->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                'http://www.example.com/',
                [
                    'headers' => [],
                    'curl' => [],
                    'http_errors' => false,
                ]
            )
            ->willReturn($psrResponse);

        $this->object->setGuzzleClient($guzzleClient);

        $request = $this
            ->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $request
            ->expects($this->exactly(3))
            ->method('getMethod')
            ->willReturn('GET');

        $request
            ->expects($this->once())
            ->method('getUrl')
            ->willReturn('http://www.example.com/');

        $request
            ->expects($this->once())
            ->method('getHeaders')
            ->willReturn(new Headers());

        $eventDispatcher = $this
            ->getMockBuilder(EventDispatcherInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->setEventDispatcher($eventDispatcher);

        $eventDispatcher
            ->expects($this->exactly(2))
            ->method('dispatch')
            ->withConsecutive(
                [Events::ADS_HTTP_REQUEST, $this->callback(function ($value) {
                    return $value instanceof HttpRequestEvent;
                })],
                [Events::ADS_HTTP_RESPONSE, $this->callback(function ($value) {
                    return $value instanceof HttpResponseEvent;
                })]
            );

        $response = $this->object->sendRequest($request);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(
            [
                'X-Foo' => 'Foo, Bar',
            ],
            $response
                ->getHeaders()
                ->getArrayCopy()
        );
        $this->assertSame('test', $response->getBody());
    }
}
