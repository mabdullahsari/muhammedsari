<?php declare(strict_types=1);

namespace App\Web\Blog;

use Illuminate\Support\ServiceProvider;

final class BlogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(GetMyPosts::class, GetMyPostsUsingEloquent::class);
        $this->app->bind(GetSinglePost::class, GetSinglePostUsingEloquent::class);
    }
}
