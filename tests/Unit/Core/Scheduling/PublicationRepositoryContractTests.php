<?php declare(strict_types=1);

namespace Tests\Unit\Core\Scheduling;

use Scheduling\CouldNotFindPublication;
use Scheduling\PublicationRepository;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/** @mixin TestCase */
trait PublicationRepositoryContractTests
{
    use PublicationFactoryMethods;

    abstract private function getInstance(): PublicationRepository;

    #[Test]
    public function it_can_get_a_publication_by_its_post_id(): void
    {
        $repository = $this->getInstance();

        $publication = $repository->findByPost(1453);

        $this->assertSame(1453, $publication->postId);
    }

    #[Test]
    public function it_can_get_the_publications_due(): void
    {
        $repository = $this->getInstance();

        $publications = $repository->getDue($now = $this->now());

        $this->assertCount(2, $publications);
        $this->assertLessThan($now, $publications->first()->publishAt);
        $this->assertLessThan($now, $publications->last()->publishAt);
    }

    #[Test]
    public function it_can_find_and_remove_a_publication(): void
    {
        $repository = $this->getInstance();
        $publication = $repository->find(1);

        $repository->remove($publication);

        $this->expectException(CouldNotFindPublication::class);

        $repository->find(1);
    }
}
