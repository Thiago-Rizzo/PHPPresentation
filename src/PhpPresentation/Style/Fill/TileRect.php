<?php

namespace PhpOffice\PhpPresentation\Style\Fill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class TileRect
{
    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:tileRect', $node);
        if (!$dom) {
            return null;
        }

        return new self();
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:tileRect');
        $writer->endElement();
    }
}
