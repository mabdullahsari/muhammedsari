<?php declare(strict_types=1);

namespace Tests\Unit\Core\Publishing\Twitter;

use Publishing\Twitter\TweetBuilder;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TweetBuilderTest extends TestCase
{
    #[Test]
    public function it_can_build_a_structured_tweet(): void
    {
        $tweet = TweetBuilder::create('Rick Astley')
            ->useHashtags(['rick', 'rolled'])
            ->useUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ')
            ->useTitle('Never gonna give you up')
            ->useEmoji('🎵')
            ->get();

        $this->assertSame(<<<TWEET
        🎵 Rick Astley “Never gonna give you up”

        #rick #rolled

        https://www.youtube.com/watch?v=dQw4w9WgXcQ
        TWEET, (string) $tweet);
    }
}
