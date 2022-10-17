<?php declare(strict_types=1);

namespace Domain\Identity;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\AggregateServiceProvider;

final class IdentityServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        AuthServiceProvider::class,
    ];

    public function boot(): void
    {
        Relation::enforceMorphMap(['user' => User::class]);
    }
}
