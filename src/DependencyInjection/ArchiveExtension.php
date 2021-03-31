<?php
declare(strict_types=1);

namespace Zarchivarius\ArchiveBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class ArchiveExtension extends Extension
{

    /**
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);

        if (!$configuration) {
            throw new Exception('Configuration not loaded');
        }

        $config = $this->processConfiguration($configuration, $configs);
        $definition = $container->getDefinition('zarchivarius_archive.services.archivarius_service');
        $definition->setArgument(0, $config['storage']);
        $definition->setArgument(1, $config['location']);
    }

    public function getAlias()
    {
        return 'zarchivarius_archive';
    }
}
