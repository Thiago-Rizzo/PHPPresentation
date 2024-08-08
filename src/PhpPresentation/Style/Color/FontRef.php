<?php

namespace PhpOffice\PhpPresentation\Style\Color;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Style\Color;

class FontRef extends Ref
{
    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:fontRef', $node);
        if (!$dom) {
            return null;
        }

        $oRef = new self();

        $oRef->setIdx($dom->getAttribute('idx'));
        $oRef->setColor(Color::identify($xmlReader, $dom));

        return $oRef;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:fontRef');

        $this->idx !== '' && $writer->writeAttribute('idx', $this->idx);
        $this->color !== null && $this->color->write($writer);

        $writer->endElement();
    }
}
