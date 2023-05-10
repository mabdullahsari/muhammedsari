<?php declare(strict_types=1);

namespace Blogging;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

final readonly class AppendTwitterEngagementUrl implements ShouldQueue
{
    use Dispatchable;

    private const TEMPLATE = <<<TEXT
    [Join the discussion on Twitter!](%s) I'd love to know what you thought about this blog post.

    Thanks for reading!
    TEXT;

    public function __construct(
        private int $postId,
        private string $tweetUrl,
    ) {}

    public function handle(Post $model): void
    {
        $post = $model->find($this->postId);
        $post->appendToBody(sprintf(self::TEMPLATE, $this->tweetUrl));
        $post->save();
    }
}
