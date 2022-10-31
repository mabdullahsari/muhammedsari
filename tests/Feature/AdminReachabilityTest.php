<?php declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Tests\KernelTestCase;

final class AdminReachabilityTest extends KernelTestCase
{
    /** @test */
    public function test_login_redirect(): void
    {
        $response = $this->get('admin');

        $response->assertRedirect('admin/login');
    }

    /**
     * @dataProvider pages
     * @test
     */
    public function test_page_is_reachable(string $page): void
    {
        $this->actingAs(
            UserFactory::new()->make()
        );

        $response = $this->get($page);

        $response->assertOk();
    }

    private function pages(): array
    {
        return [
            ['admin'],
            ['admin/posts'],
            ['admin/posts/create'],
            ['admin/tags'],
            ['admin/tags/create'],
            ['admin/publications'],
            ['admin/publications/schedule'],
            ['admin/users'],
            ['admin/application-health'],
        ];
    }
}
