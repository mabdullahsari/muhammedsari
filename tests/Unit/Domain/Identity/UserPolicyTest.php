<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Identity;

use Domain\Identity\User;
use Domain\Identity\UserPolicy;
use PHPUnit\Framework\TestCase;

final class UserPolicyTest extends TestCase
{
    /** @test */
    public function it_allows(): void
    {
        $policy = new UserPolicy();

        $result = $policy->viewAny(new User());

        $this->assertTrue($result);
    }

    /**
     * @dataProvider abilities
     * @test
     */
    public function it_denies(string $ability): void
    {
        $policy = new UserPolicy();

        $result = $policy->{$ability}(new User(), new User());

        $this->assertFalse($result);
    }

    private function abilities(): array
    {
        return [
            ['create'],
            ['delete'],
            ['deleteAny'],
            ['update'],
            ['view'],
        ];
    }
}