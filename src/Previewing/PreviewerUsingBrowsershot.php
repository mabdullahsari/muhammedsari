<?php declare(strict_types=1);

namespace Previewing;

use Illuminate\Contracts\View\Factory;
use Previewing\Contract\Preview;
use Previewing\Contract\Previewer;
use Spatie\Browsershot\Browsershot;

final readonly class PreviewerUsingBrowsershot implements Previewer
{
    private const HEIGHT = 630;
    private const TEMPLATE = 'previewing::template';
    private const WIDTH = 1200;

    public function __construct(private Factory $view, private string $host) {}

    public function get(string $text): Preview
    {
        $html = $this->view->make(self::TEMPLATE, [
            'host' => $this->host,
            'title' => $text,
        ])->render();

        $image = Browsershot::html($html)->windowSize(self::WIDTH, self::HEIGHT)->screenshot();

        $size = strlen($image);

        return Preview::png($image, $size);
    }
}
