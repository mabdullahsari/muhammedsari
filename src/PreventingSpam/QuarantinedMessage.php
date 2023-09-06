<?php declare(strict_types=1);

namespace PreventingSpam;

use Clock\Contract\Clock;
use DateTimeImmutable;
use PreventingSpam\Contract\MessageQuarantined;
use SharedKernel\RecordsEvents;
use Webmozart\Assert\Assert;

final class QuarantinedMessage
{
    use RecordsEvents;

    private QuarantinedMessageId $id;

    private DetectionMethod $method;

    private Message $message;

    private DateTimeImmutable $quarantinedAt;

    private function __construct() {}

    public static function fromDatabase(array $data): self
    {
        $model = new self();
        $model->id = QuarantinedMessageId::fromInt($data['id']);
        $model->method = DetectionMethod::from($data['detection_method']);
        $model->message = Message::fromStrings($data['message_type'], $data['message_value']);

        Assert::notFalse($date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $data['quarantined_at']));

        $model->quarantinedAt = $date;

        return $model;
    }

    public static function quarantine(
        QuarantinedMessageId $id,
        DetectionMethod $method,
        Message $message,
        Clock $clock,
    ): self {
        $model = new self();
        $model->id = $id;
        $model->method = $method;
        $model->message = $message;
        $model->quarantinedAt = $clock->now();

        $model->recordThat(
            new MessageQuarantined($message->format($method), $model->quarantinedAt)
        );

        return $model;
    }

    public function reconstituteOriginalMessage(): object
    {
        return new ($this->message->type)(...json_decode($this->message->value, true));
    }

    public function toDatabase(): array
    {
        $message = $this->message->toArray();

        return [
            'id' => $this->id->asInt(),
            'detection_method' => $this->method->value,
            'message_type' => $message['type'],
            'message_value' => $message['value'],
            'quarantined_at' => $this->quarantinedAt->format('Y-m-d H:i:s'),
        ];
    }
}
