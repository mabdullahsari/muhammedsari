<?php declare(strict_types=1);

namespace App\Http\Site\View;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Psr\Clock\ClockInterface;

final class Footer extends Component
{
    public const NAME = 'footer';

    public function __construct(
        public readonly string $name,
        private readonly ClockInterface $clock,
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
