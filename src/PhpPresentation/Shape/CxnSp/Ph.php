<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Ph
{
    public string $type = '';
    public string $sz = '';
    public string $idx = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('p:ph', $node);
        if (!$element) {
            return null;
        }

        $ph = new self();

        $ph->type = $element->getAttribute('type');
        $ph->sz = $element->getAttribute('sz');
        $ph->idx = $element->getAttribute('idx');

        return $ph;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('p:ph');

        $this->type !== '' && $writer->writeAttribute('type', $this->type);
        $this->sz !== '' && $writer->writeAttribute('sz', $this->sz);
        $this->idx !== '' && $writer->writeAttribute('idx', $this->idx);

        $writer->endElement();
    }
}
