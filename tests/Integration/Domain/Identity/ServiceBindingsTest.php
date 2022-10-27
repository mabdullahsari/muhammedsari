<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Identity;

use Domain\Identity\User;
use Domain\Identity\UserPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Relations\Relation;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

final class ServiceBindingsTest extends TestCase
{
    use CreatesApplication;

    /** @test */
    public function it_registers_user_into_morph_map(): void
    {
        $this->createApplication();

        $model = Relation::getMorphedModel('user');

        $this->assertSame(User::class, $model);
    }

    /** @test */
    public function it_registers_user_policy_at_gate(): void
    {
        $app = $this->createApplication();

        /** @var Gate $gate */
        $gate = $app->make(Gate::class);

        $this->assertInstanceOf(UserPolicy::class, $gate->getPolicyFor(User::class));
    }

    public static function tearDownAfterClass(): void
    {
        Relation::morphMap([], false);
    }
}
