<?php

namespace AdEspresso\FacebookBundle\DependencyInjection;

use Facebook\Facebook;
use FacebookAds\Api;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * {@inheritdoc}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Invalid graph version exception message.
     *
     * @var string
     */
    const INVALID_VERSION = 'Graph version must use format "v[major].[minor]".';

    /**
     * Invalid SDK configuration exception message.
     *
     * @var string
     */
    const INVALID_SDK_CONFIG = 'To enable the SDK define the minimum configuration.';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('facebook');

        $rootNode
            ->children()
                ->append($this->getSdkNode())
                ->append($this->getAdsNode())
            ->end();

        return $treeBuilder;
    }

    /**
     * Gets graph SDK basic configuration.
     *
     * @return \Symfony\Component\Config\Definition\Builder\NodeDefinition
     */
    private function getSdkNode()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sdk');

        $rootNode
            ->isRequired()
            ->canBeDisabled()
            ->children()
                ->arrayNode('config')
                    ->children()
                        ->scalarNode('app_id')
                            ->cannotBeEmpty()
                            ->isRequired()
                        ->end()
                        ->scalarNode('app_secret')
                            ->cannotBeEmpty()
                            ->isRequired()
                        ->end()
                        ->scalarNode('default_access_token')
                            ->defaultNull()
                        ->end()
                        ->scalarNode('default_graph_version')
                            ->cannotBeEmpty()
                            ->defaultValue(Facebook::DEFAULT_GRAPH_VERSION)
                            ->validate()
                                ->ifTrue(function ($value) {
                                    return !preg_match('/^v\d.\d$/', $value);
                                })
                                ->thenInvalid(self::INVALID_VERSION)
                            ->end()
                        ->end()
                        ->booleanNode('enable_beta_mode')
                            ->defaultFalse()
                        ->end()
                        ->scalarNode('http_client_handler')
                            ->defaultNull()
                        ->end()
                        ->scalarNode('persistent_data_handler')
                            ->defaultNull()
                        ->end()
                        ->scalarNode('pseudo_random_string_generator')
                            ->defaultNull()
                        ->end()
                        ->scalarNode('url_detection_handler')
                            ->defaultNull()
                        ->end()
                    ->end()
                ->end()
            ->end()
            ->validate()
                ->ifTrue(function ($value) {
                    return $value['enabled'] && !isset($value['config']);
                })
                ->thenInvalid(self::INVALID_SDK_CONFIG)
            ->end();

        return $rootNode;
    }

    /**
     * Gets ADS SDK basic configuration.
     *
     * @return \Symfony\Component\Config\Definition\Builder\NodeDefinition
     */
    private function getAdsNode()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ads');

        $rootNode
            ->isRequired()
            ->canBeDisabled()
            ->children()
                ->arrayNode('config')
                    ->children()
                        ->scalarNode('app_id')
                            ->cannotBeEmpty()
                            ->isRequired()
                        ->end()
                        ->scalarNode('app_secret')
                            ->cannotBeEmpty()
                            ->isRequired()
                        ->end()
                        ->scalarNode('default_access_token')
                            ->defaultNull()
                        ->end()
                        ->scalarNode('default_graph_version')
                            ->cannotBeEmpty()
                            ->defaultValue('v'.Api::VERSION)
                            ->validate()
                                ->ifTrue(function ($value) {
                                    return !preg_match('/^v\d.\d$/', $value);
                                })
                                ->thenInvalid(self::INVALID_VERSION)
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('options')
                    ->children()
                        ->booleanNode('use_implicit_fetch')
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
            ->end()
            ->validate()
                ->ifTrue(function ($value) {
                    return $value['enabled'] && !isset($value['config']);
                })
                ->thenInvalid(self::INVALID_SDK_CONFIG)
            ->end();

        return $rootNode;
    }
}
