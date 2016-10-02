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

        $loader->load('services.xml');

        $this->configureSdk($config['sdk'], $container);
        $this->configureAds($config['ads'], $container);
    }

    private function configureSdk(array $config, ContainerBuilder $container)
    {
        $sdk = $container->getDefinition('facebook.sdk');

        $sdkConfig = $config['config'];
        $sdkOptions = $config['options'];

        $arguments = array_filter([
            'app_id' => $sdkConfig['app_id'],
            'app_secret' => $sdkConfig['app_secret'],
            'default_graph_version' => $sdkConfig['default_graph_version'],
            'default_access_token' => $sdkConfig['default_access_token'],
            'enable_beta_mode' => $sdkOptions['enable_beta_mode'],
        ]);

        $arguments = array_merge($sdk->getArgument(0), $arguments);

        $sdk->replaceArgument(0, $arguments);
    }

    private function configureAds(array $config, ContainerBuilder $container)
    {
        $adsConfig = $config['config'];
        $adsOptions = $config['options'];

        $container
            ->getDefinition('facebook_ads.session')
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

        $container
            ->getDefinition('facebook.subscriber.ads_config')
            ->addArgument($adsOptions['use_implicit_fetch']);
    }
}
