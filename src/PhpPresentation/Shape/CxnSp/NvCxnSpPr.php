<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class NvCxnSpPr
{
    public ?CNvPr $cNvPr = null;

    public ?CNvCxnSpPr $cNvCxnSpPr = null;

    public ?NvPr $nvPr = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('p:nvCxnSpPr', $node);
        if (!$element) {
            return null;
        }

        $nvCxnSpPr = new self();

        $nvCxnSpPr->cNvPr = CNvPr::load($xmlReader, $element);
        $nvCxnSpPr->cNvCxnSpPr = CNvCxnSpPr::load($xmlReader, $element);
        $nvCxnSpPr->nvPr = NvPr::load($xmlReader, $element);

        return $nvCxnSpPr;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('p:nvCxnSpPr');

        $this->cNvPr && $this->cNvPr->write($writer);
        $this->cNvCxnSpPr && $this->cNvCxnSpPr->write($writer);
        $this->nvPr && $this->nvPr->write($writer);

        $writer->endElement();
    }
}
