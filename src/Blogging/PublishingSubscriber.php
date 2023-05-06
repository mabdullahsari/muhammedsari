<?php declare(strict_types=1);

namespace Blogging;

use Illuminate\Contracts\Events\Dispatcher;
use Publishing\Contract\TweetSent;

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
