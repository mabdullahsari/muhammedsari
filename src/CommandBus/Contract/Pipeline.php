<?php declare(strict_types=1);

namespace CommandBus\Contract;

final class Pipeline
{
    private static array $pipes = [];

    public static function register(string $pipe): void
    {
        self::$pipes[] = $pipe;
    }

    public static function get(): array
    {
        return self::$pipes;
    }
}
