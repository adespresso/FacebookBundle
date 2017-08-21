<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use PHPUnit\Framework\TestCase;

/**
 * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent
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

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent::getUrl
     *
     * @todo   Implement testGetUrl()
     */
    public function testGetUrl()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent::setUrl
     *
     * @todo   Implement testSetUrl()
     */
    public function testSetUrl()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent::getMethod
     *
     * @todo   Implement testGetMethod()
     */
    public function testGetMethod()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent::setMethod
     *
     * @todo   Implement testSetMethod()
     */
    public function testSetMethod()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent::getBody
     *
     * @todo   Implement testGetBody()
     */
    public function testGetBody()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent::setBody
     *
     * @todo   Implement testSetBody()
     */
    public function testSetBody()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent::getHeaders
     *
     * @todo   Implement testGetHeaders()
     */
    public function testGetHeaders()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent::setHeaders
     *
     * @todo   Implement testSetHeaders()
     */
    public function testSetHeaders()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent::getTimeOut
     *
     * @todo   Implement testGetTimeOut()
     */
    public function testGetTimeOut()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent::setTimeOut
     *
     * @todo   Implement testSetTimeOut()
     */
    public function testSetTimeOut()
    {
        $this->markTestIncomplete();
    }
}
