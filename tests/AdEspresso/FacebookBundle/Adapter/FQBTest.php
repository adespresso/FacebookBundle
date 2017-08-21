<?php

namespace AdEspresso\FacebookBundle\Adapter;

use Facebook\Facebook;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class FQBTest extends TestCase
{
    /**
     * @var Facebook
     */
    private $facebook;

    /**
     * @var FQB
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->facebook = $this
            ->getMockBuilder(Facebook::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = new FQB($this->facebook);
    }

    public function testNode()
    {
        $this->assertInstanceOf(FQB::class, $this->object->node('me'));
    }

    public function testGet()
    {
        $this->facebook
            ->expects($this->exactly(3))
            ->method('sendRequest')
            ->withConsecutive(
                ['GET', '/me', [], null, null, null],
                ['GET', '/foo?fields=foo,bar', [], null, null, null],
                ['GET', '/foo?west=coast-swing&limit=2&fields=foo,bar', [], null, null, null]
            );

        $fqb = clone $this->object;
        $fqb
            ->node('me')
            ->get();

        $fqb = clone $this->object;
        $fqb
            ->node('foo')
            ->fields('foo', 'bar')
            ->get();

        $fqb = clone $this->object;
        $fqb
            ->node('foo')
            ->fields(['foo', 'bar'])
            ->modifiers(['west' => 'coast-swing'])
            ->limit(2)
            ->get();
    }
}
