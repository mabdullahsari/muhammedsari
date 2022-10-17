<?php declare(strict_types=1);

namespace Domain\Blogging;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property string|null $content
 * @property Carbon|null $published_at
 * @property string      $slug
 * @property PostState   $state
 * @property string|null $summary
 * @property string      $title
 */
final class Post extends Model
{
    protected $attributes = [
        'state' => PostState::Draft,
    ];

    protected $casts = [
        'state' => PostState::class,
    ];

    protected $fillable = ['content', 'slug', 'summary', 'title'];

    public function isDraft(): bool
    {
        return $this->state->isDraft();
    }
}
