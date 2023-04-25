<?php declare(strict_types=1);

namespace App\Http\Web;

use Illuminate\Support\AggregateServiceProvider;

final class WebServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Html\HtmlServiceProvider::class,
        \Spatie\Feed\FeedServiceProvider::class,
        \Spatie\RouteAttributes\RouteAttributesServiceProvider::class,

        RouteServiceProvider::class,
        View\ViewServiceProvider::class,

        About\AboutServiceProvider::class,
        Blog\BlogServiceProvider::class,
        Home\HomeServiceProvider::class,
        Tag\TagServiceProvider::class,
    ];
}
