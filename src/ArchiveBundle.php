<?php
declare(strict_types=1);

namespace Zarchivarius\ArchiveBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Zarchivarius\ArchiveBundle\DependencyInjection\ArchiveExtension;

class ArchiveBundle extends Bundle
{
    public function getContainerExtension()
    {
        if(null === $this->extension) {
            $this->extension = new ArchiveExtension();
        }
        return $this->extension;
    }
}
