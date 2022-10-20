<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter;

use Domain\Blogging\Contracts\Events\PostWasPublished;
use Illuminate\Contracts\Queue\ShouldQueue;

final class SendTweetAboutNewPost implements ShouldQueue
{
    public function __construct(
        private readonly Twitter $twitter,
    ) {}

    public function handle(PostWasPublished $event): void
    {
        $this->twitter->send(
            Tweet::make("✍️ I've just published: \"{$event->title()}\"")
        );
    }
}
