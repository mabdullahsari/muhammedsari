<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Scheduling;

use Domain\Scheduling\Publication;
use Domain\Scheduling\PublicationMapper;
use PHPUnit\Framework\TestCase;

final class PublicationMapperTest extends TestCase
{
    /** @test */
    public function it_can_map_to_a_publication_instance(): void
    {
        $mapper = new PublicationMapper();

        $result = $mapper->map((object) [
            'id' => ($id = 1453),
            'post_id' => ($postId = 2023),
            'publish_at' => ($publishAt = '2022-10-26 00:33:00'),
        ]);

        $this->assertInstanceOf(Publication::class, $result);
        $this->assertSame($id, $result->id);
        $this->assertSame($postId, $result->postId);
        $this->assertEquals($publishAt, $result->publishAt);
    }
}
