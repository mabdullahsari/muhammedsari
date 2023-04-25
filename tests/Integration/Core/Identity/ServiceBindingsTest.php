<?php declare(strict_types=1);

namespace Tests\Integration\Core\Identity;

use Core\Identity\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use PHPUnit\Framework\Attributes\Test;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    #[Test]
    public function it_registers_user_into_morph_map(): void
    {
        $model = Relation::getMorphedModel('user');

        $this->assertSame(User::class, $model);
    }
}
