<?php

declare(strict_types=1);

namespace Jupi007\PrestashopWebserviceBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Jupi007\PrestashopWebserviceBundle\Services\PrestashopWebservice;

class Jupi007PrestashopWebserviceExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../config')
        );
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $service = $container->getDefinition(PrestashopWebservice::class);
        $service->replaceArgument(0, $config['connection']['store_root_path']);
        $service->replaceArgument(1, $config['connection']['authentication_key']);
        $service->replaceArgument(2, $config['debug']);
    }
}