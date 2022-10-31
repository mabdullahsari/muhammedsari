<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Scheduling;

use Carbon\CarbonImmutable;

trait PublicationFactoryMethods
{
    private function date(string $date): CarbonImmutable
    {
        return CarbonImmutable::createFromFormat('!Y-m-d', $date);
    }

    private function now(): CarbonImmutable
    {
        return $this->date('2022-10-29');
    }
}
