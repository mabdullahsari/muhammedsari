<?php declare(strict_types=1);

namespace Domain\Blogging;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
        Tag::class => TagPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
