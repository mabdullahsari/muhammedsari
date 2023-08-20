<?php declare(strict_types=1);

namespace Tests\Unit\Scheduling;

use Illuminate\Foundation\Auth\User;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Scheduling\PublicationPolicy;

final class PublicationPolicyTest extends TestCase
{
    #[Test]
    public function it_denies(): void
    {
        $policy = new PublicationPolicy();

        $result = $policy->deleteAny(new User());

        $this->assertFalse($result);
    }
}
