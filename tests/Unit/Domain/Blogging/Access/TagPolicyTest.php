<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Blogging\Access;

use Domain\Blogging\Access\TagPolicy;
use Domain\Blogging\Models\Tag;
use Illuminate\Foundation\Auth\User;
use PHPUnit\Framework\TestCase;

final class TagPolicyTest extends TestCase
{
    /** @test */
    public function it_allows_only_if_there_are_no_posts_yet(): void
    {
        $policy = new TagPolicy();

        $result = $policy->delete(new User(), $model = new Tag());
        $this->assertTrue($result);

        $model->setAttribute('posts_count', 1);

        $result = $policy->delete(new User(), $model);
        $this->assertFalse($result);
    }

    /** @test */
    public function it_denies(): void
    {
        $policy = new TagPolicy();

        $result = $policy->deleteAny(new User());

        $this->assertFalse($result);
    }
}
