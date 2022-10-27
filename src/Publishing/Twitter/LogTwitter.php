<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Domain\Contracts\Publishing\Twitter\Tweet;
use Domain\Contracts\Publishing\Twitter\Twitter;
use Psr\Log\LoggerInterface;

final class LogTwitter implements Twitter
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    public function send(Tweet $tweet): void
    {
        $this->logger->debug($tweet);
    }
}
