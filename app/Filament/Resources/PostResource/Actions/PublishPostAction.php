<?php declare(strict_types=1);

namespace App\Filament\Resources\PostResource\Actions;

use Domain\Blogging\Contracts\Commands\PublishPost;
use Domain\Blogging\Exceptions\CouldNotPublish;
use Domain\Blogging\Post;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Bus;

final class PublishPostAction extends Action
{
    public static function getDefaultName(): string
    {
        return 'publish';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->action(function (Post $record) {
            try {
                Bus::dispatch(PublishPost::make($record->id));

                $this->success();
            } catch (CouldNotPublish $ex) {
                $this->failureNotificationTitle($ex->getMessage());
                $this->sendFailureNotification();
            }
        });

        $this->modalHeading('Publish post');

        $this->modalButton('Publish');

        $this->successNotificationTitle('Post published 🚀');

        $this->requiresConfirmation();

        $this->icon('heroicon-s-eye');

        $this->authorize('publish');
    }
}
