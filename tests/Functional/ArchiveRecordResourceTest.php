<?php
declare(strict_types=1);

namespace Zarchivarius\ArchiveBundle\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ArchiveRecordResourceTest extends ApiTestCase
{
    /**
     * @throws TransportExceptionInterface
     */
    public function testCreateActiveRecord(): void
    {
        $client = self::createClient();

        $client->request('POST', '/api/records', [
            'json' => []
        ]);
        self::assertResponseStatusCodeSame(201);
    }
}
