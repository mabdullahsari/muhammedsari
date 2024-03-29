<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Psr\Log\LoggerInterface;

final readonly class LogTwitter implements Twitter
{
    public function __construct(private LoggerInterface $logger) {}

    public function send(Tweet $tweet): TweetUrl
    {
        $this->logger->debug($tweet);

        return TweetUrl::oneTwoThree();
    }
}
