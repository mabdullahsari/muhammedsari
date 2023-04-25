<?php declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\UserFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class AdminReachabilityTest extends KernelTestCase
{
    #[Test]
    public function login_redirect(): void
    {
        // Act
        $response = $this->get('admin');

        // Assert
        $response->assertRedirect('admin/login');
    }

    #[DataProvider('pages')]
    #[Test]
    public function page_is_reachable(string $page): void
    {
        // Arrange
        $this->actingAs(
            UserFactory::new()->make()
        );

        // Act
        $response = $this->get($page);

        // Assert
        $response->assertOk();
    }

    public static function pages(): array
    {
        return [
            ['admin'],
            ['admin/blog/posts'],
            ['admin/blog/posts/create'],
            ['admin/blog/tags'],
            ['admin/blog/tags/create'],
            ['admin/health'],
            ['admin/schedule/publications'],
            ['admin/schedule/publications/create'],
            ['admin/showcase/repositories'],
            ['admin/showcase/repositories/create'],
            ['admin/showcase/resources'],
            ['admin/showcase/resources/create'],
        ];
    }
}
