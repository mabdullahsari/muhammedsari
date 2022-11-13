<?php declare(strict_types=1);

namespace App\Web;

use Illuminate\Support\AggregateServiceProvider;

final class WebServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\RouteAttributes\RouteAttributesServiceProvider::class,

        View\ViewServiceProvider::class,

        Feature\About\AboutServiceProvider::class,
        Feature\Blog\BlogServiceProvider::class,
        Feature\Home\HomeServiceProvider::class,
        Feature\OSS\OSSServiceProvider::class,
        Feature\Tag\TagServiceProvider::class,
        Feature\Uses\UsesServiceProvider::class,
    ];
}
