<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Blogging;

use Domain\Blogging\CouldNotFindPost;
use Domain\Blogging\PostRepository;
use PHPUnit\Framework\TestCase;

/**
 * @mixin TestCase
 */
trait PostRepositoryContractTests
{
    use PostFactoryMethods;

    abstract private function getInstance(): PostRepository;

    /** @test */
    public function it_can_save_and_get_a_post_by_its_id(): void
    {
        $repository = $this->getInstance();

        $repository->save($postA = $this->aPost());

        $postB = $repository->find($postA->id());

        $this->assertEquals($postA, $postB);
    }

    /** @test */
    public function it_throws_if_a_post_cannot_be_found(): void
    {
        $this->expectException(CouldNotFindPost::class);

        $repository = $this->getInstance();

        $repository->find(272383273287);
    }
}
