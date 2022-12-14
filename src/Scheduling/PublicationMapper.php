<?php declare(strict_types=1);

namespace Core\Scheduling;

use Carbon\CarbonImmutable;
use stdClass;

final readonly class PublicationMapper
{
    public function __invoke(stdClass $record): Publication
    {
        return $this->map($record);
    }

    public function map(stdClass $record): Publication
    {
        return new Publication(
            (int) $record->id,
            (int) $record->post_id,
            CarbonImmutable::createFromFormat('Y-m-d H:i:s', $record->publish_at),
        );
    }
}
