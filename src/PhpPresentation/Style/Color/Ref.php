<?php

namespace PhpOffice\PhpPresentation\Style\Color;

use PhpOffice\PhpPresentation\Style\Color;

abstract class Ref
{
    protected string $idx = '';
    protected ?Color $color = null;

    public function __construct(string $idx = '', ?Color $color = null)
    {
        $this->idx = $idx;
        $this->color = $color;
    }

    public function getIdx(): string
    {
        return $this->idx;
    }

    public function setIdx(string $idx = ''): void
    {
        $this->idx = $idx;
    }

    public function getColor(): ?Color
    {
        return $this->color;
    }

    public function setColor(?Color $color): void
    {
        $this->color = $color;
    }
}
