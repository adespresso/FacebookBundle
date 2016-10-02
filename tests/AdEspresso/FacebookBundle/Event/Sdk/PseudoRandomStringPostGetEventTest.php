<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use PHPUnit\Framework\TestCase;

/**
 * @covers AdEspresso\FacebookBundle\Event\Sdk\PseudoRandomStringPostGetEvent
 * @group unit
 */
class PseudoRandomStringPostGetEventTest extends TestCase
{
    /**
     * @var PseudoRandomStringPostGetEvent
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->length = mt_rand();
        $this->pseudoRandomString = sha1(mt_rand());
        $this->object = new PseudoRandomStringPostGetEvent($this->length, $this->pseudoRandomString);
    }

    /**
     * @covers AdEspresso\FacebookBundle\Event\Sdk\PseudoRandomStringPostGetEvent::getLength
     *
     * @todo   Implement testGetLength()
     */
    public function testGetLength()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Event\Sdk\PseudoRandomStringPostGetEvent::getPseudoRandomString
     *
     * @todo   Implement testGetPseudoRandomString()
     */
    public function testGetPseudoRandomString()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers AdEspresso\FacebookBundle\Event\Sdk\PseudoRandomStringPostGetEvent::setPseudoRandomString
     *
     * @todo   Implement testSetPseudoRandomString()
     */
    public function testSetPseudoRandomString()
    {
        $this->markTestIncomplete();
    }
}
