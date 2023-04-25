<?php declare(strict_types=1);

namespace Blogging\Models;

use Illuminate\Database\Eloquent\Builder;

final class SortByPublicationDate
{
    public function __invoke(Builder $query): Builder
    {
        return $query->latest('published_at');
    }
}
