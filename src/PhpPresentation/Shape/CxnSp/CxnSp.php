<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\AbstractShape;

class CxnSp extends AbstractShape
{
    public ?NvCxnSpPr $nvCxnSpPr = null;

    public ?SpPr $spPr = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        if ($node->nodeName !== 'p:cxnSp') {
            $element = $xmlReader->getElement('p:cxnSp', $node);
            if (!$element) {
                return null;
            }
        } else {
            $element = $node;
        }

        $cxnSp = new self();

        $cxnSp->nvCxnSpPr = NvCxnSpPr::load($xmlReader, $element);
        $cxnSp->spPr = SpPr::load($xmlReader, $element);

        return $cxnSp;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('p:cxnSp');

        $this->nvCxnSpPr && $this->nvCxnSpPr->write($writer);
        $this->spPr && $this->spPr->write($writer);

        $writer->endElement();
    }
}
