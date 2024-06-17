<?php

namespace PhpOffice\PhpPresentation\Shape\RichText\Para;

use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use DOMElement;

class Ea
{
    public string $typeface = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:ea', $node);
        if (!$dom) {
            return null;
        }

        $latin = new self();

        $latin->typeface = $dom->getAttribute('typeface');

        return $latin;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:ea');

        $this->typeface != '' && $writer->writeAttribute('typeface', $this->typeface);

        $writer->endElement();
    }
}
