<?php

namespace PhpOffice\PhpPresentation\Shape\BlipFill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class SrcRect
{
    public string $t = '';
    public string $b = '';
    public string $l = '';
    public string $r = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:srcRect', $node);
        if (!$element) {
            return null;
        }

        $srcRect = new self();

        $srcRect->t = $element->getAttribute('t');
        $srcRect->b = $element->getAttribute('b');
        $srcRect->l = $element->getAttribute('l');
        $srcRect->r = $element->getAttribute('r');

        return $srcRect;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:srcRect');

        $this->t !== '' && $writer->writeAttribute('t', $this->t);
        $this->b !== '' && $writer->writeAttribute('b', $this->b);
        $this->l !== '' && $writer->writeAttribute('l', $this->l);
        $this->r !== '' && $writer->writeAttribute('r', $this->r);

        $writer->endElement();
    }
}
