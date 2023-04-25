<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use SensitiveParameter;

final readonly class TwitterOAuth2 implements Twitter
{
    private TwitterOAuth $connection;

    public function __construct(
        #[SensitiveParameter] string $consumerKey,
        #[SensitiveParameter] string $consumerSecret,
        #[SensitiveParameter] string $accessToken,
        #[SensitiveParameter] string $accessTokenSecret,
    ) {
        $this->connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
        $this->connection->setApiVersion('2');
    }

    public function send(Tweet $tweet): void
    {
        $this->connection->post('tweets', ['text' => (string) $tweet], true);
    }
}
