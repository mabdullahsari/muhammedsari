<?php declare(strict_types=1);

namespace Domain\Blogging\ValueObjects;

use Dive\Enum\Arrayable;
use Dive\Enum\Assertable;
use Dive\Enum\Comparable;

/**
 * @method bool isDraft()
 * @method bool isPublished()
 */
enum PostState: string
{
    use Assertable;
    use Arrayable;
    use Comparable;

    case Draft = 'draft';
    case Published = 'published';
}
