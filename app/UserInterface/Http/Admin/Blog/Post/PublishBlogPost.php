<?php declare(strict_types=1);

namespace App\UserInterface\Http\Admin\Blog\Post;

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
            Bus::dispatch(new PublishPost($record->id));

            $this->success();
        });

        $this->color('success');

        $this->modalHeading('Publish post');

        $this->modalButton('Publish');

        $this->successNotificationTitle('Post will be published shortly 🚀');

        $this->requiresConfirmation();

        $this->icon('heroicon-s-globe');

        $this->authorize('publish');
    }
}
