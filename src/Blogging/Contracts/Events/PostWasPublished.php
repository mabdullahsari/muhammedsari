<?php declare(strict_types=1);

namespace Domain\Blogging\Contracts\Events;

use Dive\Utils\Makeable;
use Domain\Blogging\Post;

final class PostWasPublished
{
    use Makeable;

    private function __construct(
        private readonly Post $model,
    ) {}

    public function slug(): string
    {
        return (string) $this->model->slug;
    }

    public function title(): string
    {
        return $this->model->title;
    }
}
