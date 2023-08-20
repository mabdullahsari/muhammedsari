<?php declare(strict_types=1);

namespace Tests\Unit\Publishing;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Publishing\PostUrlGenerator;

final class PostUrlGeneratorTest extends TestCase
{
    #[Test]
    public function it_can_generate_a_blog_post_url_for_a_given_slug(): void
    {
        $generator = new PostUrlGenerator($hostAndScheme = 'https://localhost');

        $url = $generator->generate($slug = 'never-gonna-give-you-up');

        $this->assertSame("{$hostAndScheme}/{$slug}", $url);
    }
}
