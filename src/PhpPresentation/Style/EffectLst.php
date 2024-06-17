<?php

namespace PhpOffice\PhpPresentation\Style;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class EffectLst
{
    public ?OuterShdw $outerShdw = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:effectLst', $node);
        if (!$dom) {
            return null;
        }

        $element = new self();

        $element->outerShdw = OuterShdw::load($xmlReader, $dom);

        return $element;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:effectLst');

        $this->outerShdw && $this->outerShdw->write($writer);

        $writer->endElement();
    }
}
