<?php declare(strict_types=1);

namespace Blogging;

use Exception;

final class CouldNotPublish extends Exception
{
    public static function becauseAlreadyPublished(): self
    {
        return new self('Post may not be published more than once.');
    }

    public static function becauseBodyIsMissing(): self
    {
        return new self('Post body may not be missing.');
    }

    public static function becauseSummaryIsMissing(): self
    {
        return new self('Post summary may not be missing.');
    }
}
