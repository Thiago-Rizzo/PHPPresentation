<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Pt
{
    public string $x = '';
    public string $y = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {

        $dom = $xmlReader->getElement('a:pt', $node);
        if (!$dom) {
            return null;
        }

        $pt = new self();
        $pt->x = $dom->getAttribute('x');
        $pt->y = $dom->getAttribute('y');

        return $pt;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:pt');
        $this->x !== '' && $writer->writeAttribute('x', $this->x);
        $this->y !== '' && $writer->writeAttribute('y', $this->y);
        $writer->endElement();
    }
}
