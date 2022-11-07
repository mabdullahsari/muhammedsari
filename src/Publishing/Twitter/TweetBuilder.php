<?php declare(strict_types=1);

namespace Core\Publishing\Twitter;

use Illuminate\Support\Arr;

final class TweetBuilder
{
    private ?string $emoji = null;

    private ?string $url = null;

    /** @var Hashtag[] */
    private array $tags = [];

    private ?Title $title = null;

    private function __construct(
        private readonly string $message,
    ) {}

    public static function create(string $message): self
    {
        return new self($message);
    }

    public function get(): Tweet
    {
        $text = array_filter([$this->emoji, $this->message, strval($this->title)]);
        $text = implode(' ', $text);

        $tags = array_map(strval(...), $this->tags);
        $tags = implode(' ', $tags);

        $tweet = array_filter([$text, $tags, $this->url]);
        $tweet = implode("\n\n", $tweet);

        return Tweet::fromString($tweet);
    }

    public function useEmoji(string $emoji): self
    {
        $that = clone $this;

        $that->emoji = $emoji;

        return $that;
    }

    public function useHashtags(array|string $tags): self
    {
        $that = clone $this;

        $tags = Arr::wrap($tags);

        foreach ($tags as $tag) {
            $that->tags[] = Hashtag::fromString($tag);
        }

        return $that;
    }

    public function useTitle(string $title): self
    {
        $that = clone $this;

        $that->title = Title::fromString($title);

        return $that;
    }

    public function useUrl(string $url): self
    {
        $that = clone $this;

        $that->url = $url;

        return $that;
    }
}
