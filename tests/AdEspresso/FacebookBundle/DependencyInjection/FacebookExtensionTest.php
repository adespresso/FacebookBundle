<?php

namespace AdEspresso\FacebookBundle\DependencyInjection;

use AdEspresso\FacebookBundle\Adapter\Ads\HttpAdapter;
use AdEspresso\FacebookBundle\Adapter\Ads\Logger;
use AdEspresso\FacebookBundle\Adapter\FQB;
use AdEspresso\FacebookBundle\Adapter\Sdk\HttpClient;
use AdEspresso\FacebookBundle\Subscriber\AdsConfigSubscriber;
use Facebook\Facebook;
use Facebook\HttpClients\FacebookHttpClientInterface;
use Facebook\PersistentData\PersistentDataInterface;
use Facebook\PseudoRandomString\PseudoRandomStringGeneratorInterface;
use Facebook\Url\UrlDetectionInterface;
use FacebookAds\Api;
use FacebookAds\Http\Client;
use FacebookAds\Session;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * @group unit
 */
class FacebookExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return [
            new FacebookExtension(),
        ];
    }

    protected function getMinimalConfiguration()
    {
        return [
            'sdk' => [
                'config' => [
                    'app_id' => 'id',
                    'app_secret' => 'secret',
                ],
            ],
            'ads' => [
                'config' => [
                    'app_id' => 'id',
                    'app_secret' => 'secret',
                ],
            ],
        ];
    }

    protected function setUp()
    {
        parent::setUp();

        $this->registerService('event_dispatcher', EventDispatcher::class);
    }

    public function testServices()
    {
        $this->load();
        $this->compile();

        $this->assertContainerBuilderHasService('facebook.sdk', Facebook::class);
        $this->assertContainerBuilderHasService('facebook.sdk.http_client_handler', HttpClient::class);
        $this->assertContainerBuilderHasService('facebook.sdk.query_builder', FQB::class);

        $this->assertSame(
            $this->container
                ->get('facebook.sdk')
                ->getClient()
                ->getHttpClientHandler(),
            $this->container->get('facebook.sdk.http_client_handler')
        );

        $this->assertContainerBuilderHasService('facebook.ads', Api::class);
        $this->assertContainerBuilderHasService('facebook.ads.session', Session::class);
        $this->assertContainerBuilderHasService('facebook.ads.http.client', Client::class);
        $this->assertContainerBuilderHasService('facebook.ads.http_adapter', HttpAdapter::class);
        $this->assertContainerBuilderHasService('facebook.ads.logger', Logger::class);
        $this->assertContainerBuilderHasService('facebook.subscriber.ads_config', AdsConfigSubscriber::class);
    }

    public function testQueryBuilderNotShared()
    {
        $this->load();

        $this->assertFalse(
            $this->container
                ->getDefinition('facebook.sdk.query_builder')
                ->isShared()
        );
    }

    public function testDisabledSdk()
    {
        $this->load([
            'sdk' => [
                'enabled' => false,
            ],
            'ads' => [
                'config' => [
                    'app_id' => 'id',
                    'app_secret' => 'secret',
                ],
            ],
        ]);
        $this->compile();

        $this->assertContainerBuilderNotHasService('facebook.sdk');
        $this->assertContainerBuilderNotHasService('facebook.sdk.http_client_handler');
        $this->assertContainerBuilderNotHasService('facebook.sdk.query_builder');

        $this->assertContainerBuilderHasService('facebook.ads', Api::class);
    }

    public function testDisabledAds()
    {
        $this->load([
            'sdk' => [
                'config' => [
                    'app_id' => 'id',
                    'app_secret' => 'secret',
                ],
            ],
            'ads' => [
                'enabled' => false,
            ],
        ]);
        $this->compile();

        $this->assertContainerBuilderHasService('facebook.sdk', Facebook::class);

        $this->assertContainerBuilderNotHasService('facebook.ads');
        $this->assertContainerBuilderNotHasService('facebook.ads.session');
        $this->assertContainerBuilderNotHasService('facebook.ads.http.client');
        $this->assertContainerBuilderNotHasService('facebook.ads.http_adapter');
        $this->assertContainerBuilderNotHasService('facebook.ads.logger');
        $this->assertContainerBuilderNotHasService('facebook.subscriber.ads_config');
    }

    public function testSubscriberTagged()
    {
        $this->load();
        $this->compile();

        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            'facebook.ads.logger',
            'monolog.logger',
            [
                'channel' => 'facebook',
            ]
        );
        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            'facebook.subscriber.ads_config',
            'kernel.event_subscriber'
        );
    }

    public function testOverriddenServices()
    {
        $this->registerService('hch', FakeFacebookHttpClient::class);
        $this->registerService('prsg', FakePseudoRandomStringGenerator::class);
        $this->registerService('pdh', FakePersistentData::class);
        $this->registerService('udh', FakeUrlDetection::class);

        $this->load([
            'sdk' => [
                'config' => [
                    'http_client_handler' => 'hch',
                    'pseudo_random_string_generator' => 'prsg',
                    'persistent_data_handler' => 'pdh',
                    'url_detection_handler' => 'udh',
                ],
            ],
        ]);

        $this->compile();

        $this->assertContainerBuilderHasService('facebook.sdk', Facebook::class);

        $sdk = $this->container->get('facebook.sdk');

        $this->assertInstanceOf(FakeUrlDetection::class, $sdk->getUrlDetectionHandler());
        $this->assertInstanceOf(
            FakePseudoRandomStringGenerator::class,
            $sdk
                ->getRedirectLoginHelper()
                ->getPseudoRandomStringGenerator()
        );
        $this->assertInstanceOf(
            FakePersistentData::class,
            $sdk
                ->getRedirectLoginHelper()
                ->getPersistentDataHandler()
        );
        $this->assertInstanceOf(
            FakeFacebookHttpClient::class,
            $sdk
                ->getClient()
                ->getHttpClientHandler()
        );
    }

    /**
     * @dataProvider overriddenServicesMissingDataProvider
     * @expectedException \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @expectedExceptionMessageRegExp /You have requested a non-existent service "\w+"./
     */
    public function testOverriddenServicesMissing($service)
    {
        $this->load([
            'sdk' => [
                'config' => [
                    $service => 's'.sha1(mt_rand()),
                ],
            ],
        ]);
    }

    public static function overriddenServicesMissingDataProvider()
    {
        foreach (FacebookExtension::SDK_SERVICES as $service) {
            yield [$service];
        }
    }
}

class FakeUrlDetection implements UrlDetectionInterface
{
    public function getCurrentUrl()
    {
        // nothing to do
    }
}

class FakeFacebookHttpClient implements FacebookHttpClientInterface
{
    public function send($url, $method, $body, array $headers, $timeOut)
    {
        // nothing to do
    }
}

class FakePseudoRandomStringGenerator implements PseudoRandomStringGeneratorInterface
{
    public function getPseudoRandomString($length)
    {
        // nothing to do
    }
}

class FakePersistentData implements PersistentDataInterface
{
    public function get($key)
    {
        // nothing to do
    }

    public function set($key, $value)
    {
        // nothing to do
    }
}
