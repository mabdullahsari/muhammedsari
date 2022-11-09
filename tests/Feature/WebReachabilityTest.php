<?php declare(strict_types=1);

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Tests\KernelTestCase;

final class WebReachabilityTest extends KernelTestCase
{
    protected bool $seed = true;

    protected string $seeder = UserSeeder::class;

    /**
     * @dataProvider pages
     * @test
     */
    public function test_page_is_reachable(string $page): void
    {
        // Act
        $response = $this->get($page);

        // Assert
        $response->assertHeader('Content-Type', 'text/html; charset=UTF-8')->assertOk();
    }

    private function pages(): array
    {
        return [
            ['about'],
            ['blog'],
            ['oss'],
            ['tags/hello-world'],
            ['tags'],
            ['uses'],
            [''],
        ];
    }
}
