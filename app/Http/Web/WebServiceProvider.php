<?php declare(strict_types=1);

namespace App\Http\Web;

use Illuminate\Support\AggregateServiceProvider;

final class WebServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\Feed\FeedServiceProvider::class,
        \Spatie\RouteAttributes\RouteAttributesServiceProvider::class,

        RouteServiceProvider::class,
        Html\HtmlServiceProvider::class,
        View\ViewServiceProvider::class,

        Feature\About\AboutServiceProvider::class,
        Feature\Blog\BlogServiceProvider::class,
        Feature\Home\HomeServiceProvider::class,
        Feature\Tag\TagServiceProvider::class,
    ];
}
