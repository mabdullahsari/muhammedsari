<?php declare(strict_types=1);

namespace PreventingSpam;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $detection_method
 * @property string $message_type
 * @property string $message_value
 * @property DateTimeImmutable $quarantined_at
 */
final class QuarantinedMessageReadModel extends Model
{
    protected $table = QuarantinedMessageRepositoryUsingSQLite::TABLE;

    protected $casts = ['quarantined_at' => 'immutable_datetime'];
}
