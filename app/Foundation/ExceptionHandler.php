<?php declare(strict_types=1);

namespace App\Foundation;

use Illuminate\Foundation\Exceptions\Handler;

final class ExceptionHandler extends Handler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
