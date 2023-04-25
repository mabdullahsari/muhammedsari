<?php declare(strict_types=1);

namespace Tests\Unit\Core\Blogging\Models;

use Core\Blogging\Models\Author;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AuthorTest extends TestCase
{
    #[Test]
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
