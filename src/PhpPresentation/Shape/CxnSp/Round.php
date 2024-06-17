<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Round
{
    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:round', $node);
        if (!$element) {
            return null;
        }

        return new self();
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:round');
        $writer->endElement();
    }
}
