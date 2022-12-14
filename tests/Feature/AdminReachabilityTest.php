<?php declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Tests\KernelTestCase;

final class AdminReachabilityTest extends KernelTestCase
{
    /** @test */
    public function test_login_redirect(): void
    {
        // Act
        $response = $this->get('admin');

        // Assert
        $response->assertRedirect('admin/login');
    }

    /**
     * @dataProvider pages
     * @test
     */
    public function test_page_is_reachable(string $page): void
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

    private function pages(): array
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
