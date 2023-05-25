<?php declare(strict_types=1);

namespace PreventingSpam;

use Illuminate\Contracts\Support\Arrayable;
use PreventingSpam\Contract\PotentialSpam;
use Webmozart\Assert\Assert;

final readonly class Message implements Arrayable
{
    public string $type;

    public string $value;

    private function __construct(string $type, string $value)
    {
        Assert::stringNotEmpty($type);
        Assert::stringNotEmpty($value);

        $this->type = $type;
        $this->value = $value;
    }

    public static function fromSpam(PotentialSpam $message): self
    {
        $value = json_encode($message);

        Assert::string($value);

        return new self($message::class, $value);
    }

    public static function fromStrings(string $type, string $value): self
    {
        return new self($type, $value);
    }

    public function format(DetectionMethod $method): string
    {
        return "[method] {$method->value} [type] {$this->type} [message] {$this->value}";
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
