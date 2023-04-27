<?php declare(strict_types=1);

namespace Publishing\Twitter;

final class ArrayTwitter implements Twitter
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
