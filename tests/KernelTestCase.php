<?php declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as TestCaseBase;

abstract class KernelTestCase extends TestCaseBase
{
    use CreatesApplication;
}
