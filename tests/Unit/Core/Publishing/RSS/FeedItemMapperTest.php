<?php declare(strict_types=1);

namespace Tests\Unit\Core\Publishing\RSS;

use Core\Publishing\PostUrlGenerator;
use Core\Publishing\RSS\FeedItemMapper;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Spatie\Feed\FeedItem;

final class FeedItemMapperTest extends TestCase
{
    #[Test]
    public function it_can_map_to_a_feed_item_instance(): void
    {
        $url = new PostUrlGenerator('https://yolo.test');
        $mapper = new FeedItemMapper($url);

        $result = $mapper((object) [
            'email' => ($email = 'joske@gmail.com'),
            'first_name' => ($firstName = 'Jasper'),
            'last_name' => ($lastName = 'Moerens'),
            'slug' => ($slug = 'this-is-a-unit-test'),
            'summary' => ($summary = 'This is a unit test.'),
            'title' => ($title = 'This is a title.'),
            'updated_at' => ($updatedAt = '2022-10-26 00:41:00'),
        ]);

        $this->assertInstanceOf(FeedItem::class, $result);
        $this->assertSame($email, $result->authorEmail);
        $this->assertSame("{$firstName} {$lastName}", $result->authorName);
        $this->assertSame($url->generate($slug), $result->link);
        $this->assertSame($summary, $result->summary);
        $this->assertSame($title, $result->title);
        $this->assertEquals($updatedAt, $result->updated);
    }
}
