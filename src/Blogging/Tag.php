<?php declare(strict_types=1);

namespace Domain\Blogging;

use Dive\Eloquent\DisablesTimestamps;
use Domain\Blogging\Casts\AsSlug;
use Domain\Blogging\ValueObjects\Slug;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string                $name
 * @property Collection<int, Post> $posts
 * @property Slug                  $slug
 */
final class Tag extends Model
{
    use DisablesTimestamps;

    protected $casts = ['slug' => AsSlug::class];

    protected $fillable = ['name', 'slug'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
