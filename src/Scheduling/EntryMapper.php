<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Carbon\CarbonImmutable;
use stdClass;

final class EntryMapper
{
    public function __invoke(stdClass $record): Entry
    {
        return $this->map($record);
    }

    public function map(stdClass $record): Entry
    {
        return Entry::make(
            (int) $record->id,
            (int) $record->post_id,
            CarbonImmutable::createFromFormat('Y-m-d H:i:s', $record->publish_at),
        );
    }
}
