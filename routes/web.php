<?php declare(strict_types=1);

use App\Web\AboutController;
use App\Web\HomeController;
use App\Web\PostController;
use App\Web\RepositoryController;
use App\Web\TagController;
use App\Web\ResourceController;
use Core\Blogging\Slug;
use Illuminate\Support\Facades\Route;

Route::get('about', AboutController::class)->name('about');

Route::get('blog/{slug}', [PostController::class, 'show'])->where('slug', Slug::PATTERN)->name('posts.show');
Route::get('blog', [PostController::class, 'index'])->name('posts.index');

Route::get('oss', [RepositoryController::class, 'index'])->name('repositories.index');

Route::get('tags/{slug}', [TagController::class, 'show'])->where('slug', Slug::PATTERN)->name('tags.show');
Route::get('tags', [TagController::class, 'index'])->name('tags.index');

Route::get('uses', [ResourceController::class, 'index'])->name('resources.index');

Route::get('', HomeController::class)->name('home');

Route::feeds();
