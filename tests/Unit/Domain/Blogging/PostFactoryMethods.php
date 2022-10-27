<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Blogging;

use Domain\Blogging\Body;
use Domain\Blogging\Post;
use Domain\Blogging\Slug;
use Domain\Blogging\Summary;
use Domain\Blogging\Title;
use Domain\Clock\FrozenClock;

trait PostFactoryMethods
{
    private function aPost(array $overrides = []): Post
    {
        $attributes = $overrides + [
            'authorId' => 1,
            'id' => 1,
            'title' => Title::fromString('Never gonna give you up'),
            'slug' => Slug::fromString('never-gonna-give-you-up'),
            'body' => Body::fromString('Never gonna let you down'),
            'summary' => Summary::fromString('Never gonna turn around and desert you'),
        ];

        return Post::create(...$attributes);
    }

    private function aClock(): FrozenClock
    {
        return new FrozenClock('2022-10-26 22:17:30');
    }
}
