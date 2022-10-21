<?php declare(strict_types=1);

namespace Domain\Scheduling;

use Carbon\CarbonImmutable;
use stdClass;

final class Entry
{
    public readonly int $id;

    public readonly int $postId;

    public readonly CarbonImmutable $publishAt;

    private function __construct() {}

    public static function fromDatabase(stdClass $record): self
    {
        $entry = new Entry();

        $entry->id = (int) $record->id;
        $entry->postId = (int) $record->post_id;
        $entry->publishAt = CarbonImmutable::createFromFormat('Y-m-d H:i:s', $record->publish_at);

        return $entry;
    }
}
