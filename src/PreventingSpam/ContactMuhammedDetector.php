<?php declare(strict_types=1);

namespace PreventingSpam;

use Contacting\Contract\ContactMuhammed;
use PreventingSpam\Contract\PotentialSpam;

final readonly class ContactMuhammedDetector implements Detector
{
    public function __construct(
        private Analyzer $email,
        private Analyzer $message,
        private Analyzer $name,
    ) {}

    /** @param ContactMuhammed $message */
    public function detect(PotentialSpam $message): Result
    {
        return $this
            ->email->analyze($message->email)
            ->and($this->message, $message->message)
            ->and($this->name, $message->name);
    }
}
