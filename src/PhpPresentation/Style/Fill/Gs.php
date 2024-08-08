<?php

namespace PhpOffice\PhpPresentation\Style\Fill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Style\Color;

class Gs
{
    public string $pos = '';
    public ?Color $color = null;

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

        $gs->color = Color::identify($xmlReader, $node);

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
