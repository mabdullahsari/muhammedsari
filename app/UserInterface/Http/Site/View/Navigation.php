<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\View;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Fluent;
use Illuminate\View\Component;

final class Navigation extends Component
{
    public const NAME = 'navigation';

    private static array $items = [];

    public function __construct(
        public readonly string $home,
        public readonly string $name,
    ) {}

    public static function register(string $name, string $path, int $priority): void
    {
        self::$items[$priority] = new Fluent(['label' => $name, 'path' => $path]);
    }

    public function render(): View
    {
        return $this->view('components.navigation.index', ['items' => array_values(self::$items)]);
    }
}
