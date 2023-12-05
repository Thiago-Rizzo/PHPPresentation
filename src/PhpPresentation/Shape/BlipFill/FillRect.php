<?php

namespace PhpOffice\PhpPresentation\Shape\BlipFill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class FillRect
{
    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:fillRect', $node);
        if (!$element) {
            return null;
        }

        return new self();
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:fillRect');

        $writer->endElement();
    }
}
