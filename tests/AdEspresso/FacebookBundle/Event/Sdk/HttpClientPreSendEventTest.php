<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class HttpClientPreSendEventTest extends TestCase
{
    /**
     * @var HttpClientPreSendEvent
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->url = sha1(mt_rand());
        $this->method = sha1(mt_rand());
        $this->body = sha1(mt_rand());
        $this->headers = [];
        $this->timeOut = mt_rand();

        $this->object = new HttpClientPreSendEvent(
            $this->url,
            $this->method,
            $this->body,
            $this->headers,
            $this->timeOut
        );
    }

    public function testUrl()
    {
        $this->assertSame($this->url, $this->object->getUrl());

        $url = sha1(mt_rand());

        $this->object->setUrl($url);

        $this->assertSame($url, $this->object->getUrl());
        $this->assertNotSame($this->url, $this->object->getUrl());
    }

    public function testMethod()
    {
        $this->assertSame($this->method, $this->object->getMethod());

        $method = sha1(mt_rand());

        $this->object->setMethod($method);

        $this->assertSame($method, $this->object->getMethod());
        $this->assertNotSame($this->method, $this->object->getMethod());
    }

    public function testBody()
    {
        $this->assertSame($this->body, $this->object->getBody());

        $body = sha1(mt_rand());

        $this->object->setBody($body);

        $this->assertSame($body, $this->object->getBody());
        $this->assertNotSame($this->body, $this->object->getBody());
    }

    public function testHeaders()
    {
        $this->assertSame($this->headers, $this->object->getHeaders());

        $headers = range(1, 5);

        $this->object->setHeaders($headers);

        $this->assertSame($headers, $this->object->getHeaders());
        $this->assertNotSame($this->headers, $this->object->getHeaders());
    }

    public function testTimeOut()
    {
        $this->assertSame($this->timeOut, $this->object->getTimeOut());

        $timeOut = mt_rand();

        $this->object->setTimeOut($timeOut);

        $this->assertSame($timeOut, $this->object->getTimeOut());
        $this->assertNotSame($this->timeOut, $this->object->getTimeOut());
    }
}
