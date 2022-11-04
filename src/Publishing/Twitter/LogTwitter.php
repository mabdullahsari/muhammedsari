<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Psr\Log\LoggerInterface;

final readonly class LogTwitter implements Twitter
{
    public function __construct(
        private LoggerInterface $logger,
    ) {}

    public function send(Tweet $tweet): void
    {
        $this->logger->debug($tweet);
    }
}
