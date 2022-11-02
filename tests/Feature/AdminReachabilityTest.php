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
            ['admin/application-health'],
            ['admin/posts'],
            ['admin/posts/create'],
            ['admin/publications'],
            ['admin/publications/schedule'],
            ['admin/repositories'],
            ['admin/repositories/create'],
            ['admin/resources'],
            ['admin/resources/create'],
            ['admin/tags'],
            ['admin/tags/create'],
        ];
    }
}
