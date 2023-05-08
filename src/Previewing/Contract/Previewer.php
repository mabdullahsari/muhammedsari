<?php declare(strict_types=1);

namespace Previewing\Contract;

interface Previewer
{
    public function get(string $text): Preview;
}
