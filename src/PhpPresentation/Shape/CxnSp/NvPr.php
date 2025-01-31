<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class NvPr
{
    public ?Ph $ph = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('p:nvPr', $node);
        if (!$element) {
            return null;
        }

        $nvPr = new self();

        $nvPr->ph = Ph::load($xmlReader, $element);

        return $nvPr;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('p:nvPr');

        $this->ph && $this->ph->write($writer);

        $writer->endElement();
    }
}
