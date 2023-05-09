<?php declare(strict_types=1);

namespace App\UserInterface\Http\Horizon;

use Illuminate\Support\AggregateServiceProvider;
use Laravel\Horizon\Horizon;

final class HorizonServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Laravel\Horizon\HorizonServiceProvider::class,

        \App\UserInterface\Http\RouteServiceProvider::class,
    ];

    public function boot(): void
    {
        Horizon::$authUsing = new AuthorizeAccess();

        Horizon::night();
    }
}
