<?php declare(strict_types=1);

namespace App\Web;

use Illuminate\Support\AggregateServiceProvider;

final class WebServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\RouteAttributes\RouteAttributesServiceProvider::class,

        About\AboutServiceProvider::class,
        Blog\BlogServiceProvider::class,
        Home\HomeServiceProvider::class,
        OSS\OSSServiceProvider::class,
        Tag\TagServiceProvider::class,
        Uses\UsesServiceProvider::class,
        View\ViewServiceProvider::class,
    ];
}
