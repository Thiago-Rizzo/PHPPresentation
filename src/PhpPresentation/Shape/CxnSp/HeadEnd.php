<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class HeadEnd
{
    public string $type = '';
    public string $w = '';
    public string $len = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:headEnd', $node);
        if (!$element) {
            return null;
        }

        $headEnd = new self();

        $headEnd->type = $element->getAttribute('type');
        $headEnd->w = $element->getAttribute('w');
        $headEnd->len = $element->getAttribute('len');

        return $headEnd;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:headEnd');

        $this->type !== '' && $writer->writeAttribute('type', $this->type);
        $this->w !== '' && $writer->writeAttribute('w', $this->w);
        $this->len !== '' && $writer->writeAttribute('len', $this->len);

        $writer->endElement();
    }
}
