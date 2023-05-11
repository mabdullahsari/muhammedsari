<?php declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Console\Exception\ExceptionInterface;

final class Handler extends ExceptionHandler
{
    protected $dontReport = [ExceptionInterface::class];
}
