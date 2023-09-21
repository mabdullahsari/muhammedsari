<?php declare(strict_types=1);

namespace Publishing\Twitter\Contract;

final readonly class TweetSent
{
    public function __construct(
        public int $postId,
        public string $tweetUrl,
    ) {}
}
