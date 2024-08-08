<?php

namespace PhpOffice\PhpPresentation\Shape;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Style\Color\EffectRef;
use PhpOffice\PhpPresentation\Style\Color\FillRef;
use PhpOffice\PhpPresentation\Style\Color\FontRef;
use PhpOffice\PhpPresentation\Style\Color\LnRef;

class Style
{
    protected ?LnRef $lnRef = null;
    protected ?FillRef $fillRef = null;
    protected ?EffectRef $effectRef = null;
    protected ?FontRef $fontRef = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('p:style', $node);
        if (!$dom) {
            return null;
        }

        $oStyle = new self();

        $oStyle->lnRef = LnRef::load($xmlReader, $dom);
        $oStyle->fillRef = FillRef::load($xmlReader, $dom);
        $oStyle->effectRef = EffectRef::load($xmlReader, $dom);
        $oStyle->fontRef = FontRef::load($xmlReader, $dom);

        return $oStyle;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('p:style');

        $this->lnRef !== null && $this->lnRef->write($writer);
        $this->fillRef !== null && $this->fillRef->write($writer);
        $this->effectRef !== null && $this->effectRef->write($writer);
        $this->fontRef !== null && $this->fontRef->write($writer);

        $writer->endElement();
    }
}
