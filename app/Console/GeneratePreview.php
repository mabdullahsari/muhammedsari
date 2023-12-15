<?php declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Previewing\Contract\Preview;
use Previewing\Contract\Previewer;

final class GeneratePreview extends Command
{
    use WithValidatedInput;

    private const string FOLDER = 'open-graph';

    protected $signature = 'preview:generate';

    public function handle(Previewer $preview): int
    {
        $text = $this->input(
            message: 'Provide some text:',
            rules: ['required', 'string', 'min:2', 'max:100'],
            name: 'text',
        );

        $preview = $preview->get($text);

        $this->persist($preview, Str::slug($text));

        $this->info('💾  Preview saved!');

        return self::SUCCESS;
    }

    private function persist(Preview $preview, string $slug): void
    {
        $path = self::FOLDER . DIRECTORY_SEPARATOR . $slug . '.' . $preview->extension();

        $this->laravel['files']->put($this->laravel->publicPath($path), $preview->image);
    }
}
