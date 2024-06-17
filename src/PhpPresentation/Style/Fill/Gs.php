<?php

namespace PhpOffice\PhpPresentation\Style\Fill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Style\SchemeColor;

class Gs
{
    public ?SchemeColor $schemeClr = null;
    public string $pos = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:gs', $node);
        if (!$dom) {
            return null;
        }

        return self::loadByElement($xmlReader, $dom);
    }

    public static function loadByElement(XMLReader $xmlReader, DOMElement $node): self
    {
        $gs = new self();

        $gs->pos = $node->getAttribute('pos');

        $gs->schemeClr = SchemeColor::load($xmlReader, $node);

        return $gs;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:gs');

        $this->pos !== '' && $writer->writeAttribute('pos', $this->pos);

        $this->schemeClr && $this->schemeClr->write($writer);

        $writer->endElement();
    }
}
