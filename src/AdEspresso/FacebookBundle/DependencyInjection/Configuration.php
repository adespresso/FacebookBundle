<?php

namespace AdEspresso\FacebookBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('facebook');

        $rootNode
            ->addDefaultsIfNotSet()
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
            ->addDefaultsIfNotSet()
            ->children()
                ->append($this->getConfigNode())
                ->arrayNode('options')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enable_beta_mode')
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $rootNode;
    }

    /**
     * Gets ads graph SDK basic configuration.
     *
     * @return \Symfony\Component\Config\Definition\Builder\NodeDefinition
     */
    private function getAdsNode()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ads');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->append($this->getConfigNode())
                ->arrayNode('options')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('use_implicit_fetch')
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $rootNode;
    }

    /**
     * Gets configuration shared between graphs.
     *
     * @return \Symfony\Component\Config\Definition\Builder\NodeDefinition
     */
    private function getConfigNode()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('config');

        $rootNode
            ->addDefaultsIfNotSet()
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
                ->scalarNode('cache_strategy')
                    ->defaultNull()
                ->end()
                ->scalarNode('default_graph_version')
                    ->cannotBeEmpty()
                    ->defaultValue('v2.7')
                    ->validate()
                        ->ifTrue(function ($value) {
                            return preg_match('/^v\d.\d$/', $value);
                        })
                        ->thenInvalid(self::INVALID_VERSION)
                    ->end()
                ->end()
            ->end();

        return $rootNode;
    }
}
