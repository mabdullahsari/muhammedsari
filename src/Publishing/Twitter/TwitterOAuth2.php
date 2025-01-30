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
    }

    public function send(Tweet $tweet): TweetUrl
    {
        $response = $this->connection->post('tweets', ['text' => (string) $tweet], ['jsonPayload' => true]);

        return TweetUrl::fromId($response->data->id); // @phpstan-ignore-line
    }
}
