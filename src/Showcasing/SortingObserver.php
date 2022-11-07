<?php declare(strict_types=1);

namespace Core\Showcasing;

use Illuminate\Database\Eloquent\Model;

final readonly class SortingObserver
{
    public function creating(Model $model): void
    {
        $model->setAttribute('sort', 1 + $model->newQuery()->max($model->getKeyName()));
    }
}
