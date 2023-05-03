<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Tags;

use Blogging\Contract\GetAllTags;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final readonly class ViewTagsController
{
    public const ROUTE = 'tags';

    public function __construct(private GetAllTags $tags, private Factory $view) {}

    public function __invoke(): View
    {
        return $this->view->make('tags', ['tags' => $this->tags->get()]);
    }
}
