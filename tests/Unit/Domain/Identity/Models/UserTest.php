<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Identity\Models;

use Domain\Identity\Models\User;
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
    public function it_can_get_the_filament_avatar_url(): void
    {
        $user = new User(['username' => 'mabdullahsari']);

        $value = $user->getFilamentAvatarUrl();

        $this->assertSame('https://unavatar.io/mabdullahsari', $value);
    }
}
