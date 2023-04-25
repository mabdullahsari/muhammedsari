<?php declare(strict_types=1);

namespace Blogging\Models;

use Blogging\PostState;
use Illuminate\Database\Eloquent\Builder;

final class MustBePublished
{
    public function __invoke(Builder $query): Builder
    {
        return $query->where('state', PostState::Published);
    }
}
