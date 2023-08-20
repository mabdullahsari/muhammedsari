<?php declare(strict_types=1);

namespace Tests\Unit\Blogging;

use Blogging\Post;
use Blogging\PostPolicy;
use Blogging\PostState;
use Illuminate\Foundation\Auth\User;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PostPolicyTest extends TestCase
{
    #[DataProvider('abilities')]
    #[Test]
    public function it_allows_only_if_drafted(string $ability): void
    {
        $policy = new PostPolicy();

        $result = $policy->{$ability}(new User(), $model = new Post());
        $this->assertTrue($result);

        $model->setAttribute('state', PostState::Published);

        $result = $policy->{$ability}(new User(), $model);
        $this->assertFalse($result);
    }

    #[Test]
    public function it_denies(): void
    {
        $policy = new PostPolicy();

        $result = $policy->deleteAny(new User());

        $this->assertFalse($result);
    }

    public static function abilities(): array
    {
        return [
            ['delete'],
            ['publish'],
        ];
    }
}
