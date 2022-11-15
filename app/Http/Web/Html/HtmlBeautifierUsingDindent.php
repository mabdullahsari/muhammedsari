<?php declare(strict_types=1);

namespace App\Http\Web\Html;

use Gajus\Dindent\Indenter;

final readonly class HtmlBeautifierUsingDindent implements HtmlBeautifier
{
    private Indenter $indenter;

    public function __construct()
    {
        $this->indenter = new Indenter();
    }

    public function beautify(string $html): string
    {
        return $this->indenter->indent($html);
    }
}
