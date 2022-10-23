<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Domain\Contracts\Publishing\Twitter\Tweet;
use Domain\Contracts\Publishing\Twitter\Twitter;
use Illuminate\Support\Manager;
use InvalidArgumentException;
use Spatie\LaravelRay\Ray;

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

    protected function createArrayDriver(): InMemoryTwitter
    {
        return new InMemoryTwitter();
    }

    protected function createOauth2Driver(): TwitterOAuth2
    {
        $config = $this->config->get('services.twitter.oauth2');

        if (! is_array($config)) {
            throw new InvalidArgumentException('Invalid Twitter configuration.');
        }

        return new TwitterOAuth2(
            $config['consumer_key'],
            $config['consumer_secret'],
            $config['access_token'],
            $config['access_token_secret'],
        );
    }

    protected function createRayDriver(): TwitterUsingRay
    {
        /** @var Ray $ray */
        $ray = $this->container->get(Ray::class);

        return new TwitterUsingRay($ray);
    }

    public function send(Tweet $tweet): void
    {
        /** @var Twitter $twitter */
        $twitter = $this->driver();

        $twitter->send($tweet);
    }
}
