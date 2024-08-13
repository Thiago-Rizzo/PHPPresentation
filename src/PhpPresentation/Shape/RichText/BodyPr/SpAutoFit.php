<?php

namespace PhpOffice\PhpPresentation\Shape\RichText\BodyPr;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class SpAutoFit
{
    public string $fontScale = '';
    public string $lnSpcReduction = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:spAutoFit', $node);
        if (!$dom) {
            return null;
        }

        $spAutoFit = new self();

        $spAutoFit->fontScale = $dom->getAttribute('fontScale');
        $spAutoFit->lnSpcReduction = $dom->getAttribute('lnSpcReduction');

        return $spAutoFit;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:spAutoFit');

        $this->fontScale !== '' && $writer->writeAttribute('fontScale', $this->fontScale);
        $this->lnSpcReduction !== '' && $writer->writeAttribute('lnSpcReduction', $this->lnSpcReduction);

        $writer->endElement();
    }
}
