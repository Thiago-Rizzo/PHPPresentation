<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Miter
{
    public string $lim = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:miter', $node);
        if (!$element) {
            return null;
        }

        $miter = new self();

        $miter->lim = $element->getAttribute('lim');

        return $miter;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:miter');

        $this->lim !== '' && $writer->writeAttribute('lim', $this->lim);

        $writer->endElement();
    }
}
