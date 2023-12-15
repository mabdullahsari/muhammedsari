<?php declare(strict_types=1);

namespace App\Http\Site\View;

use Clock\Contract\Clock;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Footer extends Component
{
    public const string NAME = 'footer';

    public function __construct(
        public readonly string $name,
        private readonly Clock $clock,
    ) {}

    public function year(): string
    {
        return $this->clock->now()->format('Y');
    }

    public function render(): View
    {
        return $this->view('components.footer.index');
    }
}
