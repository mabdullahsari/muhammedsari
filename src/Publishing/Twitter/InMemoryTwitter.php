<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Domain\Contracts\Publishing\Twitter\Tweet;
use Domain\Contracts\Publishing\Twitter\Twitter;

final class InMemoryTwitter implements Twitter
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
