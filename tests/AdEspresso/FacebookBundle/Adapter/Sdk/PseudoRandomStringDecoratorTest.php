<?php

namespace AdEspresso\FacebookBundle\Adapter\Sdk;

use Facebook\PseudoRandomString\PseudoRandomStringGeneratorInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers \AdEspresso\FacebookBundle\Adapter\Sdk\PseudoRandomStringDecorator
 * @group unit
 */
class PseudoRandomStringDecoratorTest extends TestCase
{
    /**
     * @var PseudoRandomStringDecorator
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->generator = $this->createMock(PseudoRandomStringGeneratorInterface::class);
        $this->object = new PseudoRandomStringDecorator($this->generator);
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Adapter\Sdk\PseudoRandomStringDecorator::setEventDispatcher
     *
     * @todo   Implement testSetEventDispatcher()
     */
    public function testSetEventDispatcher()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Adapter\Sdk\PseudoRandomStringDecorator::getPseudoRandomString
     *
     * @todo   Implement testGetPseudoRandomString()
     */
    public function testGetPseudoRandomString()
    {
        $this->markTestIncomplete();
    }
}
