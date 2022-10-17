<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Blogging;

use Domain\Blogging\Author;
use PHPUnit\Framework\TestCase;

final class AuthorTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_the_full_name_of_an_author(): void
    {
        $author = new Author([
           'first_name' => 'Muhammed',
           'last_name' => 'Sari',
        ]);

        $value = $author->full_name;

        $this->assertSame('Muhammed Sari', $value);
    }
}
