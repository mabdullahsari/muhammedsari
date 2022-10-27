<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

interface Twitter
{
    public function send(Tweet $tweet): void;
}
