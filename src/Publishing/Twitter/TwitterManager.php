<?php declare(strict_types=1);

namespace Publishing\Twitter;

use Illuminate\Log\Logger;
use Illuminate\Support\Manager;
use Webmozart\Assert\Assert;

final class TwitterManager extends Manager implements Twitter
{
    public function getDefaultDriver(): string
    {
        $driver = $this->config->get('publishing.twitter.driver', 'array');

        Assert::string($driver);

        return $driver;
    }

    protected function createArrayDriver(): ArrayTwitter
    {
        return new ArrayTwitter();
    }

    protected function createLogDriver(): LogTwitter
    {
        /** @var Logger $logger */
        $logger = $this->container->get('log');

        return new LogTwitter($logger);
    }

    protected function createOAuth2Driver(): TwitterOAuth2
    {
        $config = $this->config->get('publishing.twitter.oauth2');

        Assert::isArray($config);

        return new TwitterOAuth2(
            $config['consumer_key'],
            $config['consumer_secret'],
            $config['access_token'],
            $config['access_token_secret'],
        );
    }

    public function send(Tweet $tweet): TweetUrl
    {
        /** @var Twitter $twitter */
        $twitter = $this->driver();

        return $twitter->send($tweet);
    }
}
