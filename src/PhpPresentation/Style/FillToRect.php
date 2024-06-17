<?php

namespace PhpOffice\PhpPresentation\Style;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class FillToRect
{
    public string $l = '';
    public string $t = '';
    public string $r = '';
    public string $b = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:fillToRect', $node);
        if (!$dom) {
            return null;
        }

        return self::loadByElement($xmlReader, $dom);
    }

    public static function loadByElement(XMLReader $xmlReader, DOMElement $node): self
    {
        $fillToRect = new self();
        $fillToRect->l = $node->getAttribute('l');
        $fillToRect->t = $node->getAttribute('t');
        $fillToRect->r = $node->getAttribute('r');
        $fillToRect->b = $node->getAttribute('b');

        return $fillToRect;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:fillToRect');

        $this->l !== '' && $writer->writeAttribute('l', $this->l);
        $this->t !== '' && $writer->writeAttribute('t', $this->t);
        $this->r !== '' && $writer->writeAttribute('r', $this->r);
        $this->b !== '' && $writer->writeAttribute('b', $this->b);

        $writer->endElement();
    }
}
