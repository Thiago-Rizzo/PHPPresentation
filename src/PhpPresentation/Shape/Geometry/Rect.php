<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Rect
{
    public string $l = 'l';
    public string $t = 't';
    public string $r = 'r';
    public string $b = 'b';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:rect', $node);
        if (!$dom) {
            return null;
        }

        $rect = new self();
        $rect->l = $dom->getAttribute('l');
        $rect->t = $dom->getAttribute('t');
        $rect->r = $dom->getAttribute('r');
        $rect->b = $dom->getAttribute('b');

        return $rect;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:rect');
        $writer->writeAttribute('l', $this->l);
        $writer->writeAttribute('t', $this->t);
        $writer->writeAttribute('r', $this->r);
        $writer->writeAttribute('b', $this->b);
        $writer->endElement();
    }
}
