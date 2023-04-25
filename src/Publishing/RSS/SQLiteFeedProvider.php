<?php declare(strict_types=1);

namespace Publishing\RSS;

use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Collection;
use Publishing\Contract\FeedProvider;
use Spatie\Feed\FeedItem;

final readonly class SQLiteFeedProvider implements FeedProvider
{
    public function __construct(
        private SQLiteConnection $connection,
        private FeedItemMapper $mapper,
    ) {}

    /** @return Collection<int, FeedItem> */
    public function items(): Collection
    {
        return $this->connection
            ->table('posts')
            ->where('state', 'published')
            ->join('users', 'users.id', '=', 'author_id')
            ->get(['email', 'first_name', 'last_name', 'slug', 'summary', 'title', 'updated_at'])
            ->transform($this->mapper); // @phpstan-ignore-line
    }
}
