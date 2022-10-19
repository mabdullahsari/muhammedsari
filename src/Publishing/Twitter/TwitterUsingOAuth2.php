<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

final class TwitterUsingOAuth2 implements Twitter
{
    private readonly TwitterOAuth $connection;

    private const PATH = 'tweets';

    public function __construct(array $config)
    {
        $this->connection = new TwitterOAuth(
            $config['consumer_key'],
            $config['consumer_secret'],
            $config['access_token'],
            $config['access_token_secret'],
        );

        $this->connection->setApiVersion('2');
    }

    public function send(Tweet $tweet): void
    {
        $this->connection->post(self::PATH, $tweet->toArray(), true);
    }
}
