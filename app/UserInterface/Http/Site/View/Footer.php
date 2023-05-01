<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\View;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Fluent;
use Illuminate\View\Component;

final class Footer extends Component
{
    public const NAME = 'footer';

    private const LINKS = [
        ['label' => 'Twitter', 'url' => 'https://twitter.com/mabdullahsari'],
        ['label' => 'GitHub', 'url' => 'https://www.github.com/mabdullahsari'],
        ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/mabdullahsari/'],
        ['label' => 'RSS', 'url' => '/feed.atom'],
    ];

    public function __construct(public readonly string $name) {}

    public function links(): array
    {
        return array_map(static function (array $link) {
            $link['icon'] = strtolower($link['label']);

            return new Fluent($link);
        }, self::LINKS);
    }

    public function year(): string
    {
        return date('Y');
    }

    public function render(): View
    {
        return $this->view('components.footer.index');
    }
}
