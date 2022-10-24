<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\TestCase as TestCaseBase;
use Tests\CreatesApplication;

abstract class TestCase extends TestCaseBase
{
    use CreatesApplication;
}
