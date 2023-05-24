<?php declare(strict_types=1);

namespace PreventingSpam\Contract;

use PreventingSpam\InterceptCommandIfPotentialSpam;

final readonly class CommandBus
{
    public const MIDDLEWARE = InterceptCommandIfPotentialSpam::class;

    private function __construct() {}
}
