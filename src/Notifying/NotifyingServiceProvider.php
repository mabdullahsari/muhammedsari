<?php declare(strict_types=1);

namespace Notifying;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

final class NotifyingServiceProvider extends ServiceProvider
{
    public const NAME = 'notifying';

    public function boot(Dispatcher $events): void
    {
        $events->subscribe(ContactingSubscriber::class);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . DIRECTORY_SEPARATOR . self::NAME . '.php', self::NAME);

        $this->app->when(Muhammed::class)->needs('$email')->giveConfig('notifying.my_email');
    }
}
