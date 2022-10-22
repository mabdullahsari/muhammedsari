<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use Domain\Contracts\Publishing\Twitter\Tweet;
use Domain\Contracts\Publishing\Twitter\Twitter;

final class TwitterOAuth2 implements Twitter
{
    private readonly TwitterOAuth $connection;

    public function __construct(
        string $consumerKey,
        string $consumerSecret,
        string $accessToken,
        string $accessTokenSecret,
    ) {
        $this->connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
        $this->connection->setApiVersion('2');
    }

    public function send(Tweet $tweet): void
    {
        $this->connection->post('tweets', $tweet->toArray(), true);
    }
}
