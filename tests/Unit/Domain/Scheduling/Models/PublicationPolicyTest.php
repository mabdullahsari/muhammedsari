<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Scheduling\Models;

use Domain\Scheduling\Models\PublicationPolicy;
use Illuminate\Foundation\Auth\User;
use PHPUnit\Framework\TestCase;

final class PublicationPolicyTest extends TestCase
{
    /** @test */
    public function it_denies(): void
    {
        $policy = new PublicationPolicy();

        $result = $policy->deleteAny(new User());

        $this->assertFalse($result);
    }
}