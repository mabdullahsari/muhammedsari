<?php declare(strict_types=1);

namespace Domain\Showcasing;

final class RepositoryObserver
{
    public function creating(Repository $model): void
    {
        $model->sort = 1 + $model->newQuery()->max('id');
    }
}
