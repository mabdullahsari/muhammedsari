<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Domain\Publishing\Twitter\Contracts\Tweet;
use Domain\Publishing\Twitter\Contracts\Twitter;

final class TwitterUsingArray implements Twitter
{
    private array $outbox = [];

    public function outbox(): array
    {
        return $this->outbox;
    }

    public function send(Tweet $tweet): void
    {
        $this->outbox[] = $tweet;
    }
}
