<?php declare(strict_types=1);

namespace App\Web;

use Illuminate\Support\AggregateServiceProvider;

final class WebServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\RouteAttributes\RouteAttributesServiceProvider::class,

        View\ViewServiceProvider::class,

        About\AboutServiceProvider::class,
        Blog\BlogServiceProvider::class,
        Home\HomeServiceProvider::class,
        OSS\OSSServiceProvider::class,
        Tags\TagsServiceProvider::class,
        Uses\UsesServiceProvider::class,
    ];
}
