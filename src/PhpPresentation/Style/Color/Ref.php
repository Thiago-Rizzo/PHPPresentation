<?php

namespace PhpOffice\PhpPresentation\Style\Color;

use PhpOffice\PhpPresentation\Style\SchemeColor;

abstract class Ref
{
    protected ?string $idx = null;
    protected ?SchemeColor $schemeClr = null;

    public function __construct(?string $idx = null, ?SchemeColor $schemeClr = null)
    {
        $this->idx = $idx;
        $this->schemeClr = $schemeClr;
    }

    public function getIdx(): ?string
    {
        return $this->idx;
    }

    public function setIdx(?string $idx): void
    {
        $this->idx = $idx;
    }

    public function getSchemeClr(): ?SchemeColor
    {
        return $this->schemeClr;
    }

    public function setSchemeClr(?SchemeColor $schemeClr): void
    {
        $this->schemeClr = $schemeClr;
    }
}
