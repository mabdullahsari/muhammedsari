<?php declare(strict_types=1);

namespace Tests\Unit\Core\Blogging;

use Blogging\AuthorId;
use Blogging\Body;
use Blogging\Post;
use Blogging\PostId;
use Blogging\Slug;
use Blogging\Summary;
use Blogging\Title;
use Clock\FrozenClock;

trait PostFactoryMethods
{
    private function aPost(array $overrides = []): Post
    {
        $attributes = $overrides + [
            'authorId' => AuthorId::fromInt(1),
            'id' => PostId::fromInt(1),
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
