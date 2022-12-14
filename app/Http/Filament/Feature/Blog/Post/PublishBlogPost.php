<?php declare(strict_types=1);

namespace App\Http\Filament\Feature\Blog\Post;

use Core\Blogging\CouldNotPublish;
use Core\Blogging\Models\Post;
use Core\Contract\Blogging\Command\PublishPost;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Bus;

final class PublishBlogPost extends Action
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
                Bus::dispatchSync(new PublishPost($record->id));

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
