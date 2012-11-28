<?php

namespace Ivelazquez\Bundle\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ivelazquez_core');

        $rootNode
            ->children()
                ->arrayNode('server')
                    ->children()
                        ->scalarNode('logo')->end()
                        ->scalarNode('name')->isRequired()->end()
                        ->scalarNode('environment')->isRequired()->end()
                        ->scalarNode('ribbon_color')->isRequired()->end()
                    ->end()
                ->end()
                ->arrayNode('tools')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('name')->isRequired()->end()
                            ->scalarNode('icon')->end()
                            ->scalarNode('url')->end()
                            ->scalarNode('route')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('projects')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('name')->isRequired()->end()
                            ->scalarNode('icon')->end()
                            ->scalarNode('url')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
