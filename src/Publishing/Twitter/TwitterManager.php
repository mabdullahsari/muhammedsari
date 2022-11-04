<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Illuminate\Log\Logger;
use Illuminate\Support\Manager;
use Webmozart\Assert\Assert;

final class TwitterManager extends Manager implements Twitter
{
    public function getDefaultDriver(): string
    {
        $driver = $this->config->get('services.twitter.driver', 'array');

        Assert::string($driver);

        return $driver;
    }

    protected function createArrayDriver(): InMemoryTwitter
    {
        return new InMemoryTwitter();
    }

    protected function createLogDriver(): LogTwitter
    {
        /** @var Logger $logger */
        $logger = $this->container->get('log');

        return new LogTwitter($logger);
    }

    protected function createOAuth2Driver(): TwitterOAuth2
    {
        $config = $this->config->get('services.twitter.oauth2');

        Assert::isArray($config);

        return new TwitterOAuth2($config['consumer_key'], $config['consumer_secret'], $config['access_token'], $config['access_token_secret']);
    }

    public function send(Tweet $tweet): void
    {
        /** @var Twitter $twitter */
        $twitter = $this->driver();

        $twitter->send($tweet);
    }
}
