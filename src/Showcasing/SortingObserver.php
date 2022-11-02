<?php declare(strict_types=1);

namespace Domain\Showcasing;

use Illuminate\Database\Eloquent\Model;

final class SortingObserver
{
    public function creating(Model $model): void
    {
        $model->setAttribute('sort', 1 + $model->newQuery()->max($model->getKeyName()));
    }
}
