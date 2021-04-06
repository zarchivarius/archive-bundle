<?php
declare(strict_types=1);

namespace Zarchivarius\ArchiveBundle\Tests;

use PHPUnit\Framework\TestCase;
use Zarchivarius\ArchiveBundle\Services\ArchivariusService;

class FunctionalTest extends TestCase
{
    public function testServiceWiring(): void
    {
        $kernel = new ZarchivariusArchiveTestingKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();

        $archive = $container->get('zarchivarius_archive.services.archivarius_service');
        self::assertInstanceOf(ArchivariusService::class, $archive);
    }
}
