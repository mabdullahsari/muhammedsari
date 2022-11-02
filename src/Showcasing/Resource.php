<?php declare(strict_types=1);

namespace Domain\Showcasing;

use Dive\Eloquent\DisablesTimestamps;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $category
 * @property int    $id
 * @property string $name
 * @property int    $sort
 */
final class Resource extends Model
{
    use DisablesTimestamps;

    protected $fillable = ['category', 'name', 'sort'];
}
