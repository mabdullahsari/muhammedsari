<?php declare(strict_types=1);

namespace Tests\Feature;

use Tests\KernelTestCase;

final class ExampleTest extends KernelTestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
