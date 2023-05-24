<?php declare(strict_types=1);

namespace PreventingSpam;

use PreventingSpam\Contract\PotentialSpam;

interface Detector
{
    public function detect(PotentialSpam $message): Result;
}
