<?php

declare(strict_types=1);

namespace Jupi\PrestaShopWebserviceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('jupi_presta_shop_webservice');

        $treeBuilder->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('connection')
                    ->children()
                        ->scalarNode('store_root_path')
                            ->defaultValue('')
                        ->end()
                        ->scalarNode('authentication_key')
                            ->defaultValue('')
                        ->end()
                    ->end()
                ->end()
                ->booleanNode('debug')
                    ->defaultValue(false)
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
