<?php
declare(strict_types=1);

namespace Zarchivarius\ArchiveBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('zarchivarius_archive');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->enumNode('storage')
                    ->values(['local'])
                    ->defaultValue('local')
                    ->info('Where to store the archive')
                ->end()
                ->scalarNode('location')
                    ->defaultValue('./var/archive')
                    ->info('The path to the archive in the storage')
                ->end()
            ->end();


        return $treeBuilder;
    }
}
