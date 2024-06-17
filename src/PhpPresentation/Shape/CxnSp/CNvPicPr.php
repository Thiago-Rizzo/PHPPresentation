<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class CNvPicPr
{
    public string $preferRelativeResize = '';
    public ?PicLocks $picLocks = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('p:cNvPicPr', $node);
        if (!$element) {
            return null;
        }

        $cNvPicPr = new self();

        $cNvPicPr->preferRelativeResize = $element->getAttribute('preferRelativeResize');

        $cNvPicPr->picLocks = PicLocks::load($xmlReader, $element);

        return $cNvPicPr;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('p:cNvPicPr');

        $this->preferRelativeResize != '' && $writer->writeAttribute('preferRelativeResize', $this->preferRelativeResize);

        $this->picLocks && $this->picLocks->write($writer);

        $writer->endElement();
    }
}
