<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter\Contracts;

use Domain\Publishing\Twitter\Tweet;

interface Twitter
{
    public function send(Tweet $tweet): void;
}
