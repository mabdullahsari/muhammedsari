<?php declare(strict_types=1);

namespace Publishing\Twitter;

interface Twitter
{
    public function send(Tweet $tweet): TweetUrl;
}
