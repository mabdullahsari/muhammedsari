<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Identity;

use Domain\Identity\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_the_full_name_of_a_user(): void
    {
        $user = new User([
           'first_name' => 'Muhammed',
           'last_name' => 'Sari',
        ]);

        $value = $user->name;

        $this->assertSame('Muhammed Sari', $value);
    }

    /** @test */
    public function it_can_get_the_avatar_url(): void
    {
        $user = new User(['username' => 'mabdullahsari']);

        $value = $user->avatar;

        $this->assertSame('/img/mabdullahsari.jpg', $value);
    }
}
