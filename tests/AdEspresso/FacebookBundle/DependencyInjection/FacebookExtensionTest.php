<?php

namespace AdEspresso\FacebookBundle\DependencyInjection;

use Facebook\Facebook;
use FacebookAds\Api;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

/**
 * @covers \AdEspresso\FacebookBundle\DependencyInjection\FacebookExtension
 * @group unit
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

    /**
     * {@inheritdoc}
     */
    protected function getConfiguration()
    {
        return new Configuration();
    }

    /**
     * {@inheritdoc}
     */
    protected function getMinimalConfiguration()
    {
        return [
            'sdk' => [
                'config' => [
                    'app_id' => 'id',
                    'app_secret' => 'secret',
                    'default_access_token' => 'token',
                ],
            ],
            'ads' => [
                'config' => [
                    'app_id' => 'id',
                    'app_secret' => 'secret',
                    'default_access_token' => 'token',
                ],
            ],
        ];
    }

    public function testServices()
    {
        $this->load();

        $this->assertContainerBuilderHasService('facebook.sdk', Facebook::class);
        $this->assertContainerBuilderHasService('facebook.ads', Api::class);
    }
}
