<?php declare(strict_types=1);

namespace Tests\Unit\Core\Blogging;

use Clock\FrozenClock;

trait PostFactoryMethods
{
    private function aClock(): FrozenClock
    {
        return new FrozenClock('2022-10-26 22:17:30');
    }
}
