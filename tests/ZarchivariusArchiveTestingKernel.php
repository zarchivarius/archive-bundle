<?php
declare(strict_types=1);

namespace Zarchivarius\ArchiveBundle\Tests;

use Exception;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Zarchivarius\ArchiveBundle\ArchiveBundle;

class ZarchivariusArchiveTestingKernel extends Kernel
{

    public function registerBundles()
    {
        return [new ArchiveBundle()];
    }

    /**
     * @param LoaderInterface $loader
     * @throws Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config.xml', 'xml');
    }
}
