<?php declare(strict_types=1);

namespace Domain\Blogging;

use Dive\Utils\Makeable;

final class PostWasPublished
{
    use Makeable;

    private function __construct(
        private readonly Post $model,
    ) {}

    public function id(): int
    {
        return $this->model->id;
    }
}
