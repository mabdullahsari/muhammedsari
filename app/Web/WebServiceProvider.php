<?php declare(strict_types=1);

namespace App\Web;

use Illuminate\Support\AggregateServiceProvider;

final class WebServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\LaravelMarkdown\MarkdownServiceProvider::class,
        \Spatie\RouteAttributes\RouteAttributesServiceProvider::class,

        View\ViewServiceProvider::class,
    ];
}
