<?php

namespace AdEspresso\FacebookBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * {@inheritdoc}
 */
class FacebookExtension extends Extension
{
    /**
     * @var string[]
     */
    const SDK_SERVICES = [
        'http_client_handler',
        'persistent_data_handler',
        'pseudo_random_string_generator',
        'url_detection_handler',
    ];

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        if ($config['sdk']['enabled']) {
            $loader->load('sdk.xml');
            $this->loadSdk($config['sdk'], $container);
        }

        if ($config['ads']['enabled']) {
            $loader->load('ads.xml');
            $this->loadAds($config['ads'], $container);
        }
    }

    /**
     * Loads and configure the SDK services.
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function loadSdk(array $config, ContainerBuilder $container)
    {
        if (!isset($config['config'])) {
            return;
        }

        $sdkConfig = array_filter($config['config']);

        foreach (self::SDK_SERVICES as $service) {
            if (isset($sdkConfig[$service])) {
                $sdkConfig[$service] = $container->getDefinition($sdkConfig[$service]);
            }
        }

        $sdk = $container->getDefinition('facebook.sdk');
        $arguments = array_merge($sdk->getArgument(0), $sdkConfig);
        $sdk->replaceArgument(0, $arguments);
    }

    /**
     * Loads and configure the ADS SDK services.
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function loadAds(array $config, ContainerBuilder $container)
    {
        $adsConfig = $config['config'];

        $container
            ->getDefinition('facebook.ads.session')
            ->setArguments([
                $adsConfig['app_id'],
                $adsConfig['app_secret'],
                $adsConfig['default_access_token'],
            ]);

        $container
            ->getDefinition('facebook.ads')
            ->addMethodCall(
                'setDefaultGraphVersion',
                [
                    preg_replace(
                        '/^v(.*)$/',
                        '$1',
                        $adsConfig['default_graph_version']
                    ),
                ]
            );

        if (isset($config['options'])) {
            $container
                ->getDefinition('facebook.subscriber.ads_config')
                ->addArgument($config['options']['use_implicit_fetch']);
        }
    }
}
