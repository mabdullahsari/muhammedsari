<?php declare(strict_types=1);

namespace Core\Publishing\Twitter;

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
