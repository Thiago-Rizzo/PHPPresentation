<?php

namespace PhpOffice\PhpPresentation\Shape;

use PhpOffice\PhpPresentation\Style\Color;

class Style
{
    protected ?Color\LnRef $lnRef;
    protected ?Color\FillRef $fillRef;
    protected ?Color\EffectRef $effectRef;
    protected ?Color\FontRef $fontRef;

    public function __construct(
        $lnRef = null,
        $fillRef = null,
        $effectRef = null,
        $fontRef = null
    )
    {
        $this->lnRef = $lnRef;
        $this->fillRef = $fillRef;
        $this->effectRef = $effectRef;
        $this->fontRef = $fontRef;
    }

    public function getLnRef(): ?Color\LnRef
    {
        return $this->lnRef;
    }

    public function setLnRef(?Color\LnRef $lnRef): void
    {
        $this->lnRef = $lnRef;
    }

    public function getFillRef(): ?Color\FillRef
    {
        return $this->fillRef;
    }

    public function setFillRef(?Color\FillRef $fillRef): void
    {
        $this->fillRef = $fillRef;
    }

    public function getEffectRef(): ?Color\EffectRef
    {
        return $this->effectRef;
    }

    public function setEffectRef(?Color\EffectRef $effectRef): void
    {
        $this->effectRef = $effectRef;
    }

    public function getFontRef(): ?Color\FontRef
    {
        return $this->fontRef;
    }

    public function setFontRef(?Color\FontRef $fontRef): void
    {
        $this->fontRef = $fontRef;
    }
}
