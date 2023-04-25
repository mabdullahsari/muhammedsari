<?php declare(strict_types=1);

namespace Identity;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

final class IdentityServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Relation::enforceMorphMap(['user' => User::class]);
    }
}
