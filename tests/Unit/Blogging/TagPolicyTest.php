<?php declare(strict_types=1);

namespace Tests\Unit\Blogging;

use Blogging\Tag;
use Blogging\TagPolicy;
use Illuminate\Foundation\Auth\User;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TagPolicyTest extends TestCase
{
    #[Test]
    public function it_allows_only_if_there_are_no_posts_yet(): void
    {
        $policy = new TagPolicy();

        $result = $policy->delete(new User(), $model = new Tag());
        $this->assertTrue($result);

        $model->setAttribute('posts_count', 1);

        $result = $policy->delete(new User(), $model);
        $this->assertFalse($result);
    }

    #[Test]
    public function it_denies(): void
    {
        $policy = new TagPolicy();

        $result = $policy->deleteAny(new User());

        $this->assertFalse($result);
    }
}
