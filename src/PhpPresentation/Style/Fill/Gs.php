<?php

namespace PhpOffice\PhpPresentation\Style\Fill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\SchemeColor;

class Gs
{
    public ?Color $color = null;
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

        $gs->color = SchemeColor::load($xmlReader, $node);

        return $gs;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:gs');

        $this->pos !== '' && $writer->writeAttribute('pos', $this->pos);

        $this->color && $this->color->write($writer);

        $writer->endElement();
    }
}
