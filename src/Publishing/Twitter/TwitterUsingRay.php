<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Domain\Contracts\Publishing\Twitter\Tweet;
use Domain\Contracts\Publishing\Twitter\Twitter;
use Spatie\LaravelRay\Ray;

final class TwitterUsingRay implements Twitter
{
    public function __construct(
        private readonly Ray $ray,
    ) {}

    public function send(Tweet $tweet): void
    {
        $this->ray->send($tweet);
    }
}
