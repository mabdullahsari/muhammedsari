<?php declare(strict_types=1);

namespace Domain\Publishing\RSS;

use Domain\Publishing\RSS\Contracts\FeedRepository;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Collection;
use Spatie\Feed\FeedItem;

final class DatabaseFeedRepository implements FeedRepository
{
    public function __construct(
        private readonly ConnectionInterface $db,
        private readonly FeedItemMapper $mapper,
    ) {}

    /** @return Collection<int, FeedItem> */
    public function items(): Collection
    {
        return $this->db
            ->table('posts')
            ->where('state', 'published')
            ->join('users', 'users.id', '=', 'author_id')
            ->get(['email', 'first_name', 'last_name', 'slug', 'summary', 'title', 'updated_at'])
            ->transform($this->mapper); // @phpstan-ignore-line
    }
}
