<?php

namespace PhpOffice\PhpPresentation\Style\Color;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class LumOff
{
    public string $val = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:lumOff', $node);
        if (!$dom) {
            return null;
        }

        $lumOff = new self();
        $lumOff->val = $dom->getAttribute('val');

        return $lumOff;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:lumOff');

        $this->val !== '' && $writer->writeAttribute('val', $this->val);

        $writer->endElement();
    }
}
