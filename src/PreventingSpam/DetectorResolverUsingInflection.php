<?php declare(strict_types=1);

namespace PreventingSpam;

use Illuminate\Contracts\Container\Container;
use PreventingSpam\Contract\PotentialSpam;
use RuntimeException;

final readonly class DetectorResolverUsingInflection implements DetectorResolver
{
    private const string NAMESPACE = 'PreventingSpam\\';
    private const string SUFFIX = 'Detector';

    public function __construct(private Container $container) {}

    public function resolve(PotentialSpam $command): Detector
    {
        $detector = self::NAMESPACE . class_basename($command) . self::SUFFIX;

        if (! class_exists($detector)) {
            throw new RuntimeException("The detector '{$detector}' does not exist. Did you make a typo or forget to add it?");
        }

        $instance = $this->container->get($detector);

        if (! $instance instanceof Detector) {
            throw new RuntimeException("'{$detector}' is not a valid Detector.");
        }

        return $instance;
    }
}
