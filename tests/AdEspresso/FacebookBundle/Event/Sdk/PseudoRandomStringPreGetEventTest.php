<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use PHPUnit\Framework\TestCase;

/**
 * @covers AdEspresso\FacebookBundle\Event\Sdk\PseudoRandomStringPreGetEvent
 * @group unit
 */
class PseudoRandomStringPreGetEventTest extends TestCase
{
    /**
     * @var PseudoRandomStringPreGetEvent
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->length = mt_rand();
        $this->object = new PseudoRandomStringPreGetEvent($this->length);
    }

    /**
     * @covers AdEspresso\FacebookBundle\Event\Sdk\PseudoRandomStringPreGetEvent::getLength
     *
     * @todo   Implement testGetLength()
     */
    public function testGetLength()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Event\Sdk\PseudoRandomStringPreGetEvent::setLength
     *
     * @todo   Implement testSetLength()
     */
    public function testSetLength()
    {
        $this->markTestIncomplete();
    }
}
