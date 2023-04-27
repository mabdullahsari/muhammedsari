<?php declare(strict_types=1);

namespace Blogging\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string     $name
 * @property Collection $posts
 * @property int        $posts_count
 * @property string     $slug
 */
final class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    protected $table = 'blogging_tags';

    public $timestamps = false;

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'blogging_post_tag');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
