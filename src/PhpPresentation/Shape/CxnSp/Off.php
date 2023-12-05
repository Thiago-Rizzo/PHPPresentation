<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Off
{
    public string $x = '';
    public string $y = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:off', $node);
        if (!$element) {
            return null;
        }

        $off = new self();

        $off->x = $element->getAttribute('x');
        $off->y = $element->getAttribute('y');

        return $off;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:off');

        $this->x !== '' && $writer->writeAttribute('x', $this->x);
        $this->y !== '' && $writer->writeAttribute('y', $this->y);

        $writer->endElement();
    }
}
