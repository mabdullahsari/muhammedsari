<?php declare(strict_types=1);

namespace App\Http\Site\View;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Illuminate\View\Component;

final class Navigation extends Component
{
    public const string NAME = 'navigation';

    private static array $items = [];

    public function __construct(
        public readonly string $home,
        public readonly string $name,
        private readonly string $request,
    ) {}

    public static function register(string $name, string $path): void
    {
        self::$items[] = ['name' => $name, 'path' => $path];
    }

    public function items(): array
    {
        return array_map(fn (array $route) => new Fluent([
            'active' => Str::is("{$route['path']}*", $this->request),
            'label' => $route['name'],
            'url' => $this->home . DIRECTORY_SEPARATOR . $route['path'],
        ]), self::$items);
    }

    public function render(): View
    {
        return $this->view('components.navigation');
    }
}
