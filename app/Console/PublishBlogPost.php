<?php declare(strict_types=1);

namespace App\Console;

use Core\Contract\Blogging\Command\PublishPost;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Throwable;

final class PublishBlogPost extends Command
{
    use WithValidatedInput;

    protected $signature = 'blog:publish';

    public function handle(): int
    {
        $id = (int) $this->input(
            message: 'Provide an identifier:',
            rules: ['required', 'integer', 'exists:posts'],
            name: 'id',
        );

        try {
            Bus::dispatchSync(new PublishPost($id));

            $this->line("🚀 Blogpost{{$id}} published!");

            return self::SUCCESS;
        } catch (Throwable $th) {
            $this->error("🫠 {$th->getMessage()}");

            return self::FAILURE;
        }
    }
}
