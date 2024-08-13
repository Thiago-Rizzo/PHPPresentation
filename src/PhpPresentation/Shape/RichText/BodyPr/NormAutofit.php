<?php

namespace PhpOffice\PhpPresentation\Shape\RichText\BodyPr;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class NormAutofit
{
    public string $fontScale = '';
    public string $lnSpcReduction = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:normAutofit', $node);
        if (!$dom) {
            return null;
        }

        $normAutoFit = new self();

        $normAutoFit->fontScale = $dom->getAttribute('fontScale');
        $normAutoFit->lnSpcReduction = $dom->getAttribute('lnSpcReduction');

        return $normAutoFit;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:normAutofit');

        $this->fontScale !== '' && $writer->writeAttribute('fontScale', $this->fontScale);
        $this->lnSpcReduction !== '' && $writer->writeAttribute('lnSpcReduction', $this->lnSpcReduction);

        $writer->endElement();
    }

}
