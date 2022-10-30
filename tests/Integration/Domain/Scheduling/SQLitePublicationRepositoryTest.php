<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Scheduling;

use Domain\Scheduling\PublicationMapper;
use Domain\Scheduling\PublicationRepository;
use Domain\Scheduling\SQLitePublicationRepository;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\KernelTestCase;
use Tests\Unit\Domain\Scheduling\PublicationRepositoryContractTests;

final class SQLitePublicationRepositoryTest extends KernelTestCase
{
    use PublicationRepositoryContractTests;
    use RefreshDatabase;

    private function getInstance(): PublicationRepository
    {
        return new SQLitePublicationRepository($this->setUpDatabase(), new PublicationMapper());
    }

    private function setUpDatabase(): SQLiteConnection
    {
        $db = $this->app['db.connection'];

        $db->table('publications')->insert([
            ['id' => 1, 'post_id' => 1453, 'publish_at' =>  $this->date('2022-10-30')],
            ['id' => 2, 'post_id' => 1454, 'publish_at' =>  $this->date('2022-10-29')],
            ['id' => 3, 'post_id' => 1455, 'publish_at' =>  $this->date('2022-10-28')],
            ['id' => 4, 'post_id' => 1456, 'publish_at' =>  $this->date('2022-10-27')],
        ]);

        return $db;
    }
}
