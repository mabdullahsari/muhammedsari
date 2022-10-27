<?php declare(strict_types=1);

namespace Tests\Integration\Domain\Identity;

use Domain\Identity\User;
use Domain\Identity\UserPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Relations\Relation;
use Tests\KernelTestCase;

final class ServiceBindingsTest extends KernelTestCase
{
    /** @test */
    public function it_registers_user_into_morph_map(): void
    {
        $model = Relation::getMorphedModel('user');

        $this->assertSame(User::class, $model);
    }

    /** @test */
    public function it_registers_user_policy_at_gate(): void
    {
        /** @var Gate $gate */
        $gate = $this->app->make(Gate::class);

        $this->assertInstanceOf(UserPolicy::class, $gate->getPolicyFor(User::class));
    }
}
