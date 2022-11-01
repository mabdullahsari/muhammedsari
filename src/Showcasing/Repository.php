<?php declare(strict_types=1);

namespace Domain\Showcasing;

use Dive\Eloquent\DisablesTimestamps;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $description
 * @property int    $id
 * @property string $name
 * @property int    $sort
 * @property string $url
 */
final class Repository extends Model
{
    use DisablesTimestamps;

    protected $fillable = ['description', 'name', 'sort', 'url'];
}
