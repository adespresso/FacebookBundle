<?php

namespace AdEspresso\FacebookBundle\Adapter\Ads;

use FacebookAds\Http\Client;
use PHPUnit\Framework\TestCase;

/**
 * @covers AdEspresso\FacebookBundle\Adapter\Ads\HttpAdapter
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
        $this->client = $this->createMock(Client::class);
        $this->object = new HttpAdapter($this->client);
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Ads\HttpAdapter::getOpts
     *
     * @todo   Implement testGetOpts()
     */
    public function testGetOpts()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Ads\HttpAdapter::setOpts
     *
     * @todo   Implement testSetOpts()
     */
    public function testSetOpts()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Ads\HttpAdapter::sendRequest
     *
     * @todo   Implement testSendRequest()
     */
    public function testSendRequest()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Ads\HttpAdapter::setGuzzleClient
     *
     * @todo   Implement testSetGuzzleClient()
     */
    public function testSetGuzzleClient()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Ads\HttpAdapter::setEventDispatcher
     *
     * @todo   Implement testSetEventDispatcher()
     */
    public function testSetEventDispatcher()
    {
        $this->markTestIncomplete();
    }
}
