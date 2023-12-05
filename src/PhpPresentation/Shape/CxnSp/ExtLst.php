<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class ExtLst
{
    public ?Ext $ext = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:extLst', $node);
        if (!$element) {
            return null;
        }

        $extLst = new self();

        $extLst->ext = Ext::load($xmlReader, $element);

        return $extLst;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:extLst');

        $this->ext && $this->ext->write($writer);

        $writer->endElement();
    }
}
