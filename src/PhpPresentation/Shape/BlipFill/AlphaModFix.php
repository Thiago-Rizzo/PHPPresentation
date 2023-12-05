<?php

namespace PhpOffice\PhpPresentation\Shape\BlipFill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class AlphaModFix
{
    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:alphaModFix', $node);
        if (!$element) {
            return null;
        }

        return new self();
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:alphaModFix');
        $writer->endElement();
    }
}
