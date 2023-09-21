<?php declare(strict_types=1);

namespace Blogging\Integration;

use Blogging\AppendTwitterEngagementUrl;
use Illuminate\Contracts\Events\Dispatcher;
use Publishing\Twitter\Contract\TweetSent;

final readonly class PublishingSubscriber
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(TweetSent::class, $this->whenTweetSent(...));
    }

    private function whenTweetSent(TweetSent $event): void
    {
        AppendTwitterEngagementUrl::dispatch($event->postId, $event->tweetUrl);
    }
}
