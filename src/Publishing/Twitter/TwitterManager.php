<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Illuminate\Support\Manager;
use InvalidArgumentException;

final class TwitterManager extends Manager implements Twitter
{
    public function getDefaultDriver(): string
    {
        $driver = $this->config->get('services.twitter.driver', 'array');

        if (! is_string($driver)) {
            throw new InvalidArgumentException('Invalid Twitter driver.');
        }

        return $driver;
    }

    protected function createArrayDriver(): TwitterUsingArray
    {
        return new TwitterUsingArray();
    }

    protected function createOauth2Driver(): TwitterUsingOAuth2
    {
        $config = $this->config->get('services.twitter');

        if (! is_array($config)) {
            throw new InvalidArgumentException('Invalid Twitter configuration.');
        }

        return new TwitterUsingOAuth2($config);
    }

    public function send(Tweet $tweet): void
    {
        /** @var Twitter $twitter */
        $twitter = $this->driver();

        $twitter->send($tweet);
    }
}
