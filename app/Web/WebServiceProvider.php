<?php declare(strict_types=1);

namespace App\Web;

use App\Web\Providers\RouteServiceProvider;
use Illuminate\Support\AggregateServiceProvider;

final class WebServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Spatie\Feed\FeedServiceProvider::class,

        RouteServiceProvider::class,
    ];
}
