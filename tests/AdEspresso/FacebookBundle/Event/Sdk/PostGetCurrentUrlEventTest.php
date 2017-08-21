<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use PHPUnit\Framework\TestCase;

/**
 * @covers \AdEspresso\FacebookBundle\Event\Sdk\PostGetCurrentUrlEvent
 * @group unit
 */
class PostGetCurrentUrlEventTest extends TestCase
{
    /**
     * @var PostGetCurrentUrlEvent
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->currentUrl = sha1(mt_rand());
        $this->object = new PostGetCurrentUrlEvent($this->currentUrl);
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\PostGetCurrentUrlEvent::getCurrentUrl
     *
     * @todo   Implement testGetCurrentUrl()
     */
    public function testGetCurrentUrl()
    {
        $this->markTestIncomplete();
    }

    /**
     * @covers \AdEspresso\FacebookBundle\Event\Sdk\PostGetCurrentUrlEvent::setCurrentUrl
     *
     * @todo   Implement testSetCurrentUrl()
     */
    public function testSetCurrentUrl()
    {
        $this->markTestIncomplete();
    }
}
