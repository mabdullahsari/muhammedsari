<?php declare(strict_types=1);

namespace Publishing\RSS;

use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Collection;
use Publishing\RSS\Contract\FeedProvider;
use Spatie\Feed\FeedItem;

final readonly class SQLiteFeedProvider implements FeedProvider
{
    public function __construct(private SQLiteConnection $db, private FeedItemMapper $mapper) {}

    /** @return Collection<int, FeedItem> */
    public function items(): Collection
    {
        return $this->db
            ->table('blogging_posts')
            ->where('state', 'published')
            ->join('identity_users', 'identity_users.id', '=', 'author_id')
            ->get(['email', 'first_name', 'last_name', 'slug', 'summary', 'title', 'updated_at'])
            ->transform($this->mapper); // @phpstan-ignore-line
    }
}
