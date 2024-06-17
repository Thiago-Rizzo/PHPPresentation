<?php

namespace PhpOffice\PhpPresentation\Shape\RichText\Para;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Latin
{
    public string $typeface = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:latin', $node);
        if (!$dom) {
            return null;
        }

        $latin = new self();

        $latin->typeface = $dom->getAttribute('typeface');

        return $latin;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:latin');

        $this->typeface != '' && $writer->writeAttribute('typeface', $this->typeface);

        $writer->endElement();
    }
}
