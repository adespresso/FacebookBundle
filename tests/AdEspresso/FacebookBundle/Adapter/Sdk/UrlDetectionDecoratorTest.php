<?php

namespace AdEspresso\FacebookBundle\Adapter\Sdk;

use Facebook\Url\UrlDetectionInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers AdEspresso\FacebookBundle\Adapter\Sdk\UrlDetectionDecorator
 * @group unit
 */
class UrlDetectionDecoratorTest extends TestCase
{
    /**
     * @var UrlDetectionDecorator
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->urlDetection = $this->createMock(UrlDetectionInterface::class);
        $this->object = new UrlDetectionDecorator($this->urlDetection);
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Sdk\UrlDetectionDecorator::setEventDispatcher
     *
     * @todo   Implement testSetEventDispatcher()
     */
    public function testSetEventDispatcher()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Sdk\UrlDetectionDecorator::getCurrentUrl
     *
     * @todo   Implement testGetCurrentUrl()
     */
    public function testGetCurrentUrl()
    {
        $this->markTestIncomplete();
    }
}
