<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Blogging\Models;

use Domain\Blogging\Models\Post;
use Domain\Blogging\Models\PostPolicy;
use Domain\Blogging\PostState;
use Illuminate\Foundation\Auth\User;
use PHPUnit\Framework\TestCase;

final class PostPolicyTest extends TestCase
{
    /**
     * @dataProvider abilities
     * @test
     */
    public function it_allows_only_if_drafted(string $ability): void
    {
        $policy = new PostPolicy();

        $result = $policy->{$ability}(new User(), $model = new Post());
        $this->assertTrue($result);

        $model->setAttribute('state', PostState::Published);

        $result = $policy->{$ability}(new User(), $model);
        $this->assertFalse($result);
    }

    /** @test */
    public function it_denies(): void
    {
        $policy = new PostPolicy();

        $result = $policy->deleteAny(new User());

        $this->assertFalse($result);
    }

    private function abilities(): array
    {
        return [
            ['delete'],
            ['publish'],
        ];
    }
}
