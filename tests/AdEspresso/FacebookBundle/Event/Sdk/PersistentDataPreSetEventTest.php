<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use PHPUnit\Framework\TestCase;

/**
 * @covers \AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPreSetEvent
 * @group unit
 */
class PersistentDataPreSetEventTest extends TestCase
{
    /**
     * @var PersistentDataPreSetEvent
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->key = sha1(mt_rand());
        $this->value = sha1(mt_rand());

        $this->object = new PersistentDataPreSetEvent($this->key, $this->value);
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPreSetEvent::getKey
     *
     * @todo   Implement testGetKey()
     */
    public function testGetKey()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPreSetEvent::setKey
     *
     * @todo   Implement testSetKey()
     */
    public function testSetKey()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPreSetEvent::getValue
     *
     * @todo   Implement testGetValue()
     */
    public function testGetValue()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPreSetEvent::setValue
     *
     * @todo   Implement testSetValue()
     */
    public function testSetValue()
    {
        $this->markTestIncomplete();
    }
}
