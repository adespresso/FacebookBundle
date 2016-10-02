<?php

namespace AdEspresso\FacebookBundle\Adapter\Ads;

use PHPUnit\Framework\TestCase;

/**
 * @covers AdEspresso\FacebookBundle\Adapter\Ads\Logger
 * @group unit
 */
class LoggerTest extends TestCase
{
    /**
     * @var Logger
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->object = new Logger();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Ads\Logger::log
     *
     * @todo   Implement testLog()
     */
    public function testLog()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Ads\Logger::logRequest
     *
     * @todo   Implement testLogRequest()
     */
    public function testLogRequest()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Ads\Logger::logResponse
     *
     * @todo   Implement testLogResponse()
     */
    public function testLogResponse()
    {
        $this->markTestIncomplete();
    }
}
