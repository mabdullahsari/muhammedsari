<?php declare(strict_types=1);

namespace App\Http\Admin\Blog;

use Filament\Actions\Action;
use Illuminate\Support\Facades\Bus;
use PreservingData\Contract\BackUpDatabase;

final class DatabaseBackup extends Action
{
    public static function getDefaultName(): string
    {
        return 'back-up-database';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->action(function () {
            Bus::dispatchSync(new BackUpDatabase());

            $this->success();
        });

        $this->color('gray');

        $this->successNotificationTitle('Database backed up 💾');

        $this->icon('heroicon-m-circle-stack');

        $this->visible(app()->isProduction());
    }
}
