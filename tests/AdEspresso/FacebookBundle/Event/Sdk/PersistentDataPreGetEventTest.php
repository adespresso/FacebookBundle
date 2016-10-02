<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use PHPUnit\Framework\TestCase;

/**
 * @covers AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPreGetEvent
 * @group unit
 */
class PersistentDataPreGetEventTest extends TestCase
{
    /**
     * @var PersistentDataPreGetEvent
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->key = sha1(mt_rand());
        $this->object = new PersistentDataPreGetEvent($this->key);
    }

    /**
     * @covers AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPreGetEvent::getKey
     *
     * @todo   Implement testGetKey()
     */
    public function testGetKey()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Event\Sdk\PersistentDataPreGetEvent::setKey
     *
     * @todo   Implement testSetKey()
     */
    public function testSetKey()
    {
        $this->markTestIncomplete();
    }
}
