<?php

namespace AdEspresso\FacebookBundle\Adapter\Sdk;

use Facebook\PersistentData\PersistentDataInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers AdEspresso\FacebookBundle\Adapter\Sdk\PersistentDataDecorator
 * @group unit
 */
class PersistentDataDecoratorTest extends TestCase
{
    /**
     * @var PersistentDataDecorator
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->persistentData = $this->createMock(PersistentDataInterface::class);
        $this->object = new PersistentDataDecorator($this->persistentData);
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Sdk\PersistentDataDecorator::setEventDispatcher
     *
     * @todo   Implement testSetEventDispatcher()
     */
    public function testSetEventDispatcher()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Sdk\PersistentDataDecorator::get
     *
     * @todo   Implement testGet()
     */
    public function testGet()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Adapter\Sdk\PersistentDataDecorator::set
     *
     * @todo   Implement testSet()
     */
    public function testSet()
    {
        $this->markTestIncomplete();
    }
}
