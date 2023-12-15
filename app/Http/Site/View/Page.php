<?php declare(strict_types=1);

namespace App\Http\Site\View;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Page extends Component
{
    public const string NAME = 'page';
    private const string DELIMITER = ' - ';

    public function __construct(
        public readonly string $description,
        public readonly string $suffix,
        private readonly ?string $name = null,
    ) {}

    public function title(): string
    {
        return implode(self::DELIMITER, array_filter([$this->name, $this->suffix]));
    }

    public function render(): View
    {
        return $this->view('components.page');
    }
}
