<?php declare(strict_types=1);

namespace PreventingSpam;

use PreventingSpam\Contract\PotentialSpam;

interface DetectorResolver
{
    public function resolve(PotentialSpam $command): Detector;
}
