<?php declare(strict_types=1);

namespace App\Http\Admin\Blog\Post;

use Blogging\Contract\PublishPost;
use Blogging\Post;
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
            Bus::dispatchSync(new PublishPost($record->id));

            $this->success();
        });

        $this->color('success');

        $this->modalHeading('Publish post');

        $this->modalButton('Publish');

        $this->successNotificationTitle('Post published 🚀');

        $this->requiresConfirmation();

        $this->icon('heroicon-s-globe');

        $this->authorize('publish');
    }
}
