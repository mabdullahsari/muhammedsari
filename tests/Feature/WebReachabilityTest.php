<?php declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class WebReachabilityTest extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    #[DataProvider('pages')]
    #[Test]
    public function page_is_reachable(string $page): void
    {
        // Act
        $response = $this->get($page);

        // Assert
        $response->assertHeader('Content-Type', 'text/html; charset=UTF-8')->assertOk();
    }

    public static function pages(): array
    {
        return [
            ['about'],
            ['contact'],
            ['tags/hello-world'],
            ['tags'],
            [''],
        ];
    }
}
