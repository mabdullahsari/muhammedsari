<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\View;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Footer extends Component
{
    public const NAME = 'footer';

    private const LINKS = [];

    public function __construct(public readonly string $name) {}

    public function links(): array
    {
        return self::LINKS;
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
