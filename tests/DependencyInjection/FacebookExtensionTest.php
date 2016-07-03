<?php

namespace AdEspresso\FacebookBundle\DependencyInjection;

use Facebook\Facebook;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

/**
 * @covers AdEspresso\FacebookBundle\DependencyInjection\FacebookExtension
 */
class FacebookExtensionTest extends AbstractExtensionTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getContainerExtensions()
    {
        return [
            new FacebookExtension(),
        ];
    }

    public function testServices()
    {
        $this->load();

        $this->assertContainerBuilderHasService('facebook', Facebook::class);
    }
}
