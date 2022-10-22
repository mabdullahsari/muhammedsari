<?php declare(strict_types=1);

namespace Domain\Blogging\Models;

use Dive\Eloquent\DisablesTimestamps;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string                $name
 * @property Collection<int, Post> $posts
 * @property string                $slug
 */
final class Tag extends Model
{
    use DisablesTimestamps;

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
