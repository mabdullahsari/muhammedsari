<?php declare(strict_types=1);

namespace Domain\Contracts\Blogging\Events;

use Domain\Blogging\Models\Post;

final class PostWasDeleted
{
    public function __construct(
        private readonly Post $model,
    ) {}

    public function id(): int
    {
        return $this->model->id;
    }
}
