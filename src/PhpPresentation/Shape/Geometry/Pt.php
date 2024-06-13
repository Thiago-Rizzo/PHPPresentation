<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Pt extends Sequential
{
    public string $x = '';
    public string $y = '';

    public static function load(XMLReader $xmlReader, DOMElement $node, int $sequence = 0): ?self
    {
        $dom = $xmlReader->getElement('a:pt', $node);
        if (!$dom) {
            return null;
        }

        return self::loadByElement($xmlReader, $dom, $sequence);
    }

    public static function loadByElement(XMLReader $xmlReader, DOMElement $node, int $sequence = 0): self
    {
        $pt = new self();
        $pt->x = $node->getAttribute('x');
        $pt->y = $node->getAttribute('y');
        $pt->sequence = $sequence;

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
