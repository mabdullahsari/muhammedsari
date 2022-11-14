<?php declare(strict_types=1);

namespace Core\Blogging\Models;

use Core\Blogging\PostState;
use Illuminate\Database\Eloquent\Builder;

final class MustBePublished
{
    public function __invoke(Builder $query): Builder
    {
        return $query->where('state', PostState::Published);
    }
}
