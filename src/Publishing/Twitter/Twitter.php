<?php declare(strict_types=1);

namespace Core\Publishing\Twitter;

interface Twitter
{
    public function send(Tweet $tweet): void;
}
