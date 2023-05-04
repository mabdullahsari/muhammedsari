<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\View;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Illuminate\View\Component;

final class Navigation extends Component
{
    public const NAME = 'navigation';

    private static array $items = [];

    public function __construct(
        public readonly string $home,
        public readonly string $name,
        private readonly string $request,
    ) {}

    public static function register(string $name, string $path): void
    {
        self::$items[] = new Fluent(['active' => false, 'label' => $name, 'path' => $path]);
    }

    private function activate(): void
    {
        foreach (self::$items as $item) {
            $item->active = Str::is("{$item->path}*", $this->request);
            $item->path = DIRECTORY_SEPARATOR . $item->path;
        }
    }

    public function render(): View
    {
        $this->activate();

        return $this->view('components.navigation.index', ['items' => self::$items]);
    }
}
