<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use PHPUnit\Framework\TestCase;

/**
 * @covers \AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPostGetEvent
 * @group unit
 */
class PersistentDataPostGetEventTest extends TestCase
{
    /**
     * @var PersistentDataPostGetEvent
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->key = sha1(mt_rand());
        $this->value = sha1(mt_rand());

        $this->object = new PersistentDataPostGetEvent($this->key, $this->value);
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPostGetEvent::getKey
     *
     * @todo   Implement testGetKey()
     */
    public function testGetKey()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPostGetEvent::getValue
     *
     * @todo   Implement testGetValue()
     */
    public function testGetValue()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPostGetEvent::setValue
     *
     * @todo   Implement testSetValue()
     */
    public function testSetValue()
    {
        $this->markTestIncomplete();
    }
}
