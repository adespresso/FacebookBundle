<?php

namespace AdEspresso\FacebookBundle\Adapter\Sdk;

use PHPUnit\Framework\TestCase;

/**
 * @covers \AdEspresso\FacebookBundle\Adapter\Sdk\HttpClient
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
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Adapter\Sdk\HttpClient::setClient
     *
     * @todo   Implement testSetClient()
     */
    public function testSetClient()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Adapter\Sdk\HttpClient::setEventDispatcher
     *
     * @todo   Implement testSetEventDispatcher()
     */
    public function testSetEventDispatcher()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Adapter\Sdk\HttpClient::send
     *
     * @todo   Implement testSend()
     */
    public function testSend()
    {
        $this->markTestIncomplete();
    }
}
