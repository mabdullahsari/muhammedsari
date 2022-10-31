<?php declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

abstract class KernelTestCase extends TestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;
}
