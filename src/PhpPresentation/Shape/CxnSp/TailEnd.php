<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class TailEnd
{
    public string $type = '';
    public string $w = '';
    public string $len = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:tailEnd', $node);
        if (!$element) {
            return null;
        }

        $tailEnd = new self();

        $tailEnd->type = $element->getAttribute('type');
        $tailEnd->w = $element->getAttribute('w');
        $tailEnd->len = $element->getAttribute('len');

        return $tailEnd;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:tailEnd');

        $this->type !== '' && $writer->writeAttribute('type', $this->type);
        $this->w !== '' && $writer->writeAttribute('w', $this->w);
        $this->len !== '' && $writer->writeAttribute('len', $this->len);

        $writer->endElement();
    }
}
