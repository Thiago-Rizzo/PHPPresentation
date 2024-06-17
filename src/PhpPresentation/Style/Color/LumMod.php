<?php

namespace PhpOffice\PhpPresentation\Style\Color;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class LumMod
{
    public string $val = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:lumMod', $node);
        if (!$dom) {
            return null;
        }

        $lumMod = new self();
        $lumMod->val = $dom->getAttribute('val');

        return $lumMod;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:lumMod');

        $this->val !== '' && $writer->writeAttribute('val', $this->val);

        $writer->endElement();
    }
}
