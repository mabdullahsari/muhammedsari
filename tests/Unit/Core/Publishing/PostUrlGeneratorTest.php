<?php declare(strict_types=1);

namespace Tests\Unit\Core\Publishing;

use Core\Publishing\PostUrlGenerator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PostUrlGeneratorTest extends TestCase
{
    #[Test]
    public function it_can_generate_a_blog_post_url_for_a_given_slug(): void
    {
        $generator = new PostUrlGenerator($hostAndScheme = 'https://localhost');

        $url = $generator->generate($slug = 'never-gonna-give-you-up');

        $this->assertSame("{$hostAndScheme}/blog/{$slug}", $url);
    }
}
