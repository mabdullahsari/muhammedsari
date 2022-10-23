<?php declare(strict_types=1);

namespace Domain\Publishing\Twitter\Builder;

use Domain\Contracts\Publishing\Twitter\Tweet;
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

        return Tweet::make($tweet);
    }

    public function useEmoji(string $emoji): self
    {
        $this->emoji = $emoji;

        return $this;
    }

    public function useHashtags(array|string $tags): self
    {
        $tags = Arr::wrap($tags);

        foreach ($tags as $tag) {
            $this->tags[] = Hashtag::make($tag);
        }

        return $this;
    }

    public function useTitle(string $title): self
    {
        $this->title = Title::make($title);

        return $this;
    }

    public function useUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
