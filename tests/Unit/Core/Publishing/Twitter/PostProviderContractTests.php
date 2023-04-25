<?php declare(strict_types=1);

namespace Tests\Unit\Core\Publishing\Twitter;

use Publishing\Twitter\CouldNotFindPost;
use Publishing\Twitter\PublishedPostProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/** @mixin TestCase */
trait PostProviderContractTests
{
    abstract private function getInstance(): PublishedPostProvider;

    #[Test]
    public function it_can_get_a_post_by_id(): void
    {
        $provider = $this->getInstance();

        $post = $provider->getById(1);

        $this->assertSame($post->title, 'Never Gonna Give You Up');
        $this->assertSame($post->slug, 'never-gonna-give-you-up');
        $this->assertSame($post->tags, ['rick', 'roll']);
    }

    #[Test]
    public function it_throws_if_a_post_doesnt_exist(): void
    {
        $this->expectException(CouldNotFindPost::class);

        $provider = $this->getInstance();

        $provider->getById(22487238);
    }
}
